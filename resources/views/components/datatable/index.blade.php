@props(['id', 'collection', 'thead', 'tbody', 'lengthChange' => true, 'searching' => true, 'paging' => true])

@php($lengthAwarePaginator = $collection ?? null)

@php($datatableSearch = "datatableSearch_$id")
@php($noRecordsMessage = "noRecordsMessage_$id")

<form method="GET">
    @foreach(request()->all() as $key => $value)
        @if($key !== 'perPage')
            <input type="hidden" name="{{$key}}" value="{{$value}}">
        @endif
    @endforeach

    <div class="flex flex-wrap ">
        <div class="flex items-center w-full md:w-1/2 mt-3">
            <label for="perPage" class="text-sm text-gray-800 dark:text-gray-200 @if(!$lengthChange) hidden @endif">Show</label>
            <div class="mx-1 @if(!$lengthChange) hidden @endif">
                <select class="form-control-sm rounded-md text-sm py-1.5 pr-5" name="perPage" onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $perPage)
                        <option value="{{ $perPage }}" @selected($perPage == request()->query('perPage'))>
                            {{ $perPage }}
                        </option>
                    @endforeach
                </select>
            </div>
            <label for="filter" class="text-sm text-gray-800 dark:text-gray-200 @if(!$lengthChange) hidden @endif">entries</label>
        </div>

        <div class="flex items-center w-full md:w-1/2 justify-end mt-3">
            <label for="search" class="mx-2 text-sm text-gray-800 dark:text-gray-200 @if(!$searching) hidden @endif">Search:</label>
            <div class="@if(!$searching) hidden @endif">
                <input type="search" class="form-control-sm rounded-md text-sm p-2" placeholder=""
                       id="{{$datatableSearch}}">
            </div>
        </div>
    </div>
</form>


{{-- Table Section --}}
<div class="overflow-x-auto">
    <table class="datatable table-auto border-collapse border-none w-full text-gray-800 dark:text-gray-200">
        <thead>
        @if(isset($thead))
            {!! $thead !!}
        @endif
        </thead>

        <tbody>
        @if(isset($tbody))
            {!! $tbody !!}
        @endif
        </tbody>
    </table>

    @if($collection->count() > 0)
        <div id="{{ $noRecordsMessage }}" class="text-gray-800 dark:text-gray-200 text-center mb-5 hidden">
            No matching records found
        </div>
    @endif

    {{-- Pagination Section --}}
    <div class="my-2">
        {!! $lengthAwarePaginator->links() !!}
    </div>


</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css"/>

    <style>
        /* custom-datatables.css */
        /*.dataTables_wrapper .dataTables_paginate .paginate_button {*/
        /*    color: #4a5568; !* Tailwind text-gray-700 *!*/
        /*    background-color: #edf2f7; !* Tailwind bg-gray-200 *!*/
        /*    border-radius: 0.25rem; !* Tailwind rounded *!*/
        /*    padding: 0.5rem 1rem; !* Tailwind px-4 py-2 *!*/
        /*    margin: 0.25rem; !* Tailwind m-1 *!*/
        /*}*/

        /*.dataTables_wrapper .dataTables_paginate .paginate_button:hover {*/
        /*    color: #fff; !* Tailwind text-white *!*/
        /*    background-color: #2d3748; !* Tailwind bg-gray-800 *!*/
        /*}*/

        /*.dataTables_wrapper .dataTables_filter input {*/
        /*    border-radius: 0.25rem; !* Tailwind rounded *!*/
        /*    padding: 0.5rem 1rem; !* Tailwind px-4 py-2 *!*/
        /*    border: 1px solid #e2e8f0; !* Tailwind border-gray-300 *!*/
        /*}*/

        /*.dataTables_wrapper .dataTables_length select {*/
        /*    border-radius: 0.25rem; !* Tailwind rounded *!*/
        /*    padding: 0.5rem; !* Tailwind py-2 *!*/
        /*    border: 1px solid #e2e8f0; !* Tailwind border-gray-300 *!*/
        /*}*/
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>

    <script>
        var datatable = $('.datatable').DataTable({
            order: [],
            processing: true,
            serverSide: false,
            paging: false,          // Disable pagination
            lengthChange: false,    // Disable the "Show entries" dropdown
            searching: false,       // Disable the search box
            info: false,            // Hide the information text
            language: {
                loadingRecords: '{{ __('datatable.language.loading_records') }}',
                emptyTable: '{{ __('datatable.language.empty_table') }}',
                zeroRecords: '{{ __('datatable.language.zero_records') }}',
            }
        });


        $('#{{ $datatableSearch }}').on('keyup input', function () {
            let searchTerm = this.value.toLowerCase();
            let noMatch = true;

            if (searchTerm.length === 0) {
                noMatch = false;
            }

            datatable.rows().every(function () {
                let data = this.data().join(' ').toLowerCase();
                if (data.includes(searchTerm)) {
                    $(this.node()).show();
                    noMatch = false;
                } else {
                    $(this.node()).hide();
                }
            })

            // Show or hide the no matching records message
            if (noMatch) {
                $('#{{ $noRecordsMessage }}').removeClass('hidden');
            } else {
                $('#{{ $noRecordsMessage }}').addClass('hidden');
            }
        })
    </script>
@endpush

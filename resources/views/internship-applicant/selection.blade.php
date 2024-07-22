@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('internship-applicant.selection.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    <x-link-button class="mb-4" href="{{ route('internship-applicants.index') }}">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{__('buttons.back')}}
                    </x-link-button>


                    <x-datatable :id="'dtApplicants'" :collection="$data['applicants']">
                        <x-slot:thead>
                            <x-datatable.row isHeader>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.ranking')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.name')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.email')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.major')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.education')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.gpa')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.score')"/>
                            </x-datatable.row>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @forelse($data['applicants'] as $applicant)
                                @if($applicant instanceof \App\Models\Application)
                                    <x-datatable.row>
                                        <x-datatable.col :value="$loop->iteration"/>
                                        <x-datatable.col :value="$applicant->full_name"/>
                                        <x-datatable.col :value="$applicant->user->email"/>
                                        <x-datatable.col :value="$applicant->education->major"/>
                                        <x-datatable.col :value="$applicant->education->education_level"/>
                                        <x-datatable.col :value="$applicant->education->gpa"/>
                                        <x-datatable.col :value="'-'"/>
                                    </x-datatable.row>
                                @endif
                            @empty
                            @endforelse
                        </x-slot:tbody>
                    </x-datatable>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

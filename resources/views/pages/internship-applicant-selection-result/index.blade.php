@php use App\Enums\ApplicationStatusEnum; @endphp
@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('internship-applicant-selection-result.index.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">


                    <x-link-button class="mb-4 float-right" href="{{ route('internship-applicant-selection-results.print') }}">
                        <i class="fas fa-print mr-2"></i>
                        {{__('internship-applicant.buttons.print')}}
                    </x-link-button>

                    <section class="mt-3">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('internship-applicant-selection-result.index.title') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('internship-applicant-selection-result.index.subtitle') }}
                            </p>
                        </header>

                        <form method="GET">
                            <div class="max-w-md mt-5">
                                <x-input-label for="application_status" :value="__('labels.application_status')"/>
                                <x-select-option name="application_status" onchange="this.form.submit()">
                                    <option value="all" @selected(request()->query('application_status') == 'all')>{{ __('internship-applicant.status.all') }}</option>
                                    @foreach(array_slice(\App\Enums\ApplicationStatusEnum::toArray(), 2, 3) as $value)
                                        <option value="{{ $value }}" @selected(request()->query('application_status') == $value)>{{ __('internship-applicant.status.'.$value) }}</option>
                                    @endforeach
                                </x-select-option>
                            </div>
                        </form>


                        <div class="mt-10">
                            <x-datatable :id="'dtSelectionResults'" :collection="$data['selection_results']">
                                <x-slot:thead>
                                    <x-datatable.row isHeader>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.ranking')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.name')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.gender')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.email')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.major')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.education')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.gpa')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.status')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection-result.tables.headers.score')"/>
                                    </x-datatable.row>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @forelse($data['selection_results'] as $result)
                                        @if($result instanceof \App\Models\Score)
                                            <x-datatable.row>
                                                <x-datatable.col :value="$loop->iteration"/>
                                                <x-datatable.col :value="$result->application->full_name"/>
                                                <x-datatable.col
                                                    :value="__('internship-applicant.gender.'. $result->application->gender)"/>
                                                <x-datatable.col :value="$result->application->user->email"/>
                                                <x-datatable.col :value="$result->application->education->major"/>
                                                <x-datatable.col
                                                    :value="$result->application->education->education_level"/>
                                                <x-datatable.col :value="$result->application->education->gpa"/>
                                                <x-datatable.col class="flex justify-center items-center">
                                                    @if($result->application->status === ApplicationStatusEnum::ACCEPTED->value)
                                                        <x-badge :value="__('application-submission.status.'. $result->application->status)" :type="'primary'"/>
                                                    @elseif($result->application->status === ApplicationStatusEnum::REJECTED->value)
                                                        <x-badge :value="__('application-submission.status.'. $result->application->status)" :type="'danger'"/>
                                                    @else
                                                        <x-badge :value="__('application-submission.status.'. $result->application->status)"/>
                                                    @endif
                                                </x-datatable.col>
                                                <x-datatable.col :value="$result->final_score * 100"/>
                                            </x-datatable.row>
                                        @endif
                                    @empty
                                    @endforelse
                                </x-slot:tbody>
                            </x-datatable>
                        </div>

                    </section>

                    @pushonce('child-scripts')
                        <script>
                            $('.flatpickr').flatpickr({
                                mode: 'range',
                                wrap: true,
                                altInput: true,
                                altFormat: "d F Y",
                                dateFormat: "Y-m-d",
                                locale: `{{ config('app.locale') }}`,
                                maxDate: 'today'
                            })

                            $('#application_date_range').flatpickr({
                                mode: 'range',
                                wrap: true,
                                altInput: true,
                                altFormat: "d F Y",
                                dateFormat: "Y-m-d",
                                locale: `{{ config('app.locale') }}`,
                                maxDate: 'today'
                            })
                        </script>
                    @endpushonce

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

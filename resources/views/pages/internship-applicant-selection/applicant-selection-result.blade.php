@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('internship-applicant-selection.result.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    <x-link-button class="mb-4" href="{{ route('internship-applicant-selections.index') }}">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{__('buttons.back')}}
                    </x-link-button>

                    <section class="mt-3">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('internship-applicant-selection.result.title') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('internship-applicant-selection.result.subtitle') }}
                            </p>
                        </header>


                        <div class="sm:max-w-full md:max-w-xl">
                            <form id="store-applicant-selection-result" method="post" action="{{ route('internship-applicant-selections.process-result') }}"
                                  class="mt-6 space-y-6">
                                @csrf

                                <x-text-input id="threshold_default" name="threshold_default" type="hidden" class="mt-1 block w-full"
                                              :value="$data['threshold_value']" autofocus/>

                                <div>
                                    <x-input-label for="threshold_value" :value="__('labels.threshold_value')"/>
                                    <x-text-input id="threshold_value" name="threshold_value" type="number" step="0.01" class="mt-1 block w-full"
                                                  :value="old('threshold_value', $data['threshold_value'])" autofocus/>
                                    <x-input-error class="mt-2" :messages="$errors->get('threshold_value')"/>
                                    <x-input-label for="threshold_value" class="text-[13px] mt-2" :value="__('labels.threshold_value_description1', ['value' => $data['threshold_value']])"/>
                                    <x-input-label for="threshold_value" class="text-[13px]" :value="__('labels.threshold_value_description2')"/>
                                    <x-input-label for="threshold_value" class="text-[13px]" :value="__('labels.threshold_value_description3')"/>
                                </div>


                                <div class="flex items-center gap-4">
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-store-applicant-selection-result')"
                                    >
                                        <i class="fas fa-save mr-2"></i>
                                        {{ __('internship-applicant-selection.buttons.save_result') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </div>

                        <x-modal name="confirm-store-applicant-selection-result" focusable>
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('internship-applicant-selection.modals.confirm_store_applicant_selection_result.title') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('internship-applicant-selection.modals.confirm_store_applicant_selection_result.subtitle') }}
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('buttons.cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3" form="store-applicant-selection-result">
                                        {{ __('buttons.save') }}
                                    </x-danger-button>
                                </div>
                            </div>
                        </x-modal>

                        <div class="mt-10">
                            <x-datatable :id="'dtEvaluationResults'" :collection="$data['evaluation_results']">
                                <x-slot:thead>
                                    <x-datatable.row isHeader>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.ranking')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.name')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.gender')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.email')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.major')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.education')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.gpa')"/>
                                        <x-datatable.col :value="__('internship-applicant-selection.tables.headers.score')"/>
                                    </x-datatable.row>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @forelse($data['evaluation_results'] as $result)
                                        @if($result instanceof \App\Models\Score)
                                            <x-datatable.row>
                                                <x-datatable.col :value="$loop->iteration"/>
                                                <x-datatable.col :value="$result->application->full_name"/>
                                                <x-datatable.col :value="__('internship-applicant.gender.'. $result->application->gender)"/>
                                                <x-datatable.col :value="$result->application->user->email"/>
                                                <x-datatable.col :value="$result->application->education->major"/>
                                                <x-datatable.col :value="$result->application->education->education_level"/>
                                                <x-datatable.col :value="$result->application->education->gpa"/>
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

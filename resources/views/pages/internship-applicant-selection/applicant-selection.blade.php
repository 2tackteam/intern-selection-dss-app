@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('internship-applicant-selection.applicant_selection.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    <section class="mt-3">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('internship-applicant-selection.applicant_selection.title') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('internship-applicant-selection.applicant_selection.subtitle') }}
                            </p>
                        </header>


                        <div class="sm:max-w-full md:max-w-xl">
                            <form method="post" action="{{ route('internship-applicant-selections.process-selection') }}"
                                  class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="application_date_range" :value="__('labels.application_date_range')"/>
                                    <x-date-input id="application_date_range" name="application_date_range" type="date" class="mt-1 block w-full"
                                                  :value="old('application_date_range')" placeholder="Pilih Tanggal..." autofocus/>
                                    <x-input-error class="mt-2" :messages="$errors->get('application_date_range')"/>
                                </div>


                                <div class="w-full">
                                    <x-input-label for="gender" :value="__('labels.gender')"/>
                                    <x-select-option name="gender">
                                        <option
                                            value="all" @selected(old('gender') == 'all')>{{ __('internship-applicant.gender.ALL') }}</option>
                                        @foreach(\App\Enums\GenderEnum::toArray() as $value)
                                            <option
                                                value="{{ $value }}" @selected(old('gender') == $value)>{{ __('internship-applicant.gender.'.$value) }}</option>
                                        @endforeach
                                    </x-select-option>
                                    <x-input-error class="mt-2" :messages="$errors->get('gender')"/>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>
                                        <i class="fas fa-users-between-lines mr-3"></i>
                                        {{ __('internship-applicant-selection.buttons.selection') }}
                                    </x-primary-button>
                                </div>
                            </form>
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

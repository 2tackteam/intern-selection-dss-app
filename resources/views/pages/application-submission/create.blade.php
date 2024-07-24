@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('application-submission.create.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="sm:max-w-full md:max-w-xl">

                    <x-link-button class="mb-4" href="{{ route('application-submissions.index') }}">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{__('buttons.back')}}
                    </x-link-button>

                    <section class="mt-3">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('application-submission.create.title') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('application-submission.create.subtitle') }}
                            </p>
                        </header>


                        <form method="post" action="{{ route('application-submissions.store') }}"
                              class="mt-6 space-y-6">
                            @csrf


                            <div>
                                <x-input-label for="name" :value="__('labels.full_name')"/>
                                <x-text-input id="name" name="full_name" type="text" class="mt-1 block w-full"
                                              :value="old('full_name', auth()->user()->name)" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('full_name')"/>
                            </div>

                            <div>
                                <x-input-label for="birth_place" :value="__('labels.birth_place')"/>
                                <x-text-input id="birth_place" name="birth_place" type="text" class="mt-1 block w-full"
                                              :value="old('birth_place')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('birth_place')"/>
                            </div>

                            <div>
                                <x-input-label for="birth_date" :value="__('labels.birth_date')"/>
                                <x-date-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full"
                                              :value="old('birth_date')" placeholder="Pilih Tanggal..." autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('birth_date')"/>
                            </div>


                            <div class="w-full">
                                <x-input-label for="gender" :value="__('labels.gender')"/>
                                <x-select-option name="gender">
                                    @foreach(\App\Enums\GenderEnum::toArray() as $value)
                                        <option
                                            value="{{ $value }}" @selected(old('gender') == $value)>{{ __('application-submission.gender.'.$value) }}</option>
                                    @endforeach
                                </x-select-option>
                                <x-input-error class="mt-2" :messages="$errors->get('gender')"/>
                            </div>

                            <div>
                                <x-input-label for="education_level" :value="__('labels.education_level')"/>
                                <x-select-option name="education_level">
                                    @foreach(\App\Enums\EducationLevelEnum::toArray() as $value)
                                        <option
                                            value="{{ $value }}" @selected(old('education_level') == $value)>{{ $value }}</option>
                                    @endforeach
                                </x-select-option>
                                <x-input-error class="mt-2" :messages="$errors->get('education_level')"/>
                            </div>

                            <div>
                                <x-input-label for="institution_name" :value="__('labels.institution_name')"/>
                                <x-text-input id="institution_name" name="institution_name" type="text"
                                              class="mt-1 block w-full" :value="old('institution_name')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('institution_name')"/>
                            </div>

                            <div>
                                <x-input-label for="major" :value="__('labels.major')"/>
                                <x-text-input id="major" name="major" type="text" class="mt-1 block w-full"
                                              :value="old('major')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('major')"/>
                            </div>

                            <div>
                                <x-input-label for="subtitle" class="text-[18.5px] font-bold mb-4"
                                               :value="__('labels.education_year')"/>
                                <div class="flex space-x-2.5">
                                    <div class="w-full">
                                        <x-input-label for="start_year" :value="__('labels.start_year')"/>
                                        <x-select-option name="start_year">
                                            @foreach(\App\Enums\YearEnum::toArray() as $value)
                                                <option
                                                    value="{{ $value }}" @selected(old('start_year') == $value)>{{ $value }}</option>
                                            @endforeach
                                        </x-select-option>
                                        <x-input-error class="mt-2" :messages="$errors->get('start_year')"/>
                                    </div>

                                    <div class="w-full">
                                        <x-input-label for="end_year" :value="__('labels.end_year')"/>
                                        <x-select-option name="end_year">
                                            @foreach(\App\Enums\YearEnum::toArray() as $value)
                                                <option
                                                    value="{{ $value }}" @selected(old('end_year') == $value)>{{ $value }}</option>
                                            @endforeach
                                        </x-select-option>
                                        <x-input-error class="mt-2" :messages="$errors->get('end_year')"/>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="flex space-x-2.5">
                                    <div class="w-full">
                                        <x-input-label for="gpa" :value="__('labels.gpa')"/>
                                        <x-text-input id="gpa" name="gpa" type="number" step="0.01"
                                                      class="mt-1 block w-full" :value="old('gpa')" autofocus/>
                                        <x-input-error class="mt-2" :messages="$errors->get('gpa')"/>

                                        <small class="text-neutral-700">*{{ \App\Enums\EducationLevelEnum::SHS_VHS->value }} = 0 s/d 100</small>
                                        <br>
                                        @php($educations = \App\Enums\EducationLevelEnum::toArray())
                                        @php(array_shift($educations))
                                        <small class="text-neutral-700">*{{ implode(', ', $educations) }} = 0 s/d 4.0</small>
                                    </div>

                                    <div class="w-full hidden" id="gpa_equal_section">
                                        <x-input-label for="gpa_equal" :value="__('labels.gpa_equal')"/>
                                        <x-text-input id="gpa_equal" name="gpa_equal" type="number" step="0.01"
                                                      class="mt-1 block w-full disabled:bg-gray-300 disabled:border-gray-100 disabled" disabled autofocus/>
                                    </div>
                                </div>
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('buttons.save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                    @pushonce('child-scripts')
                        <script>
                            $('.flatpickr').flatpickr({
                                wrap: true,
                                altInput: true,
                                altFormat: "d F Y",
                                dateFormat: "Y-m-d",
                                locale: `{{ config('app.locale') }}`,
                                maxDate: 'today'
                            })

                            $('#birth_date').flatpickr({
                                wrap: true,
                                altInput: true,
                                altFormat: "d F Y",
                                dateFormat: "Y-m-d",
                                locale: `{{ config('app.locale') }}`,
                                maxDate: 'today'
                            })
                        </script>


                        <script>
                            const SHS_VHS = @js(\App\Enums\EducationLevelEnum::SHS_VHS->value);

                            const loadGPAEqualSection = (value) => {
                                if (value !== SHS_VHS) {
                                    $('#gpa_equal_section').removeClass('hidden')
                                } else {
                                    $('#gpa_equal_section').addClass('hidden')
                                }
                            }

                            const $selectEducationLevel = $('select[name="education_level"]')
                            loadGPAEqualSection($selectEducationLevel.val())

                            $selectEducationLevel.on('change', function () {
                                const value = $(this).val()

                                loadGPAEqualSection(value)
                            })

                            const calculateGPAEqual = (value) => {
                                const educationLevel = $('select[name="education_level"]').val()

                                if (educationLevel !== SHS_VHS) {
                                    let gpa = parseFloat(value)
                                    let result = (gpa / 4.0 * 100).toFixed(2)
                                    console.log(result)
                                    $('input[name="gpa_equal"]').val(result)
                                } else {
                                    $('input[name="gpa_equal"]').val(gpa)
                                }
                            }

                            const $inputGPA = $('input[name="gpa"]')
                            calculateGPAEqual($inputGPA.val())
                            $inputGPA.on('input', function () {
                                const value = $(this).val()
                                calculateGPAEqual(value)
                            })
                        </script>
                    @endpushonce
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

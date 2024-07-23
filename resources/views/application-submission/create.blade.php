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


                        <form method="post" action="{{ route('application-submissions.store') }}" class="mt-6 space-y-6">
                            @csrf


                            <div>
                                <x-input-label for="name" :value="__('labels.full_name')" />
                                <x-text-input id="name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                            </div>

                            <div>
                                <x-input-label for="birth_place" :value="__('labels.birth_place')" />
                                <x-text-input id="birth_place" name="birth_place" type="text" class="mt-1 block w-full" :value="old('birth_place')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('birth_place')" />
                            </div>

                            <div>
                                <x-input-label for="birth_date" :value="__('labels.birth_date')" />
                                <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                            </div>

                            <div class="w-full">
                                <x-input-label for="gender" :value="__('labels.gender')" />
                                <x-select-option name="gender"  data-subtext="Not Available" >
                                    @foreach(range(now()->year, now()->year - 100) as $year)
                                        <option>{{ $year }}</option>
                                    @endforeach
                                </x-select-option>
                                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                            </div>

                            <div>
                                <x-input-label for="education_level" :value="__('labels.education_level')" />
                                <x-text-input id="education_level" name="education_level" type="text" class="mt-1 block w-full" :value="old('education_level')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('education_level')" />
                            </div>

                            <div>
                                <x-input-label for="institution_name" :value="__('labels.institution_name')" />
                                <x-text-input id="institution_name" name="institution_name" type="text" class="mt-1 block w-full" :value="old('institution_name')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('institution_name')" />
                            </div>

                            <div>
                                <x-input-label for="major" :value="__('labels.major')" />
                                <x-text-input id="major" name="major" type="text" class="mt-1 block w-full" :value="old('major')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('major')" />
                            </div>

                            <div>
                                <x-input-label for="subtitle" class="text-[18px] font-bold mb-4" :value="__('labels.education_year')" />
                                <div class="flex space-x-2.5">
                                    <div class="w-full">
                                        <x-input-label for="start_year" :value="__('labels.start_year')" />
                                        <x-select-option name="start_year"  data-subtext="Not Available" >
                                            @foreach(range(now()->year, now()->year - 100) as $year)
                                                <option>{{ $year }}</option>
                                            @endforeach
                                        </x-select-option>
                                        <x-input-error class="mt-2" :messages="$errors->get('start_year')" />
                                    </div>

                                    <div class="w-full">
                                        <x-input-label for="end_year" :value="__('labels.end_year')" />
                                        <x-select-option name="end_year">
                                            @foreach(range(now()->year, now()->year - 100) as $year)
                                                <option>{{ $year }}</option>
                                            @endforeach
                                        </x-select-option>
                                        <x-input-error class="mt-2" :messages="$errors->get('end_year')" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="gpa" :value="__('labels.gpa')" />
                                <x-text-input id="gpa" name="gpa" type="text" class="mt-1 block w-full" :value="old('gpa')" autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('gpa')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('buttons.save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('profile.messages.saved') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>

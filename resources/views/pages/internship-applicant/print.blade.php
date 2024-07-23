<x-app-layout :navigation="false">
    <div class="py-12">
        <div class="max-w-full-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    @if($data['application'] instanceof \App\Models\Application)
                        @php($application = $data['application'])

                        <div>
                            <div class="px-4 sm:px-0">
                                <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.title') }}</h3>
                                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600 dark:text-gray-400">{{ __('internship-applicant.show.subtitle') }}</p>
                            </div>
                            <div class="mt-6 border-t border-gray-100 dark:divide-gray-600">
                                <dl class="divide-y divide-gray-100 dark:divide-gray-600">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.full_name') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->full_name }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.email_address') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->user->email }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.place_date_of_birth') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->birth_place . ', ' . $application->birth_date->translatedFormat('d F Y') }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.gender') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ __('internship-applicant.gender.'. $application->gender) }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.last_education') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->education_level }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.institution_name') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->institution_name }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.major') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->major }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.academic_year') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->start_year . ' - ' . $application->education->end_year}}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.gpa') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                            @if($application->education->education_level === 'SMA/SMK')
                                                {{ $application->education->gpa }}
                                            @else
                                                {{ round($application->education->gpa / 100 * 4, 2) }} ({{ $application->education->gpa }})
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('internship-applicant.show.status') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 font-bold text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                            {{ __('internship-applicant.status.'. $application->status) }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('child-styles')
        <style>
            /* styles.css */
            @media print {
                @page {
                    size: A4;
                    /*margin: 20mm;*/
                }

                body {
                    margin: 0;
                    padding: 0;
                }
            }
        </style>
    @endpush
    @push('child-scripts')
        <script>
            window.print();
        </script>
    @endpush

</x-app-layout>


<x-app-layout :navigation="false">
    <div class="pb-12">
        <div class="max-w-full-auto sm:px-6 lg:px-8 space-y-6">
            <div class="px-4 sm:px-8 bg-white dark:bg-gray-800 sm:rounded-lg">
                <div class="contain-inline-size">

                    <div class="flex flex-row space-x-3 pb-2 border-b-2 border-gray-800 dark:divide-gray-600">
                        <div class="justify-start">
                            <img class="w-[80px] h-[100px]" src="{{ asset('images/logo_sumsel.png') }}" alt="logo">
                        </div>
                        <div class="justify-center text-center">
                            <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                PEMERINTAH PROVINSI SUMATERA SELATAN
                            </p>
                            <p class="text-[21px] font-semibold text-gray-900 dark:text-gray-100">
                                DINAS PEMBERDAYAAN MASYARAKAT DAN DESA
                            </p>
                            <p class="text-sm font-normal text-gray-900 dark:text-gray-100">
                                Jl. Kapten A. Rivai No. 259 Palembang
                            </p>
                            <p class="text-sm font-normal text-gray-900 dark:text-gray-100">
                                Telp/Fax (0711) 314129
                            </p>
                        </div>
                    </div>

                    @if($data['application'] instanceof \App\Models\Application)
                        @php($application = $data['application'])

                        <div class="mt-10">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.title') }}</h3>
                                <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600 dark:text-gray-400">{{ __('application-submission.show.subtitle') }}</p>
                            </div>
                            <div class="mt-6 border-t border-gray-100 dark:divide-gray-600">
                                <dl class="divide-y divide-gray-100 dark:divide-gray-600">
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.full_name') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->full_name }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.email_address') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->user->email }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.place_date_of_birth') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->birth_place . ', ' . $application->birth_date->translatedFormat('d F Y') }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.gender') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ __('application-submission.gender.'. $application->gender) }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.last_education') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->education_level }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.institution_name') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->institution_name }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.major') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->major }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.academic_year') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{ $application->education->start_year . ' - ' . $application->education->end_year}}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.gpa') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                            @if($application->education->education_level === 'SMA/SMK')
                                                {{ $application->education->gpa }}
                                            @else
                                                {{ round($application->education->gpa / 100 * 4, 2) }} ({{ $application->education->gpa }})
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.status') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 font-bold text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                            {{ __('application-submission.status.'. $application->status) }}
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
                    size: A4 portrait;
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
            // window.print();
        </script>
    @endpush

</x-app-layout>


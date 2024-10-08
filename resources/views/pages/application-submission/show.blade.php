@php use App\Enums\ApplicationStatusEnum;use App\Models\Application; @endphp
@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('application-submission.show.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    @if($data['application'] instanceof Application)
                        @php($application = $data['application'])

                        <x-link-button class="mb-4" href="{{ route('application-submissions.index') }}">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{__('buttons.back')}}
                        </x-link-button>

                        <div class="float-right space-x-2">

                            @if($application->status === ApplicationStatusEnum::DRAFT->value)

                                <x-link-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-application-submit')"
                                    class="mb-4 bg-blue-600 dark:bg-blue-500 hover:bg-blue-500 dark:hover:bg-blue-400 focus:bg-blue-700 dark:focus:bg-blue-600 active:bg-blue-900 dark:active:bg-blue-300"
                                    href="{{ route('application-submissions.print', hashIdsEncode($application->id)) }}"
                                    target="_blank">
                                    <i class="fas fa-angles-right mr-2"></i>
                                    {{__('application-submission.buttons.submit')}}
                                </x-link-button>

                                <x-link-button
                                    class="mb-4 bg-gray-600 dark:bg-gray-500 hover:bg-gray-500 dark:hover:bg-gray-400 focus:bg-gray-700 dark:focus:bg-gray-600 active:bg-gray-900 dark:active:bg-gray-300"
                                    href="{{ route('application-submissions.edit', hashIdsEncode($application->id)) }}">
                                    <i class="fas fa-edit mr-2"></i>
                                    {{__('application-submission.buttons.edit')}}
                                </x-link-button>

                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-application-deletion')"
                                >
                                    <i class="fas fa-trash mr-2"></i>
                                    {{__('application-submission.buttons.delete')}}
                                </x-danger-button>
                            @endif

                            <x-link-button class="mb-4"
                                           href="{{ route('application-submissions.print', hashIdsEncode($application->id)) }}"
                                           target="_blank">
                                <i class="fas fa-print mr-2"></i>
                                {{__('application-submission.buttons.print')}}
                            </x-link-button>
                        </div>



                        <div>
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
                                                {{ round($application->education->gpa / 100 * 4, 2) }}
                                                ({{ $application->education->gpa }})
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">{{ __('application-submission.show.status') }}</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-200 sm:col-span-2 sm:mt-0">
                                            @if($application->status === ApplicationStatusEnum::ACCEPTED->value)
                                                <x-badge
                                                    :value="__('application-submission.status.'. $application->status)"
                                                    :type="'primary'"/>
                                            @elseif($application->status === ApplicationStatusEnum::REJECTED->value)
                                                <x-badge
                                                    :value="__('application-submission.status.'. $application->status)"
                                                    :type="'danger'"/>
                                            @else
                                                <x-badge
                                                    :value="__('application-submission.status.'. $application->status)"/>
                                            @endif

                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>


                        <x-modal name="confirm-application-submit" focusable>
                            <form method="post" action="{{ route('application-submissions.submit', hashIdsEncode($application->id)) }}" class="p-6">
                                @csrf
                                @method('patch')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('application-submission.modals.submit.title') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('application-submission.modals.submit.subtitle') }}
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('buttons.cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ms-3">
                                        {{ __('application-submission.buttons.submit') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-modal>


                        <x-modal name="confirm-application-deletion" focusable>
                            <form method="post" action="{{ route('application-submissions.destroy', hashIdsEncode($application->id)) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('application-submission.modals.delete.title') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('application-submission.modals.delete.subtitle') }}
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('buttons.cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('application-submission.buttons.delete') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

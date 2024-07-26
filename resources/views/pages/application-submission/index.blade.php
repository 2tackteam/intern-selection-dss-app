@php use App\Enums\ApplicationStatusEnum; @endphp
@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('application-submission.index.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    <x-link-button class="mb-4" href="{{ route('application-submissions.create') }}">
                        <i class="fas fa-plus mr-2"></i>
                        {{__('application-submission.buttons.create')}}
                    </x-link-button>

                    <x-datatable :id="'dtApplications'" :collection="$data['applications']">
                        <x-slot:thead>
                            <x-datatable.row isHeader>
                                <x-datatable.col :value="'#'"/>
                                <x-datatable.col :value="__('application-submission.tables.headers.full_name')"/>
                                <x-datatable.col :value="__('application-submission.tables.headers.submission_date')"/>
                                <x-datatable.col :value="__('application-submission.tables.headers.status')"/>
                                <x-datatable.col :value="__('application-submission.tables.headers.actions')"/>
                            </x-datatable.row>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @forelse($data['applications'] as $application)
                                @if($application instanceof \App\Models\Application)
                                    <x-datatable.row>
                                        <x-datatable.col :value="$loop->iteration"/>
                                        <x-datatable.col :value="$application->full_name"/>
                                        <x-datatable.col :value="$application->created_at->translatedFormat('d F Y')"/>
                                        <x-datatable.col>
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
                                        </x-datatable.col>
                                        <x-datatable.col>
                                            <x-link-button :size="'sm'"
                                                           href="{{ route('application-submissions.show', hashIdsEncode($application->id)) }}">
                                                <i class="far fa-eye mr-2"></i>
                                                {{__('application-submission.buttons.detail')}}
                                            </x-link-button>
                                        </x-datatable.col>
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

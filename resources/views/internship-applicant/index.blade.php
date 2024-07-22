@if(!isset($data))
    @dd('Something wrong!')
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('internship-applicant.index.page_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="contain-inline-size">

                    <x-primary-button class="mb-4">
                        <i class="fas fa-filter mr-2"></i>
                        {{__('internship-applicant.buttons.selection')}}
                    </x-primary-button>

                    <x-datatable :id="'dtApplicants'" :collection="$data['applicants']">
                        <x-slot:thead>
                            <x-datatable.row isHeader>
                                <x-datatable.col :value="'#'"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.full_name')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.date_of_birth')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.place_of_birth')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.gender')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.last_education')"/>
                                <x-datatable.col :value="__('internship-applicant.tables.headers.actions')"/>
                            </x-datatable.row>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @forelse($data['applicants'] as $applicant)
                                @if($applicant instanceof \App\Models\Application)
                                    <x-datatable.row>
                                        <x-datatable.col :value="$loop->iteration"/>
                                        <x-datatable.col :value="$applicant->full_name"/>
                                        <x-datatable.col :value="$applicant->birth_place"/>
                                        <x-datatable.col :value="$applicant->birth_date->translatedFormat('d F Y')"/>
                                        <x-datatable.col :value="__('internship-applicant.gender.'. $applicant->gender)"/>
                                        <x-datatable.col :value="$applicant->education?->education_level"/>
                                        <x-datatable.col>
                                            <x-link-button :size="'sm'" href="{{ route('internship-applicants.show', hashIdsEncode($applicant->id)) }}">
                                                <i class="far fa-eye mr-2"></i>
                                                {{__('internship-applicant.buttons.detail')}}
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

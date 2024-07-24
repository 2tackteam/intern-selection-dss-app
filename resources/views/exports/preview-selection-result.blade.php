@php use App\Enums\ApplicationStatusEnum;use App\Models\Application; @endphp
<table>
    <tr>
        <th>{{ __('internship-applicant.selection_result.title') }}</th>
    </tr>
    <tr>
        <th>{{ __('internship-applicant.selection_result.subtitle') }}</th>
    </tr>
</table>


<table>
    <thead>
    <tr>
        <td>{{__('internship-applicant.tables.headers.ranking')}}</td>
        <td>{{__('internship-applicant.tables.headers.name')}}</td>
        <td>{{__('internship-applicant.tables.headers.gender')}}</td>
        <td>{{__('internship-applicant.tables.headers.email')}}</td>
        <td>{{__('internship-applicant.tables.headers.major')}}</td>
        <td>{{__('internship-applicant.tables.headers.education')}}</td>
        <td>{{__('internship-applicant.tables.headers.gpa')}}</td>
        <td>{{__('internship-applicant.tables.headers.status')}}</td>
        <td>{{__('internship-applicant.tables.headers.score')}}</td>
    </tr>
    </thead>
    <tbody>
    @foreach($data['applications'] as $application)
        @if($application instanceof Application)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$application->full_name}}</td>
                <td>{{__('internship-applicant.gender.'. $application->gender)}}</td>
                <td>{{$application->user->email}}</td>
                <td>{{$application->education->major}}</td>
                <td>{{$application->education->education_level}}</td>
                <td>{{$application->education->gpa}}</td>
                <td>
                    @if($application->status === ApplicationStatusEnum::PENDING->value)
                        <div
                            class="inline-flex items-center px-4 py-2 bg-gray-400 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 tracking-widest">
                            {{ __('application-submission.status.'. $application->status) }}
                        </div>
                    @elseif($application->status === ApplicationStatusEnum::ACCEPTED->value)
                        <div
                            class="inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-blue-400 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-900 tracking-widest">
                            {{ __('application-submission.status.'. $application->status) }}
                        </div>
                    @else
                        <div
                            class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 tracking-widest">
                            {{ __('application-submission.status.'. $application->status) }}
                        </div>
                    @endif
                </td>
                <td>{{ $application->score->final_score * 100 }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

<?php

namespace App\Http\Requests\ApplicationSubmissions;

use App\Enums\EducationLevelEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationSubmissionRequest extends FormRequest
{
    public function rules(): array
    {
        $maxGPA = $this->input('education_level') === EducationLevelEnum::SHS_VHS->value ? '100' : '4.0';

        return [
            'full_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'date_format:Y-m-d', 'before:'.now()->format('d F Y')],
            'gender' => ['required', 'string', 'max:255'],
            'education_level' => ['required', 'string', 'max:255'],
            'institution_name' => ['required', 'string', 'max:255'],
            'major' => ['required', 'string', 'max:255'],
            'start_year' => ['required', 'date_format:Y', 'lt:end_year'],
            'end_year' => ['required', 'date_format:Y'],
            'gpa' => ['required', 'gt:0', 'lte:'.$maxGPA],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => trans('validation.required'),
            'string' => trans('validation.string'),
            'max' => trans('validation.max.string'),
            'date' => trans('validation.date'),
            'date_format' => trans('validation.date_format'),
            'before' => trans('validation.before'),
            'decimal' => trans('validation.decimal'),
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => trans('validation.attributes.application_submission.full_name'),
            'birth_place' => trans('validation.attributes.application_submission.birth_place'),
            'birth_date' => trans('validation.attributes.application_submission.birth_date'),
            'gender' => trans('validation.attributes.application_submission.gender'),
            'education_level' => trans('validation.attributes.application_submission.education_level'),
            'institution_name' => trans('validation.attributes.application_submission.institution_name'),
            'major' => trans('validation.attributes.application_submission.major'),
            'start_year' => trans('validation.attributes.application_submission.start_year'),
            'end_year' => trans('validation.attributes.application_submission.end_year'),
            'gpa' => trans('validation.attributes.application_submission.gpa'),
        ];
    }
}

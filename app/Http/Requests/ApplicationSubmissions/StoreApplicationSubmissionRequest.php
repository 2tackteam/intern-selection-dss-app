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
            'required' => __('validation.required'),
            'string' => __('validation.string'),
            'max' => __('validation.max.string'),
            'date' => __('validation.date'),
            'date_format' => __('validation.date_format'),
            'before' => __('validation.before'),
            'decimal' => __('validation.decimal'),
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('validation.attributes.application_submission.full_name'),
            'birth_place' => __('validation.attributes.application_submission.birth_place'),
            'birth_date' => __('validation.attributes.application_submission.birth_date'),
            'gender' => __('validation.attributes.application_submission.gender'),
            'education_level' => __('validation.attributes.application_submission.education_level'),
            'institution_name' => __('validation.attributes.application_submission.institution_name'),
            'major' => __('validation.attributes.application_submission.major'),
            'start_year' => __('validation.attributes.application_submission.start_year'),
            'end_year' => __('validation.attributes.application_submission.end_year'),
            'gpa' => __('validation.attributes.application_submission.gpa'),
        ];
    }
}

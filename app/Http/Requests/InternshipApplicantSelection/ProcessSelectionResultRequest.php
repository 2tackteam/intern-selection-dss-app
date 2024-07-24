<?php

namespace App\Http\Requests\InternshipApplicantSelection;

use Illuminate\Foundation\Http\FormRequest;

class ProcessSelectionResultRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'threshold_default' => ['required', 'numeric', 'min:1'],
            'threshold_value' => ['required', 'numeric', 'gte:threshold_default'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => trans('validation.required'),
            'min' => trans('validation.min.numeric'),
            'gte' => trans('validation.gte.numeric'),
        ];
    }

    public function attributes(): array
    {
        return [
            'threshold_default' => trans('validation.attributes.internship_applicant.threshold_default'),
            'threshold_value' => trans('validation.attributes.internship_applicant.threshold_value'),
        ];
    }
}

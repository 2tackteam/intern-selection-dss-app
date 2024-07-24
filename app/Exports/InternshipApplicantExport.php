<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class InternshipApplicantExport implements FromView, ShouldAutoSize, WithTitle
{
    public function __construct(public Collection $collection) {}

    public function view(): View
    {
        $data['applications'] = $this->collection;
        return view('exports.internship-applicant', compact('data'));
    }

    public function title(): string
    {
        return 'Internship Applicants';
    }
}

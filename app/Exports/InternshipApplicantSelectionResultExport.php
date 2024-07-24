<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class InternshipApplicantSelectionResultExport implements FromView
{
    public function __construct(public Collection $collection)
    {
    }

    public function view(): View
    {
        $data['applications'] = $this->collection;
        return view('exports.applicant-selection-result', compact('data'));
    }
}

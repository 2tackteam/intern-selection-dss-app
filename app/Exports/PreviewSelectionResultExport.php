<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class PreviewSelectionResultExport implements FromView
{
    public function __construct(public Collection $collection)
    {
    }

    public function view(): View
    {
        $data['applications'] = $this->collection;
        return view('exports.preview-selection-result', compact('data'));
    }
}

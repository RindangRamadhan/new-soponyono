<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDailyExport implements FromView
{
    public function __construct($resources)
    {
        $this->resources = $resources;
    }

    public function view(): View
    {
        return view('pages.report.daily.export', [
            'reports' => $this->resources,
        ]);
    }
}

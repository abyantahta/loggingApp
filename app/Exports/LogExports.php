<?php

namespace App\Exports;

use App\Models\Log;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogExports implements FromView
{
    public static $plant;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $logs = Log::orderBy('created_at', 'DESC')->get();
        return view('exportlog', compact(['logs']));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Exports\LogExports;
use App\Http\Resources\LogResource;
use Carbon\CarbonInterval;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function index(){

        $logs = Log::orderBy('created_at','DESC')->get();
        $logsCol = LogResource::collection($logs);
        // dd($logsCol);
        
        // $logs = 

        return view('dashboard',[
            "logs" => LogResource::collection($logs)
        ]);
    }
    private function userData($user_id)
    {
        $translate = [
            'L0284' => 'PT.TIGER SASH INDONESIA',
            'L0224' => 'PT.3M',
            'L0234' => 'PT.ASABA METAL INDUSTRI',
            'L1463' => 'PT.BETSO TECH INDONESIA',
            'L0278' => 'PT.CATALER INDONESIA',
            'L0207' => 'PT.HASHIMOTO',
            'L0173' => 'PT.HERROS',
            'L0232' => 'PT.INDOPRIMA GEMILANG',
            'L0187' => 'PT.ITOCHU',
            'L0177' => 'PT.MARUICHI',
            'L1416' => 'PT.MKCJ',
            'L0134' => 'PT.MORY',
            'L0147' => 'PT.NITIGURA',
            'L0249' => 'PT.SADEREX',
            'L0005' => 'PT.SEC INDONESIA',
            'L1454' => 'PT.SINTESA',
            'L0009' => 'PT.TOSAMA',
            // Tambahkan pola lain di sini jika perlu
        ];

        return $translate[$user_id] ?? $user_id;
    }
    public function store(Request $request){
        $user_id = substr(($request->scanData),0,5);
        $status = Str::after($request->scanData, $user_id.'_');
        // $status = substr(($request->scanData),$user_id);

        if($status==='IN'){
            Log::create([
                'user_id' => $user_id,
                'user_name' => $this->userData($user_id),
                'user_in' => Carbon::now(),
                // 'user_in' => Carbon::now(),
                'user_out' => null,
                'duration' => null
            ]);
            return redirect('/dashboard')->with('success', 'SCAN SUKSES, user dari '. $this->userData($user_id).' sedang memasuki area SDI');
        }
        if($status === 'OUT'){
            // try{
                $dataLog = Log::where('user_id',$user_id)->where('user_out',null)->first();
                if(!$dataLog){
                    return redirect('/dashboard')->with('error','Harap scan barcode IN');
                }
                $dataLog->user_out = Carbon::now();
                $dataLog->duration = ceil(Carbon::parse($dataLog->user_in)->diffInSeconds($dataLog->user_out));
                // $dataLog->duration = 72;
                $dataLog->save();
                // dd($dataLog);
                return redirect('/dashboard')->with('success', 'SCAN SUKSES, user dari ' . $this->userData($user_id) . ' sedang meninggalkan area SDI');
        }
        return redirect('/dashboard')->with('error', 'Barcode yang discan tidak sesuai format');
    }
    public function export(){
        return Excel::download(new LogExports, "logs.xlsx");
    }

    //
}

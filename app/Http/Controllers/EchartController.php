<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class EchartController extends Controller
// {
//     public function echart(Request $request)
//     {
//         $kurang = Anak::where('ket',"kurang")->get();
//         $normal = Anak::where('ket',"normal")->get();
//         $lebih = Anak::where('ket',"lebih")->get();
//         $kurang_count = count($kurang);
//         $normal_count = count($normal);
//         $lebih_count = count($lebih);
//         return view('echart',compact('kurang_count','normal_count','lebih_count'));
//     }
// }
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function eLineChart()
    {
        
        $result = DB::table('anak')
            ->select(DB::raw('count(*) as total_ket, ket'))
            ->groupBy('ket')
            ->get();
        $data1 = "";
        foreach ($result as $val) {
            $data1 .= "['" . $val->ket . "',     " . $val->total_ket . "],";
        }
        $chartData = $data1;
        if (Auth()->user()->role == User::ROLE_ADMIN) {
            return view('chart.adminChart.eChartadmin', compact('chartData'));
        } else {
            return view('chart.eChart', compact('chartData'));
        }
    }
    // {
    //     $result = DB::select(DB::raw("select count(*) as total_ket, ket from anak GROUP BY ket;"));
    //     return view('eChart',compact('result')); 
    // }
}
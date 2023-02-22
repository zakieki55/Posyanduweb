<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class chartController extends Controller
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
    public function xChart()
    {


        $result = DB::table('anak')
            ->select(DB::raw('count(*) as totket, ket_tb'))
            ->groupBy('ket_tb')
            ->get();
        $data1 = "";
        foreach ($result as $val) {
            $data1 .= "['" . $val->ket_tb . "',     " . $val->totket . "],";
        }
        $chartData = $data1;
        if (Auth()->user()->role == User::ROLE_ADMIN) {
            return view('chart.adminChart.xChartadmin', compact('chartData'));
        } else {
            return view('chart.xChart', compact('chartData'));
        }
    }
    // {
    //     $result = DB::select(DB::raw("select count(*) as total_ket, ket from anak GROUP BY ket;"));
    //     return view('eChart',compact('result')); 
    // }
}

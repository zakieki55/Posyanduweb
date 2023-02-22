<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use Illuminate\Support\Facades\DB;
use APp\Models\User;

class achartController extends Controller
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
    public function aChart()
    {
        $result = DB::select(DB::raw("select count(*) as totket, ket_bb from anak GROUP BY ket_bb;"));
        $data1 = "";
        foreach($result as $val){
            $data1.="['".$val->ket_bb."',     ".$val->totket. "],";
        }
        $arr['data'] = rtrim($data1,",");
        if(Auth()->user()->role == User::ROLE_ADMIN){
            return view('chart.adminChart.aChartadmin', $arr);
        }else{
            return view('chart.aChart', $arr);
        }
    }
    // {
    //     $result = DB::select(DB::raw("select count(*) as total_ket, ket from anak GROUP BY ket;"));
    //     return view('eChart',compact('result')); 
    // }
}
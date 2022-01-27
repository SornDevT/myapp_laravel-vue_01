<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transection;

class ReportController extends Controller
{
    //
    public function index(Request $request){

        $monthtype = $request->monthtype;
        $date = $request->dmy;
        $m = explode('-',$date)[1];
        $y = explode('-',$date)[0];
        if($monthtype=='m'){
            $income = Transection::where('tran_type', 'income')->whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $m)->get();
            $expense = Transection::where('tran_type', 'expense')->whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $m)->get();
        }
        else if($monthtype == 'y'){
            $income = Transection::where('tran_type', 'income')->whereYear('created_at', '=', $y)->get();
            $expense = Transection::where('tran_type', 'expense')->whereYear('created_at', '=', $y)->get();
        }


        $response = [
            'income'=> $income,
            'expense'=> $expense
        ];
        return response()->json($response);
    }
}

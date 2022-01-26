<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transection;
use App\Models\Store;
use Illuminate\Http\Request;

class TransectionController extends Controller
{
    //
    public function index(Request $request){
        //$search = \Request::get('s');

        $monthtype = $request->monthtype;
        $date = $request->dmy;

        if($request->dmy==''){
                    $tran = Transection::orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
        } else {
            $m = explode('-',$date)[1];
            $y = explode('-',$date)[0];
    
                if($monthtype=='m'){
                    $tran = Transection::whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $m)->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
                }else if($monthtype=='y'){
                    $tran = Transection::whereYear('created_at', '=', $y)->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
                }
            }
        
       
    }

    public function add(Request $request){
        try {
            foreach($request->listorder as $item){
                $tran = Transection::all()->sortByDesc('id')->take(1)->toArray();
                $number = 1;
                foreach($tran as $new)
                {
                    $number = $new['tran_id'];
                }
                if($number!=''){
                    $number1 = str_replace("INC","",$number);
                    $number2 = str_replace("EXP","",$number1);
                    $number = (int)$number2+1;
                    $length = 5;
                    $number = substr(str_repeat(0, $length).$number, - $length);
                }

                if($request->acc_type=='income'){ $tnum = 'INC'; }
                elseif($request->acc_type=='expense'){ $tnum = 'EXP'; }

                $store = new Transection();
                $store->tran_id = $tnum.$number;
                $store->product_id = $item['id'];
                $store->tran_type = $request->acc_type;
                $store->tran_detail = $item['name'];
                $store->amount = $item['order_amount'];
                $store->price = $item['order_amount']*$item['price_sell'];
                $store->save();

                //ອັບເດດ ຕັດສະຕ໋ອກ
                $store = Store::find($item['id']);
                $store_update = Store::where('id',$item['id']);
                $store_update->update([
                    'amount' => $store->amount - $item['order_amount']
                ]);

            }

            $success = true;
            $message = 'add success!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}

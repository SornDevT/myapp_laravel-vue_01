<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    //
    public function index(){

    }


    public function add(Request $request){

        try {

            $store = new Store();
            $store->name = $request->name;
           // $store->images = $generated_new_name;
            $store->amount = $request->amount;
            $store->price_buy = $request->price_buy;
            $store->price_sell = $request->price_sell;
            $store->save();
       

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

    public function edit($id){


    }

    public function update($id, Request $request){
      
    }

    public function delete($id){


    }
}

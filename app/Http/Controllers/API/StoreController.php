<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    //
    public function index(){

        $search = \Request::get('s');
        $store = Store::orderBy('created_at', 'desc')
        ->where("name","LIKE","%{$search}%")
        ->paginate(15)
        ->toArray();

        return array_reverse($store);

        //return $store;


        //->where('name','LIKE',"%{$search}%")
        //->paginate(10)
       // ->toArray();
        
        //return array_reverse($store);
        
    }


    public function add(Request $request){

        try {

            if($request->file('file')){
                $upload_path = 'assets/images';
                $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
                $image = $request->file('file');
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($upload_path.'/'.$generated_new_name);
            } else { $generated_new_name = ''; }

            $store = new Store();
            $store->name = $request->name;
            $store->images = $generated_new_name;
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

        $store = Store::find($id);
        return response()->json($store);

    }

    public function update($id, Request $request){

        $store = Store::find($id);

            if($request->file('file')){
                
                $upload_path = 'assets/images';

                /// ທຳການລຶບໄຟລ໌ເກົ່າ
                if($store->images!='' && $store->images!= null){
                    if(file_exists('assets/images/'.$store->images)){
                    unlink('assets/images/'.$store->images);
                    }
                }
                

                $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
                $image = $request->file('file');
                $img = Image::make($image->getRealPath());
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                
                $img->save($upload_path.'/'.$generated_new_name);

                $store->update([
                    'name' => $request->name,
                    'images' => $generated_new_name,
                    'amount' => $request->amount,
                    'price_buy' => $request->price_buy,
                    'price_sell' => $request->price_sell
                ]);

            } else { 

                $store = Store::find($id);
                $store->update([
                            'name' => $request->name,
                            'amount' => $request->amount,
                            'price_buy' => $request->price_buy,
                            'price_sell' => $request->price_sell
                        ]);

            }

    }

    public function delete($id){

        $store = Store::find($id);
        $store->delete();


    }
}

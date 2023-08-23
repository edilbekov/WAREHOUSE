<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArrivalRequest;
use App\Models\Arrival;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ArrivalController extends Controller
{
    public function add(ArrivalRequest $request){                        
        Arrival::create([
            'product_id'=>$request->product_id,
            'amount'=>$request->amount,
            'price'=>$request->price,
            'all_price'=>$request->amount*$request->price,
            'where_from'=>$request->where_from,
            'date'=>$request->date
        ]);
        $product=Warehouse::select('amount')->where('product_id',$request->product_id)->first();          
        if($product){
            Warehouse::where('product_id',$request->product_id)->update([                
                'amount'=>$request->amount+$product->amount
            ]);
        }
        else{
            Warehouse::create([
                'product_id'=>$request->product_id,
                'amount'=>$request->amount
            ]);
        }
        
        return ResponseController::success();
    }
    public function view(){
        return ResponseController::data(Arrival::all());
    }
}

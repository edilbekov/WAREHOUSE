<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'client_id'=>'required',
            'product_id'=>'required',
            'amount'=>'required'            
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        $cost=Cost::select('cost')->where('product_id',$request->product_id)->first();        
        if(!$cost){
            return ResponseController::error('The product cost is 0',422);
        }                
        Basket::create([
            'client_id'=>$request->client_id,
            'product_id'=>$request->product_id,
            'amount'=>$request->amount,
            'all_price'=>$cost->cost*$request->amount,            
        ]);
        return ResponseController::success();
    }
    public function view(){        
        return ResponseController::data(Basket::all());
    }
}

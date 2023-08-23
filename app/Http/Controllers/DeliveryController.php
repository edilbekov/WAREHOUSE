<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'basket_id'=>'required',
            'pay'=>'required'            
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);        
        }
        $all_price=Basket::select('all_price','amount')->where('id',$request->basket_id)->first();        
        $debt=$all_price->all_price-$request->pay;
        Delivery::create([
            'basket_id'=>$request->basket_id,
            'pay'=>$request->pay,
            'debt'=>$debt
        ]);
        $client_id=Basket::select('client_id','product_id')->where('id',$request->basket_id)->first();
        $user_debt=Client::select('debt')->where('id',$client_id['client_id'])->first();
        Client::where('id',$client_id['client_id'])->update([
            'debt'=>$debt+$user_debt['debt']
        ]);
        Basket::where('id',$request->basket_id)->update([            
            'delivered'=>true            
        ]);        
        $ware=Warehouse::select('amount')->where('product_id',$client_id['product_id'])->first();
        Warehouse::where('product_id',$client_id['product_id'])->update([
            'amount'=>$ware['amount']-$all_price['amount']
        ]);
        return ResponseController::success();
    }
    public function view($client_id){  
        $basket_id=Basket::select('id')->where('client_id',$client_id)->get();                
        foreach($basket_id as $id){            
            $all[]=Delivery::select('pay','debt','updated_at')->where('basket_id',$id['id'])->get();            
        }      
        return ResponseController::data($all[0]);
    }
}

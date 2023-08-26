<?php

namespace App\Http\Controllers;

use App\Events\OrderDelivered;
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
        $all_price=Basket::where('id',$request->basket_id)->first();        
        $debt=$all_price->all_price-$request->pay;
        $delivered=Delivery::create([
            'basket_id'=>$request->basket_id,
            'pay'=>$request->pay,
            'debt'=>$debt
        ]);
        $client_id=$all_price->client->id;
        $product_id=$all_price->product->id;        
        $client_debt=$all_price->client->debt;
        $amount=Warehouse::select('amount')->where('product_id',$product_id)->first();        
        
        Client::where('id',$client_id)->update([
            'debt'=>$debt+$client_debt
        ]);
        Basket::where('id',$request->basket_id)->update([            
            'delivered'=>true            
        ]);        
        Warehouse::where('product_id',$product_id)->update([
            'amount'=>$amount['amount']-$all_price['amount']
        ]);

        OrderDelivered::dispatch($delivered);
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

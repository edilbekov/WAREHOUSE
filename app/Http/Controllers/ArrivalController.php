<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ArrivalController extends Controller
{
    public function add(Request $request){        
        $validation=Validator::make($request->all(),[
            'product_id'=>'required',
            'amount'=>'required',
            'price'=>'required',
            'where_from'=>'required',
            'date'=>'required'
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }        
        Arrival::create([
            'product_id'=>$request->product_id,
            'amount'=>$request->amount,
            'price'=>$request->price,
            'all_price'=>$request->amount*$request->price,
            'where_from'=>$request->where_from,
            'date'=>$request->date
        ]);
        return ResponseController::success();
    }
    public function view(){
        return ResponseController::data(Arrival::all());
    }
}

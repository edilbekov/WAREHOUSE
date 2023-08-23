<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'product_id'=>'required',
            'cost'=>'required'
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);        
        }
        Cost::create([
            'product_id'=>$request->product_id,
            'cost'=>$request->cost
        ]);
        return ResponseController::success();
    }
    public function view(){
        return ResponseController::data(Cost::all());
    }
}

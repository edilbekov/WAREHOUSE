<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'category_id'=>'required',
            'name'=>'required',
            'size'=>'required'
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        Product::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'size'=>$request->size
        ]);
        return ResponseController::success();
    }
    public function view(){        
        return ResponseController::data(Product::all());
    }
}

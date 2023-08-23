<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'region'=>'required',
            'orientr'=>'required',
            'phone'=>'required'                     
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        Client::create([
            'name'=>$request->name,
            'region'=>$request->region,
            'orientr'=>$request->orientr,
            'phone'=>$request->phone,
            'agent_id'=>$request->agent_id            
        ]);
        return ResponseController::success();
    }
    public function view(){
        return ResponseController::data(Client::all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    public function add(Request $request){
        $validation=Validator::make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'regions'=>'required',
        ]);
        if($validation->fails()){
            return ResponseController::error($validation->errors()->first(),422);
        }
        Agent::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'regions'=>json_encode($request->regions)
        ]);
        return ResponseController::success();
    }
    public function view(){
        return ResponseController::data(Agent::all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function add(ClientRequest $request){        
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

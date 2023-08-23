<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;

class CategoriesController extends Controller
{
    public function create(Request $request){                
        Category::create([
            'name'=>$request->name
        ]);
        return ResponseController::success();
    }
    public function view(){
        $categories=Category::all();
        return ResponseController::data($categories);
    }
}

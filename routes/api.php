<?php

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CostController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ArrivalController;
use App\Http\Controllers\MakaronController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Categories
Route::post('/categories/create',[CategoriesController::class,'create']);
Route::get('/categories/view',[CategoriesController::class,'view']);

//Products
Route::post('/products/add',[ProductController::class,'add']);
Route::get('/products/view',[ProductController::class,'view']);

//Arrival
Route::post('/arrivals/add',[ArrivalController::class,'add']);
Route::get('/arrivals/view',[ArrivalController::class,'view']);

//Cost
Route::post('/costs/add',[CostController::class,'add']);
Route::get('/costs/view',[CostController::class,'view']);

//Client
Route::post('/clients/add',[ClientController::class,'add']);
Route::get('/clients/view',[ClientController::class,'view']);

//Agent
Route::post('/agents/add',[AgentController::class,'add']);
Route::get('/agents/view',[AgentController::class,'view']);

//Basket
Route::post('/basket/add',[BasketController::class,'add']);
Route::get('/basket/view',[BasketController::class,'view']);

//Delivery
Route::post('/delivery/add',[DeliveryController::class,'add']);
Route::get('/delivery/view/{id}',[DeliveryController::class,'view']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

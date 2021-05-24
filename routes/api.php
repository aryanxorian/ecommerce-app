<?php

use EcommerceApp\Http\Controllers\AddressController;
use EcommerceApp\Http\Controllers\CartController;
use EcommerceApp\Http\Controllers\CheckoutController;
use EcommerceApp\Http\Controllers\ProductController;
use EcommerceApp\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use EcommerceApp\Http\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[UserController::class,'login']);
Route::post('register',[UserController::class,'register']);

Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('logout',[UserController::class,'logout']);
    Route::get('profile',[UserController::class,'profile']);

    Route::group(['middleware' => ['checkUserType']], function(){
        Route::post('addproduct',[ProductController::class,'addProduct'])->name('addproduct');
        Route::delete('deleteproduct/{id}', [ProductController::class,'deleteProduct'])->name('deleteproduct');
    });
    Route::post('addtocart',[CartController::class,'addItem']);
    Route::get('viewcart',[CartController::class, 'viewCart']);
    Route::post('addaddress', [AddressController::class, 'addAddress']);
    Route::get('viewaddress/{id?}', [AddressController::class, 'viewAddress']);
    Route::delete('deleteaddress/{id?}', [AddressController::class, 'deleteAddress']);
    Route::post('checkout/{id}', [CheckoutController::class, 'checkout']);
});

Route::get('listproducts/{id?}', [ProductController::class,'listProduct']);
Route::get('search/{key}', [ProductController::class, 'searchProduct']);

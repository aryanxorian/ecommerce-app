<?php

use EcommerceApp\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use EcommerceApp\Mail\AccountCreated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Hello World!!';
});

Route::get('pay',[PaymentController::class,'checkout']);

Route::get('signup',function(){
    return new AccountCreated();
});

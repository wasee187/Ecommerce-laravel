<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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
    return view('welcome');
});


//group middleware for logged in users
Route::group(['middleware' => ['loggedUser']],function(){
    // login route
    Route::get('/login',function () {
        return view('login');
    });
    Route::post('/login',[AuthController::class,'Login']);
}) ;

Route::get("/logout", function(){
    if(session()->has('user')){
        session()->pull('user');
    }
    return redirect('login');
});

Route::resource('product',ProductController::class);

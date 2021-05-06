<?php

use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::group(['middleware'=>'customAuth'],function(){
    Route::view('register','register');
    Route::view('login','login');
    Route::get('logout','ManageController@logout');
});

// Route::view('register','register');
// Route::view('login','login');
    
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('registerUser','App\Http\Controllers\ManageController@registerUser');
Route::post('loginUser','App\Http\Controllers\ManageController@login');
Route::get('logout', 'App\Http\Controllers\ManageController@logout');

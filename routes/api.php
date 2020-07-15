<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=> 'v1'],function(){
  Route::get('governorates','mainController@governorates');
  Route::get('cities','mainController@cities');
  Route::get('categories','mainController@categories');  //get list of something
  Route::get('settings','mainController@settings');  //get
  Route::post('contacts','mainController@contacts');
  Route::get('bloodtypes','mainController@bloodTypes');  //get
  Route::post('register','AuthController@register');  //get
  Route::post('login','AuthController@login');  //get
  Route::post('reset','AuthController@resetPassword');  //get
  // Route::get('posts','mainController@posts');
//Donot let him path without Authintication at first
  Route::group(['middleware'=>'auth:api'],function(){

   Route::get('posts','mainController@posts');
  });

});
//api/governorates => by default

<?php

use Illuminate\Http\Request;

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

Route::group(array('prefix' => '/'), function() {

  	Route::get('/', function () {
      	return response()->json(['message' => 'Payment API', 'status' => 'Connected']);;
  	});

  	Route::resource('log', 'LogController');
  	
  	Route::resource('payment', 'PaymentController');
  	Route::get('payment/user/{id}', 'PaymentController@index_user')->name('payment.user');
});
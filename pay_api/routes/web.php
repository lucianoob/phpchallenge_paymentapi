<?php

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

Route::post('/register_validation/', 'CheckoutController@register_validation')->name('register_validation');
Route::post('/register_checkout/', 'CheckoutController@register_checkout')->name('register_checkout');
Route::post('/checkout_validation/', 'CheckoutController@checkout_validation')->name('checkout_validation');
Route::post('/register/', 'RegisterController@register')->name('register');

Route::get('/plan/{id}', 'PlanController@show')->name('plan');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
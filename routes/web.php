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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'ControllerProduct@add_product');

Route::get('/home', 'ControllerProduct@get_product')->name('product');

Route::post('/delete/{id}', 'ControllerProduct@delete_product');

Route::post('/buy', 'ControllerOrder@buy_product');

Route::get('/edit/{id}' , 'ControllerProduct@get_info_product');
Route::post('/edit/{id}', 'ControllerProduct@update_product');

Route::get('/kos', 'ControllerOrder@review_order');

Route::post('/kos/{id}', 'ControllerOrder@delete_from_basket');

Route::post('/kos', 'ControllerOrder@place_order');

Route::get('/vase_objednavka' , 'ControllerOrder@placed_order_review');

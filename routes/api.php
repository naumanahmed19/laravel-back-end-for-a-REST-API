<?php


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

Route::resource('apartments', 'ApiApartmentsController');

Route::get('apartments/{param}/edit/{token}', 'ApiApartmentsController@edit');

Route::delete('apartments/{param}/delete/{token}', 'ApiApartmentsController@destroy');

Route::get('apartments/test1/', 'ApiApartmentsController@test1');
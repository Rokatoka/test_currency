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

Route::middleware('auth:api')->get(/**
 * @param Request $request
 * @return mixed
 */ '/user', function (Request $request) {
    return $request->user();
});

Route::get('/currencies', 'API\CurrencyController@getList');
Route::get('/currency', 'API\CurrencyController@getItem');

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

Route::post('login', 'Api\LoginApiController@login')->name('login');
// Route::post('register', 'UserController@register');

Route::post('shelterRequest', 'Api\LoginApiController@shelterRequest')->name('shelterRequest');

Route::get('getRequests/{id}', 'Api\LoginApiController@getRequests')->name('getRequests');

Route::post('requestPasswordReset', 'Api\LoginApiController@requestPasswordReset')->name('requestPasswordReset');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'UserController@details');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

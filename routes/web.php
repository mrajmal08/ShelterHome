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

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

});

Route::get('/', function () {
    return view('auth.login');
});
Route::post('postlogin', [
    'uses' => 'Auth\LoginController@postlogin',
    'as' => 'postlogin'

]);
Route::post('admin-login', [
    'uses' => 'Auth\LoginController@admin_login',
    'as' => 'admin-login'

]);

Route::post('re-generate-password', ['uses' => 'Auth\LoginController@re_generate_password','as' => 're-generate-password']);

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('admin-home', 'AdminController@admin_home')->name('admin-home')->middleware('can:admin');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('volunter-list', 'AdminController@volunter_list')->name('volunter-list')->middleware('can:admin');

Route::get('password-requests', 'AdminController@password_requests')->name('password-requests')->middleware('can:admin');
Route::post('generate-password', 'AdminController@generate_password')->name('generate-password')->middleware('can:admin');

Route::get('add-volunter', 'AdminController@add_volunter')->name('add-volunter')->middleware('can:admin');


Route::post('volunter-save', 'AdminController@volunter_save')->name('volunter-save')->middleware('can:admin');


Route::get('volunter-edit/{id}', 'AdminController@volunter_edit')->name('volunter-edit')->middleware('can:admin');


Route::post('volunter-update', 'AdminController@volunter_update')->name('volunter-update')->middleware('can:admin');


Route::get('volunter-delete/{id}', 'AdminController@volunter_delete')->name('volunter-delete')->middleware('can:admin');
Route::get('pass-request-delete/{id}', 'AdminController@pass_request_delete')->name('pass-request-delete')->middleware('can:admin');

Route::get('missing-person-list', 'AdminController@missing_person_list')->name('missing-person-list')->middleware('can:admin');


Route::get('add-missing-person', 'AdminController@add_missing_person')->name('add-missing-person')->middleware('can:admin');


Route::post('add-missing-save', 'AdminController@missing_save')->name('add-missing-save')->middleware('can:admin');


Route::get('person-delete/{id}', 'AdminController@person_delete')->name('person-delete')->middleware('can:admin');


Route::get('trust-affair', 'AdminController@trust_affair')->name('trust-affair')->middleware('can:admin');

Route::get('facilities-list', 'AdminController@facilities_list')->name('facilities-list')->middleware('can:admin');


Route::post('facalities-save', 'AdminController@facalities_save')->name('facalities-save')->middleware('can:admin');


Route::get('facilites-delete/{id}', 'AdminController@facilites_delete')->name('facilites-delete')->middleware('can:admin');


Route::get('trusties-list', 'AdminController@trusties_list')->name('trusties-list')->middleware('can:admin');

Route::post('trusties-save', 'AdminController@trusties_save')->name('trusties-save')->middleware('can:admin');

Route::get('trusties-delete/{id}', 'AdminController@trusties_delete')->name('trusties-delete')->middleware('can:admin');

Route::get('room-list', 'AdminController@room_list')->name('room-list')->middleware('can:admin');

Route::post('room-save', 'AdminController@room_save')->name('room-save')->middleware('can:admin');


Route::get('room-delete/{id}', 'AdminController@room_delete')->name('room-delete')->middleware('can:admin');

Route::get('admin-shelter-list', 'AdminController@admin_shelter')->name('admin-shelter-list')->middleware('can:admin');

Route::get('delete-shelter-request/{id}', 'AdminController@delete_shelter_request')->name('delete-shelter-request')->middleware('can:admin');


Route::get('admin-shelter-home', 'AdminController@admin_shelter_home')->name('admin-shelter-home')->middleware('can:admin');

Route::post('admin-shelter-home-save', 'AdminController@admin_shelter_home_save')->name('admin-shelter-home-save')->middleware('can:admin');

Route::get('home-delete/{id}', 'AdminController@shelter_home_delete')->name('home-delete')->middleware('can:admin');

Route::post('home-edit', 'AdminController@home_edit')->name('home-edit')->middleware('can:admin');


Route::get('allote-shelter/{id}', 'AdminController@allote_shelter')->name('allote-shelter')->middleware('can:admin');

Route::post('approve-shelter-save', 'AdminController@approve_shelter_save')->name('approve-shelter-save')->middleware('can:admin');

Route::get('homless', 'AdminController@homless')->name('homless')->middleware('can:admin');

Route::get('volunter-home', 'VolunterController@volunter_home')->name('volunter-home')->middleware('can:volunter');


Route::get('volunter-shelter-list', 'VolunterController@volunter_shelter_list')->name('volunter-shelter-list')->middleware('can:volunter');

Route::post('shelter-request-save', 'VolunterController@shelter_request_save')->name('shelter-request-save')->middleware('can:volunter');


Route::get('shelter-delete/{id}', 'VolunterController@shelter_delete')->name('shelter-delete')->middleware('can:volunter');















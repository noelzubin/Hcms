<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

// Doctor
Route::group( ['middleware' => ['web']], function () {
    Route::get('doctor', "DoctorController@home");
    Route::get('doctor/login',  "DoctorController@login");
    Route::post('doctor/login', "DoctorController@logindoc");
    Route::get('doctor/logout', "DoctorController@logout");
    Route::get('doctor/signup', "DoctorController@signup");
    Route::post('doctor/signup', "DoctorController@signupdoc");
});

// Receptions
Route::group( ['middleware' => ['web']], function () {
    Route::get('desk', "ReceptionController@home");
    Route::get('desk/login', "ReceptionController@login");
    Route::post('desk/login', "ReceptionController@logindesk");
    Route::get('desk/logout', "ReceptionController@logout");
});
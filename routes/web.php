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

Route::group(['middleware' => ['auth']], function () {
    //
    Route::resource('/room', 'RoomController');

    // Route::get('/booking', 'RoomSessionController@index');
    // Route::post('/booking', 'RoomSessionController@store');
    // Route::get('/booking/create', 'RoomSessionController@create');
    Route::get('/booking/approve', 'RoomSessionController@roomsessionSubscried');
    Route::put('/booking/approve/{booking}', 'RoomSessionController@approve');
    Route::patch('/booking/approve/{id}', 'RoomSessionController@nonApprove');

    Route::get('/booking/history', 'RoomSessionController@showHistory');
    Route::get('/booking/history/{id}', 'RoomSessionController@removeSubscribe');

    Route::put('/booking/{booking}', 'RoomSessionController@subscribe');
    // Route::put('/booking/{booking}', 'RoomSessionController@roomsessionSubscried');
    Route::resource('/booking', 'RoomSessionController');
    Route::resource('/employee', 'EmployeeController');
});

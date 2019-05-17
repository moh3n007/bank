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


Route::namespace('Backend')->prefix('users')->name('users.')->group(function() {
    Route::get('list', 'UserController@userList')->name('list');
    Route::get('create', 'UserController@createForm')->name('create');
    Route::post('create', 'UserController@create')->name('create');
    Route::get('show/{user}', 'UserController@show')->name('show');
    /*Route::get('info/{dormitory}', 'DormitoryController@info')->name('info');
    Route::post('update/{dormitory}', 'DormitoryController@update')->name('update');
    Route::post('addCover/{dormitory}', 'DormitoryController@addCover')->name('addCover');
    Route::get('removeCover/{dormitory}', 'DormitoryController@removeCover')->name('removeCover');
    Route::get('active/{dormitory}/{mode}', 'DormitoryController@active');*/
});
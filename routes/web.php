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



/** @noinspection PhpParamsInspection */
Route::namespace('Backend')->middleware(['auth','admins'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /** @noinspection PhpParamsInspection */
    Route::prefix('users')->name('users.')->group(function() {
        Route::get('list', 'UserController@userList')->name('list');
        Route::get('create', 'UserController@createForm')->name('create');
        Route::post('create', 'UserController@create')->name('create');
        Route::get('show/{user}', 'UserController@show')->name('show');
        Route::get('show/{user}/edit', 'UserController@edit')->name('edit');
        Route::post('show/{user}/edit', 'UserController@update')->name('update');
        Route::get('show/{user}/delete', 'UserController@delete')->name('delete');
        Route::get('search', 'UserController@search')->name('search');
        /*Route::get('info/{dormitory}', 'DormitoryController@info')->name('info');
        Route::post('update/{dormitory}', 'DormitoryController@update')->name('update');
        Route::post('addCover/{dormitory}', 'DormitoryController@addCover')->name('addCover');
        Route::get('removeCover/{dormitory}', 'DormitoryController@removeCover')->name('removeCover');
        Route::get('active/{dormitory}/{mode}', 'DormitoryController@active');*/
    });

    /** @noinspection PhpParamsInspection */
    Route::prefix('families')->name('families.')->group(function() {
        Route::get('list', 'FamilyController@familyList')->name('list');
        Route::get('create/{family?}', 'FamilyController@createForm')->name('create');
        Route::post('store', 'FamilyController@store')->name('store');
        Route::match(['get','post'],'show/{family}', 'FamilyController@show')->name('show');
        Route::post('show/{family}/edit', 'FamilyController@update')->name('update');
        Route::get('show/{family}/delete', 'FamilyController@delete')->name('delete');
        Route::post('addAccount/{family}', 'FamilyController@addAccount')->name('addAccount');
        Route::get('setHead/{family}/{user}', 'FamilyController@setHead')->name('setHead');
//        Route::get('show/{user}/edit', 'UserController@edit')->name('edit');
//        Route::get('show/{user}/delete', 'UserController@delete')->name('delete');
//        Route::get('search', 'UserController@search')->name('search');
        /*Route::get('info/{dormitory}', 'DormitoryController@info')->name('info');
        Route::post('update/{dormitory}', 'DormitoryController@update')->name('update');
        Route::post('addCover/{dormitory}', 'DormitoryController@addCover')->name('addCover');
        Route::get('removeCover/{dormitory}', 'DormitoryController@removeCover')->name('removeCover');
        Route::get('active/{dormitory}/{mode}', 'DormitoryController@active');*/
    });

    /** @noinspection PhpParamsInspection */
    Route::prefix('loans')->name('loans.')->group(function() {
        Route::post('create/{family}', 'LoanController@store')->name('create');
        Route::get('list', 'LoanController@loanList')->name('list');
        Route::get('monthlyPayments', 'LoanController@monthlyPayments')->name('payments');
        Route::get('show/{loan}', 'LoanController@show')->name('show');
        Route::get('show/{loan}/delete', 'LoanController@delete')->name('delete');
        Route::post('pay', 'LoanController@pay')->name('pay');
        Route::post('payment}', 'LoanController@pay_in_show_loan')->name('payment');
    });

    /** @noinspection PhpParamsInspection */
    Route::prefix('accounts')->name('accounts.')->group(function() {
        Route::get('list', 'AccountController@accountList')->name('list');
        Route::get('create', 'AccountController@createForm')->name('create');
        Route::post('store', 'AccountController@store')->name('store');
        Route::get('show/{account}', 'AccountController@show')->name('show');
        Route::post('show/{account}/edit', 'AccountController@update')->name('update');
        Route::get('show/{account}/delete', 'AccountController@delete')->name('delete');
//        Route::get('show/{user}/edit', 'UserController@edit')->name('edit');
//        Route::get('search', 'UserController@search')->name('search');
        /*Route::get('info/{dormitory}', 'DormitoryController@info')->name('info');
        Route::post('update/{dormitory}', 'DormitoryController@update')->name('update');
        Route::post('addCover/{dormitory}', 'DormitoryController@addCover')->name('addCover');
        Route::get('removeCover/{dormitory}', 'DormitoryController@removeCover')->name('removeCover');
        Route::get('active/{dormitory}/{mode}', 'DormitoryController@active');*/
    });

    /** @noinspection PhpParamsInspection */
    Route::prefix('systemOption')->name('systemOption.')->group(function() {
        Route::get('option', 'SystemOptionController@option')->name('option');
        Route::post('option/{option}/edit', 'SystemOptionController@edit')->name('edit');

    });

});

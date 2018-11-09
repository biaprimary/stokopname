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
    return redirect()->to('login');
})->name('root');

Route::get('unauthorized', function () {
    return view('errors.401');
})->name('unauthorized');

Route::get('signup', 'UsersController@signup')->name('signup');
Route::post('signup', 'UsersController@signup_store')->name('signup.store');
Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@login_store')->name('login.store');
Route::get('logout', 'SessionsController@logout')->name('logout');

Route::get('dashboard', 'AdminController@index')->name('dashboard')->middleware('sentinel', 'sentinel.role');
Route::resource('suppliers', 'SuppliersController');
Route::resource('buyers', 'BuyersController');
Route::resource('categories', 'CategoriesController');
Route::resource('items', 'ItemsController');
Route::resource('transactions', 'TransactionsController');
Route::get('itemcheckstock/{id}', 'ItemsController@checkstock')->name('itemcheckstock');
Route::get('checktransaction/{id}', 'ItemsController@checktransaction')->name('checktransaction');

Route::get('shopping', 'ShoppingsController@index')->name('shopping');
Route::get('cart', 'ShoppingsController@cart')->name('cart');
Route::get('setitem', 'ShoppingsController@setItem')->name('setitem');
Route::get('deleteitem/{id}', 'ShoppingsController@deleteItem')->name('deleteitem');
Route::get('buy', 'ShoppingsController@buy')->name('buy');

Route::get('report', 'ReportsController@index')->name('report');
Route::post('reportdownload','ReportsController@reportdownload')->name('reportdownload');
Route::get('downloadtemplate/{type}', 'ItemsController@downloadtemplate')->name('downloadtemplate');
Route::post('importtemplate', 'ItemsController@importtemplate')->name('importtemplate');

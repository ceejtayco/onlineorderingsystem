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


Route::get('/admin/login','AdminController@login')->name('admin.login');


Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin/index','AdminController@index')->name('admin.index');
    Route::get('/admin/manage-categories','CategoryController@index')->name('admin.category');
    Route::get('/admin/manage-categories/create','CategoryController@create')->name('admin.category.create');
});
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
    // CATEGORY
    Route::get('/admin/manage-categories','CategoryController@index')->name('admin.category');
    Route::get('/admin/manage-categories/create','CategoryController@create')->name('admin.category.create');
    Route::post('/admin/manage-categories/store','CategoryController@store')->name('admin.category.store');
    
    // ITEMS
    Route::get('/admin/manage-items','ItemsController@index')->name('admin.items');
    Route::get('/admin/manage-items/create','ItemsController@create')->name('admin.items.create');
    Route::post('/admin/manage-items/store','ItemsController@store')->name('admin.items.store');

    // COUPON
    Route::get('/admin/manage-coupons', 'CouponController@index')->name('admin.coupon');
    Route::get('/admin/manage-coupons/create', 'CouponController@create')->name('admin.coupon.create');
    Route::post('/admin/manage-coupons/store', 'CouponController@store')->name('admin.coupon.store');
});
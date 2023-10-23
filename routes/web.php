<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

// Middleware route
// Route::group(['middleware' => ['auth', 'staff']], function () {
//     // Staff and Admin Dashboard Routes
//     Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    
//     // Admin-Only Routes
//     Route::group(['middleware' => 'admin'], function () {
//         Route::get('/user-management', 'Admin\UserManagementController@index')->name('admin.user-management');
//     });
// });

// Route::group(['middleware' => ['auth', 'customer']], function () {
//     // Customer Dashboard Routes
//     Route::get('/customer/dashboard', 'Customer\DashboardController@index')->name('customer.dashboard');
// });

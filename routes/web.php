<?php

use App\Http\Controllers\PackageController;
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

Route::get('/', function () {
    return view('homePage');
})->name('homePage');

//customer side packages
Route::get('/tourPackages', [PackageController::class, 'displayPackages'])->name('packages');
Route::get('/itinerary/{id}', [PackageController::class, 'displayItinerary'])->name('itinerary');









// Route::get('/tourPackages', function () {
//     return view('packages');
// })->name('tourPackages');

Route::get('/news', function () {
    return view('news');
})->name('news');

// Route::get('/itinerary', function () {
//     return view('itinerary');
// })->name('itinerary');


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
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index'])->where('page', 'dashboard');
});


Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [PackageController::class, 'store'])->name('pages.store');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

// Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');
Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

Route::get('/package/edit/{id}', [PackageController::class, 'editPackage'])->name('editPackage');
Route::put('/package/{id}', [PackageController::class, 'updatePackage'])->name('package.updatePackage');

Route::get('/tour/edit/{id}', [PackageController::class, 'editTour'])->name('editTour');
Route::put('/tour/{id}', [PackageController::class, 'updateTour'])->name('package.updateTour');

Route::get('/itinerary/edit/{id}', [PackageController::class, 'editItinerary'])->name('editItinerary');
Route::put('/itinerary/{id}', [PackageController::class, 'updateItinerary'])->name('package.updateItinerary');




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

//client side


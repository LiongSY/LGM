<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	// Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
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

//admin
Route::get('/admin/addStaff', [AdminController::class, 'create'])->name('admin.addStaff');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/staff', [UserController::class, 'index'])->name('users.index');
Route::delete('/staff/{staff}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::put('profile', [ProfileController::class, 'password'])->name('editPassword');
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');

//customers list
Route::get('/customers', [CustomerController::class, 'index'])->name('users.customers');


//passport
Route::post('/passports', [PassportController::class, 'store'])->name('passport.store');
Route::get('/passports/edit/{passportNo}', [PassportController::class, 'edit'])->name('passport.edit');
Route::put('/passport/update/{passportNo}', [PassportController::class, 'update'])->name('passport.update');


//beneficiary
Route::post('/beneficiary', [BeneficiaryController::class, 'store'])->name('beneficiary.store');
Route::get('/beneficiary/edit/{benID}', [BeneficiaryController::class, 'edit'])->name('beneficiary.edit');
Route::put('/beneficiary/update/{benID}', [BeneficiaryController::class, 'update'])->name('beneficiary.update');


//booking
// Route::post('/booking', [NotificationController::class, 'store'])->name('booking');
// Route::get('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');



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


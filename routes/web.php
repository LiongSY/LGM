<?php
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\PackageComparisonController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BookingHistoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PackageController::class, 'displayTrendingPackage'])->name('homePage');


// Route::get('/booking', function () {
//     return view('booking');
// })->name('booking');

Route::get('/customerProfile', function () {
    return view('profile');
})->name('customerProfile');




// Route::middleware(['auth'])->group(function () {
// Route::get('/customerProfile/{id}', [CustomerController::class,'view'])->name('customerProfile.view');
Route::get('/customerProfile/edit', [CustomerController::class, 'edit'])->name('customerProfile.edit');
Route::put('/customerProfile/update/{id}', [ProfileController::class, 'update'])->name('customerProfile.update');
// });
//customer side packages
Route::get('/tourPackages', [PackageController::class, 'displayPackages'])->name('packages');
Route::get('/itinerary/{id}', [ItineraryController::class, 'displayItineraries'])->name('itinerary');

//search
Route::get('/displayPackages', [PackageController::class, 'displayPackages'])->name('displayPackages');

//package comparison
Route::get('/search-packages', [PackageController::class, 'search'])->name('search-packages');
Route::get('/compare-packages', [PackageComparisonController::class, 'compare'])->name('compare-packages');

// bookinghistory
Route::get('/bookingHistory', [BookingHistoryController::class, 'index'])->name('bookingHistory');
// Route::get('/tourPackages', function () {
//     return view('packages');
// })->name('tourPackages');
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('customerBooking');

Route::get('/search', [PackageController::class, 'search'])->name('search');


Route::get('/news', function () {
    return view('news');
})->name('news');

//about us
Route::get('/aboutUs', function () {
    return view('aboutUs');
})->name('aboutUs');


// Route::get('/itinerary', function () {
//     return view('itinerary');
// })->name('itinerary');


Auth::routes();

//ADMIN ROUTES
Route::group(['middleware' => 'admin'], function () {
    //admin
    
Route::delete('/staff/{staff}', [AdminController::class, 'destroy'])->name('staff.destroy');
Route::get('/admin/addStaff', [AdminController::class, 'create'])->name('admin.addStaff');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/staff', [UserController::class, 'index'])->name('users.index');

   
});


//STAFF OR ADMIN ROUTES
Route::group(['middleware' => 'staff_or_admin'], function () {
    // Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index'])->where('page', 'dashboard');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dashboard', [PusherController::class, 'index'])->name('dashboard');
    //package
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [PackageController::class, 'store'])->name('pages.store');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::get('/package/edit/{id}', [PackageController::class, 'editPackage'])->name('editPackage');
    Route::put('/package/{id}', [PackageController::class, 'updatePackage'])->name('package.updatePackage');
    //tour
    Route::get('/tour/edit/{id}', [PackageController::class, 'editTour'])->name('editTour');
    Route::put('/tour/{id}', [PackageController::class, 'updateTour'])->name('package.updateTour');
    //itinerary
    Route::get('/itinerary/edit/{id}', [PackageController::class, 'editItinerary'])->name('editItinerary');
    Route::put('/itinerary/{id}', [PackageController::class, 'updateItinerary'])->name('package.updateItinerary');

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
    Route::get('/staff/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/staff/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/staff/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/staff/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::delete('/staff/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::patch('/booking/{booking}/updateStatus', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');

});

//CUSTOMERS ROUTES
Route::group(['middleware' => 'customer'], function () {

});



Route::group(['middleware' => 'auth'], function () {
});




Route::get('/itinerary/generate/{id}', [PackageController::class, 'generateItinerary'])->name('generateItinerary');

Route::put('profile', [ProfileController::class, 'password'])->name('editPassword');
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');


//botman
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

//Currency
Route::post('/currency', [CurrencyController::class, 'convert'])->name('currency.update');

//Chat

Route::get('/chat', [PusherController::class, 'index'])->name('chat.index');
Route::get('/chat/{userID}', [PusherController::class, 'show'])->name('chat.show');
// Route::get('/liveChat/{id}', [PusherController::class, 'liveChat'])->name('chat.liveChat');

Route::post('/broadcast', [PusherController::class, 'broadcast']);
Route::post('/receive', [PusherController::class, 'receive']);

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


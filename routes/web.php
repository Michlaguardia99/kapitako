<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified; // Import the middleware
use App\Http\Controllers\UserAlertController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Authentication routes with email verification
Auth::routes(['verify' => true]);

// Route Group with 'auth' and 'verified' Middleware
Route::group(['middleware' => ['auth', 'verified']], function () {
    // The following routes are accessible only to authenticated and verified users
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');
    
});
// Routes accessible only to non-verified users
Route::group(['middleware' => ['auth', 'guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Routes accessible only to verified users
Route::group(['middleware' => ['auth', 'verified', EnsureEmailIsVerified::class]], function () {
    // The following routes are accessible only to authenticated, verified, and email-verified users
    Route::get('/home', 'HomeController@index')->name('home');
    
    // Other routes inside the group...
});

// Define the route to store user alerts
Route::post('user/alerts', [UserAlertController::class, 'store'])->name('user.alerts.store');
<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/create-symlink', function (){
            symlink(storage_path('/app/public'), public_path('storage'));
            echo "Symlink Created. Thanks";
        });
});


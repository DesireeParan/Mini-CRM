<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/employees/index', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
Route::get('/companies/index', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');

Route::resource('/employees', App\Http\Controllers\EmployeeController::class)->except(['index']);
Route::resource('/companies', App\Http\Controllers\CompanyController::class)->except(['index']);


Route::get('/settings/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::middleware(['auth'])->group(function () {
    Route::get('settings/change-password', [App\Http\Controllers\ChangePasswordController::class, 'show'])->name('password.change');
    Route::post('settings/change-password', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('password.update');
});
/*Route::get('lang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang.switch'); */

//Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');
Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLang']);

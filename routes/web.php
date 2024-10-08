<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/employees/index', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
Route::get('/admin/companies/index', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');

Route::resource('admin/employees', App\Http\Controllers\EmployeeController::class)->except(['index']);
Route::resource('admin/companies', App\Http\Controllers\CompanyController::class)->except(['index']);


Route::get('admin/settings/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('admin/settings/change-password', [App\Http\Controllers\ChangePasswordController::class, 'show'])->name('password.change');
Route::post('admin/settings/change-password', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('password.update');

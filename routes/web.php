<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

if (Auth::check() && Auth::user()->role == "admin"){
Route::resource('company', App\Http\Controllers\CompanyController::class, ['except' => [
    'create', 'update'
]]);
Route::resource('employee', App\Http\Controllers\EmployeesController::class, ['except' => [
    'create', 'update'
]]);
Route::get('/dropdown', [App\Http\Controllers\EmployeesController::class, 'dropdown'])->name('dropdown');
} else {
    Route::get('/company', [App\Http\Controllers\CompanyController::class, 'view_user'])->name('company.view_user'); 
    Route::get('/employee', [App\Http\Controllers\EmployeesController::class, 'view_user'])->name('employee.view_user'); 
}
});



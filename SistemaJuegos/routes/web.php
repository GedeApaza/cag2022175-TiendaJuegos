<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
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

//admin
Route::get('/admin/login-form',[AdminController::class,'login_form'])->name('login.form');
Route::post('/admin/login-functionality',[AdminController::class,'authenticate'])->name('admin.login.functionality');

//cliente
Route::get('/cliente/login-form',[ClienteController::class,'login_form'])->name('cliente.login.form');
Route::post('/cliente/login-functionality',[ClienteController::class,'authenticate'])->name('cliente.login.functionality');


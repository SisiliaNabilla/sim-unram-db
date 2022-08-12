<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
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
Route::get('register_admin',[AdminController::class,'register_admin'])->name('register_admin');
Route::post('simpan_data_admin_baru',[AdminController::class,'simpan_data_admin_baru'])->name('simpan_data_admin_baru');
Route::get('login_admin',[AdminController::class,'login_admin'])->middleware('AdminLoggedIn');
Route::post('cek_login_admin',[AdminController::class,'cek_login_admin'])->name('cek_login_admin');
Route::get('dashboard_admin',[AdminController::class,'dashboard_admin'])->name('dashboard_admin');
Route::get('logout_admin',[AdminController::class,'logout_admin'])->name('logout_admin');
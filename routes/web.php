<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('user', UserController::class)
->middleware('checkRole:superadmin');
Route::resource('akun', AkunController::class)
->middleware('checkRole:superadmin');
Route::resource('barang', BarangController::class)
->middleware('checkRole:admin,superadmin');
Route::resource('peminjaman', PeminjamanController::class)
->middleware('checkRole:superadmin,admin,user');
Route::post('/report/date_report_session', [PeminjamanController::class, 'date_report_session'])->name('date_report_session.post');
Route::get('/report/show_report_session', [PeminjamanController::class, 'show_report_session'])->name('show_report_session');
Route::get('/token', function () {
    return csrf_token(); 
});

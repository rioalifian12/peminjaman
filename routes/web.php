<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('user', UserController::class)
->middleware('checkRole:superadmin');

Route::resource('akun', AkunController::class)
->middleware('checkRole:superadmin');

Route::resource('barang', BarangController::class)
->middleware('checkRole:admin,superadmin,user');
Route::resource('permintaan', PermintaanController::class)
->middleware('checkRole:admin,superadmin,user');
Route::post('/import', [BarangController::class, 'importData'])->name('importData.post');
Route::get('/export', [BarangController::class, 'exportData'])->name('exportData');

Route::resource('peminjaman', PeminjamanController::class)
->middleware('checkRole:superadmin,admin,user');
Route::post('/report/date_report_session', [PeminjamanController::class, 'date_report_session'])->name('date_report_session.post');
Route::get('/report/show_report_session', [PeminjamanController::class, 'show_report_session'])->name('show_report_session');
Route::get('/scan/peminjaman_by_kode_barang/{kode_barang}', [PeminjamanController::class, 'peminjaman_by_kode_barang'])->name('peminjaman_by_kode_barang');
Route::get('/token', function () {
    return csrf_token(); 
});

Route::controller(PeminjamanController::class)->group(function(){
    Route::get('/peminjaman', 'index');
    Route::get('/autocomplete11', 'autocomplete11')->name('autocomplete11');
    Route::get('/autocomplete12', 'autocomplete12')->name('autocomplete12');
    Route::get('/autocomplete13', 'autocomplete13')->name('autocomplete13');
    Route::get('/autocomplete14', 'autocomplete14')->name('autocomplete14');
});

Route::controller(PermintaanController::class)->group(function(){
    Route::get('/permintaan', 'index');
    Route::get('/autocomplete', 'autocomplete')->name('autocomplete');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/user', 'index');
    Route::get('/autocomplete1', 'autocomplete1')->name('autocomplete1');
    Route::get('/autocomplete2', 'autocomplete2')->name('autocomplete2');
    Route::get('/autocomplete3', 'autocomplete3')->name('autocomplete3');
});

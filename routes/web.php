<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JusBuahController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\TransPenjualanController;
use App\Http\Controllers\UserController;
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

// autentication
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/aksilogin', [AuthController::class, 'authenticate'])->name('aksilogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard
Route::get('/home',[DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::get('/im', [DashboardController::class, 'profil'])->name('im')->middleware('auth');
Route::put('/ubahprofil/{id}', [DashboardController::class, 'update'])->name('ubahprofil')->middleware('auth');

// data master
Route::resource('/usr', UserController::class)->middleware('auth');
Route::resource('/ma', MakananController::class)->middleware('auth');
Route::resource('/mi', MinumanController::class)->middleware('auth');
Route::resource('/jb', JusBuahController::class)->middleware('auth');

// data penjualan
Route::get('/p', [TransPenjualanController::class, 'index'])->name('p')->middleware('auth');
Route::get('/ip', [TransPenjualanController::class, 'create'])->name('ip')->middleware('auth');
Route::get('/dp/{no_trans}', [TransPenjualanController::class, 'show'])->middleware('auth');
Route::get('/dp/{no_trans}/edit', [TransPenjualanController::class, 'show'])->middleware('auth');
Route::get('/data_transaksi', [TransPenjualanController::class, 'json'])->name('data_transaksi')->middleware('auth');
Route::get('/cetak/{no_trans}', [TransPenjualanController::class, 'cetak'])->name('cetak')->middleware('auth');
Route::post('/simpan', [TransPenjualanController::class, 'store'])->name('simpan')->middleware('auth');
Route::delete('/hp/{no_trans}', [TransPenjualanController::class, 'destroy'])->middleware('auth');

// data rekap penjualan
Route::get('/rl', [TransPenjualanController::class, 'rekap'])->name('rl')->middleware('auth');
Route::get('/rh', [TransPenjualanController::class, 'rekap_harian'])->name('rh')->middleware('auth');
Route::get('/rs/{id}', [TransPenjualanController::class, 'rekap_show'])->name('rs')->middleware('auth');
Route::get('/dr', [TransPenjualanController::class, 'json_rekap'])->name('dr')->middleware('auth');
Route::put('/ur/{id}', [TransPenjualanController::class, 'update_rekap'])->name('ur')->middleware('auth');
Route::post('/save_rekap', [TransPenjualanController::class, 'save'])->name('save_rekap')->middleware('auth');
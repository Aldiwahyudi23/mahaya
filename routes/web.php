<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemasukanController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PengeluaranController;
use App\Models\Pemasukan;

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

// Pemasukan Admin

// pemasukan
route::get('pemasukan/setor',[PemasukanController::class, 'index'])->name('pemasukan.setor');
Route::post('Pemasukan/setor/tambah',[PemasukanController::class,'tambah']);
Route::get('Pemasukan/setor/edit{id}',[PemasukanController::class,'edit']);
Route::post('Pemasukan/setor/update/{id}',[PemasukanController::class,'update']);
// Pengeluaran
Route::get('pengeluaran/tarik', [PengeluaranController::class,'index'])->name('pengeluaran.tarik');
Route::post('pengeluaran/tarik/tambah', [PengeluaranController::class,'tambah']);
// Pengguna
Route::get('pengguna',[UserController::class,'index'])->name('pengguna');


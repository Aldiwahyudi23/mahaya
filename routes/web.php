<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\OrderController;
use App\Models\Kehadiran;

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
Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// pengumuman
Route::get('/admin/pengumuman', [PengumumanController::class,'index'])->name('admin.pengumuman');
Route::post('/admin/pengumuman/simpan', [PengumumanController::class,'simpan'])->name('admin.pengumuman.simpan');
// data detail
Route::get('/pengeluaran/detail', [PengeluaranController::class,'pengeluaran_detail']);
Route::get('/pemasukan/detail', [PemasukanController::class,'pemasukan_detail']);
// bayar pinjaman
Route::get('/pemasukan/bayar/{id}/pinjaman',[PengajuanController::class,'bayar_pinjaman']);
Route::post('/pemasukan/bayar/pinjaman',[PengajuanController::class,'bayar_pinjam_tambah']);
// Pemberitahuan
Route::get('/laporan/pemasukan/{id}/detail',[PemasukanController::class, 'pembayaran_lihat']);

Route::get('anggaran/{id}/detail', [AnggaranController::class,'detail']);
// profile
Route::get('/profile', [UserController::class,'profile'])->name('profile');
Route::get('/pengaturan/profile', [UserController::class,'edit_profile'])->name('pengaturan.profile');
Route::post('/pengaturan/ubah-profile', [UserController::class,'ubah_profile'])->name('pengaturan.ubah-profile');
Route::get('/pengaturan/edit-foto', [UserController::class,'edit_foto'])->name('pengaturan.edit-foto');
Route::post('/pengaturan/ubah-foto', [UserController::class,'ubah_foto'])->name('pengaturan.ubah-foto');
Route::get('/pengaturan/email', [UserController::class,'edit_email'])->name('pengaturan.email');
Route::post('/pengaturan/ubah-email', [UserController::class,'ubah_email'])->name('pengaturan.ubah-email');
Route::get('/pengaturan/password', [UserController::class,'edit_password'])->name('pengaturan.password');
Route::post('/pengaturan/ubah-password', [UserController::class,'ubah_password'])->name('pengaturan.ubah-password');
// routes/web.php

//Route untuk user Admin
Route::group(['middleware' => ['auth', 'checkRole:Admin,Bendahara,Sekertaris,Ketua']], function () {
    // pemasukan
    route::get('pemasukan/setor',[PemasukanController::class, 'index'])->name('pemasukan.setor');
    Route::post('Pemasukan/setor/tambah',[PemasukanController::class,'tambah']);
    Route::post('Pemasukan/setor_tunai/tambah',[PemasukanController::class,'pembayaran']);
    Route::get('Pemasukan/setor/{id}/edit',[PemasukanController::class,'edit']);
    Route::post('Pemasukan/setor/{id}/update',[PemasukanController::class,'update']);
    Route::get('Pemasukan/setor/{id}/hapus',[PemasukanController::class,'hapus']);
    // Pengeluaran
    Route::get('pengeluaran/tarik', [PengeluaranController::class,'index'])->name('pengeluaran.tarik');
    Route::get('pengeluaran/tarik/{id}/detail',[PengeluaranController::class,'detail']);
    Route::post('pengeluaran/tarik/tambah',[PengeluaranController::class,'tambah']);
    Route::get('pengeluaran/tarik/{id}/edit',[PengeluaranController::class,'edit']);
    Route::post('pengeluaran/tarik/{id}/update',[PengeluaranController::class,'update']);
    Route::get('pengeluaran/tarik/{id}/hapus',[PengeluaranController::class,'hapus']);

    // Anggaran
    Route::get('anggaran', [AnggaranController::class,'index'])->name('anggaran');
    Route::post('anggaran/tambah', [AnggaranController::class,'tambah']);
    Route::get('anggaran/{id}/edit', [AnggaranController::class,'edit']);
    Route::post('anggaran/{id}/update', [AnggaranController::class,'update'])->name('anggaran.update');
    Route::get('anggaran/{id}/hapus', [AnggaranController::class,'hapus']);

    // Pprogram
    Route::get('program', [ProgramController::class,'index'])->name('program');
    Route::post('program/tambah', [ProgramController::class,'tambah']);
    Route::get('program/{id}/detail', [ProgramController::class,'detail']);
    Route::get('program/{id}/edit', [ProgramController::class,'edit']);
    Route::post('program/{id}/update', [ProgramController::class,'update'])->name('program.update');
    Route::get('program/{id}/hapus', [ProgramController::class,'hapus']);

    // Pengurus
    Route::get('pengurus', [PengurusController::class,'index'])->name('pengurus');
    Route::post('pengurus/tambah', [PengurusController::class,'tambah']);
    Route::get('pengurus/{id}/edit', [PengurusController::class,'edit']);
    Route::post('pengurus/{id}/update', [PengurusController::class,'update'])->name('pengurus.update');
    Route::get('pengurus/{id}/hapus', [PengurusController::class,'hapus']);

    // Pengajuan
    route::get('pengajuan/setor/anggota',[PemasukanController::class, 'pengajuan'])->name('pengajuan.bayar.anggota');
    route::get('pengajuan/setor/anggota/{id}/lihat',[PemasukanController::class, 'pengajuan_lihat']);
    Route::post('pengajuan/setor/anggota/tambah',[PemasukanController::class,'pengajuan_tambah']);
 
    route::get('pengajuan/pinjam/anggota',[PengeluaranController::class, 'pengajuan'])->name('pengajuan.pinjaman.anggota');
    route::get('pengajuan/pinjam/anggota/{id}/lihat',[PengeluaranController::class, 'pengajuan_lihat']);
    Route::post('pengajuan/pinjam/anggota/tambah',[PengeluaranController::class,'pengajuan_tambah']);
 
    route::get('pengajuan/bayar/anggota',[PemasukanController::class, 'bayar_pinjam'])->name('bayar_pinjam.anggota');
    route::get('pengajuan/bayar/anggota/{id}/lihat',[PemasukanController::class, 'bayar_pinjam_lihat']);
    Route::post('pengajuan/bayar/anggota/tambah',[PemasukanController::class,'bayar_pinjam_tambah']);

   
});
// Pengguna
Route::get('pengguna',[UserController::class,'index'])->name('pengguna');


// Anggota
    // bayar
        route::get('pemasukan/setor/anggota',[PengajuanController::class, 'bayar'])->name('pengajuan.setor.anggota');
        Route::post('Pemasukan/setor/anggota/tambah',[PengajuanController::class,'bayar_tambah']);
    // Pinjam
        route::get('pengluaran/pinjam/anggota',[PengajuanController::class, 'pinjam'])->name('pengajuan.pinjam.anggota');
        Route::post('pengluaran/pinjam/anggota/tambah',[PengajuanController::class,'pinjam_tambah']);

        Route::post('kehadiran/acara/tahunan/keluaraga-ma-haya',[HomeController::class,'store']);


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as AuthCont;
use PharIo\Manifest\Author;
use App\Http\Controllers\HomeController as HomeCont;
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

Route::get('/login', [AuthCont::class, 'login']);
Route::get('/register', [AuthCont::class, 'register']);
Route::post('/cek_user', [AuthCont::class, 'cek_user']);
Route::post('/simpan_user', [AuthCont::class, 'simpan_user']);
Route::post('/logout', [AuthCont::class, 'logout']);

Route::get('/dashboard', [HomeCont::class, 'dashboard'])->name('dashboard');

//route penghutang
Route::get('/lihat_penghutang', [HomeCont::class, 'lihat_penghutang'])->name('penghutang.lihat');
Route::get('/tambah_penghutang', [HomeCont::class, 'tambah_penghutang']);
Route::post('/update_penghutang', [HomeCont::class, 'update_penghutang']);

//route hutang
Route::get('/tambah_hutang', [HomeCont::class, 'tambah_hutang'])->name('hutang.tambah');
Route::post('/hutang_masuk', [HomeCont::class, 'hutang_masuk']);
Route::get('/lihat_hutang', [HomeCont::class, 'lihat_hutang'])->name('lihat_hutang');
Route::get('/pilih_penghutang', [HomeCont::class, 'pilih_penghutang'])->name('pilih_penghutang');
Route::get('/form_bayar_hutang/{penghutang_id}', [HomeCont::class, 'form_bayar_hutang']);
Route::post('/bayar_hutang', [HomeCont::class, 'bayar_hutang']);
Route::get('/form_ubah_hutang/{penghutang_id}/{id}', [HomeCont::class, 'form_ubah_hutang'])->name('form_ubah_hutang');
Route::put('/update_hutang', [HomeCont::class, 'update_hutang'])->name('update_hutang');

//Riwayat
Route::get('/riwayat_masuk', [HomeCont::class, 'riwayat_masuk']);
Route::get('/riwayat_dibayar', [HomeCont::class, 'riwayat_dibayar']);
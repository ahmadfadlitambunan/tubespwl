<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmGuruController;
use App\Http\Controllers\GuruCmsController;
use App\Http\Controllers\AdminCmsController;
use App\Http\Controllers\KelasCmsController;
use App\Http\Controllers\BeritaCmsController;
use App\Http\Controllers\MetodeCmsController;
use App\Http\Controllers\KategoriCmsController;
use App\Http\Controllers\TabunganCmsController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SiswaCmsController;
use App\Http\Controllers\PembayaranCmsController;
use App\Http\Controllers\DashboardGuruInputController;

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

Route::get('/', function(){
    return redirect()->route('login');
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('postlogin', [LoginController::class, 'logManage'])->name('postLogin');
Route::post('/logout', [LoginController::class, 'logout']);

// routing khusus untuk admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:user', 'ceklevel:admin']], function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.index');

    // CMS
    Route::resource('/crud/admins', AdminCmsController::class);
    Route::resource('/crud/guru', GuruCmsController::class);
    Route::resource('/crud/tabungan', TabunganCmsController::class);
    Route::resource('/crud/metode', MetodeCmsController::class);
    Route::resource('/crud/berita', BeritaCmsController::class);
    Route::resource('/crud/kelas', KelasCmsController::class);
    Route::resource('/crud/murid', SiswaCmsController::class);
    Route::resource('/crud/kategori', KategoriCmsController::class);
    Route::resource('/crud/pembayaran', PembayaranCmsController::class);

    // virifikasi tabungan
    Route::get('/tabungan/verif', [TabunganCmsController::class, 'needverif'])->name('saving.needverif');
    Route::put('/tabungan/verif/{saving}', [TabunganCmsController::class, 'verify'])->name('saving.verify');

    // import csv
    Route::post('/import/admin', [AdminCmsController::class, 'importExcel'])->name('user.import');
    Route::post('/import/siswa', [SiswaCmsController::class, 'importCsv'])->name('murid.import');

    // export
    Route::get('/export/admin', [AdminCmsController::class, 'exportExcel'])->name('user.export');
    Route::get('/export/guru', [GuruCmsController::class, 'exportExcel'])->name('guru.export');
    Route::get('/export/kelas', [KelasCmsController::class, 'exportExcel'])->name('kelas.export');
    Route::get('/export/siswa-xlsx', [SiswaCmsController::class, 'exportExcel'])->name('murid.exportXlsx');
    Route::get('/export/siswa-csv', [SiswaCmsController::class, 'exportCsv'])->name('murid.exportCsv');
    Route::get('/export/tabungan-m', [TabunganCmsController::class, 'exportExcelM'])->name('tabungan.export.m');
    Route::get('/export/tabungan-d', [TabunganCmsController::class, 'exportExcelD'])->name('tabungan.export.d');

    // searching
    Route::get('/berita/checkSlug', [BeritaCmsController::class, 'checkSlug']);
    Route::get('/search', [DashboardAdminController::class, 'search'])->name('search');
});


// routing khusus untuk murid
Route::group(['prefix' => 'siswa', 'middleware' => ['auth:student']], function () {
    Route::get('/', [StudentController::class, 'index'])->name('siswa.index');

    // profile
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('siswa.profile');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('siswa.edit');
    Route::get('/ubah-password', [StudentProfileController::class, 'reset'])->name('siswa.reset');
    Route::post('/ubah-password', [StudentProfileController::class, 'updatePass'])->name('siswa.updatePass');
    Route::put('/profile/{siswa}', [StudentProfileController::class, 'store'])->name('siswa.update');

    // menabung dan history
    Route::get('/menabung', [StudentController::class, 'menabung'])->name('menabung');
    Route::post('/create', [StudentController::class, 'create'])->name('siswa.create');
    Route::get('/history', [StudentController::class, 'history'])->name('siswa.history');
    Route::get('/history/save', [StudentController::class, 'exportExcel'])->name('tabungan-siswa.export');
});


// routing untuk profile guru dan admin
Route::group(['prefix' => 'admin-guru', 'middleware' => ['auth:user']], function () {
    Route::get('/profile', [AdmGuruController::class, 'index'])->name('adm-gru.index');
    Route::get('/profile/edit', [AdmGuruController::class, 'edit'])->name('adm-gru.edit');
    Route::put('/profile/{user}', [AdmGuruController::class, 'store'])->name('adm-gru.update');
    Route::get('/ubah-password', [AdmGuruController::class, 'reset'])->name('adm-gru.reset');
    Route::post('/ubah-password', [AdmGuruController::class, 'updatePass'])->name('adm-gru.updatePass');
});


Route::group(['prefix' => 'guru', 'middleware' => ['auth:user', 'ceklevel:guru']], function () {
    Route::resource('/', DashboardGuruController::class);
    Route::resource('/input', DashboardGuruInputController::class);
    Route::get('/export/siswa-class', [DashboardGuruInputController::class, 'exportExcel'])->name('exportSiswaKls');
});

Route::group(['middleware' => ['auth:user,student']], function () {
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{post:slug}', [BeritaController::class, 'show'])->name('berita.tampil');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmGuruController;
use App\Http\Controllers\AdminCmsController;
use App\Http\Controllers\StudentProfileController;

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
    return view('layouts.main');
});


Route::get('/admin', function(){
    return view('admins.index');
})->middleware('auth:user,student');

Route::get('/admin/tabungan', function(){
    return view('admins.tabungan.index');
});

Route::get('/berita', function(){
    return view('admins.posts');
});


Route::get('/login', function(){
    return view('login.index');
})->middleware('guest')->name('login');

Route::post('postlogin', [LoginController::class, 'logManage'])->name('postLogin');
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'admin'], function(){
    Route::resource('/crud/admins', AdminCmsController::class);
});

// Route::get('/profile', function(){
//     return view('students.profile.index', [
//         'for' => 'profile'
//     ]);
// });

Route::group([['prefix' => 'siswa'], ['middleware' => 'auth:student']], function(){
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('siswa.profile');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('siswa.edit');
    Route::get('/ubah-password', [StudentProfileController::class, 'reset'])->name('siswa.reset');
    Route::post('/ubah-password', [StudentProfileController::class, 'updatePass'])->name('siswa.updatePass');
    Route::put('/profile/{siswa}', [StudentProfileController::class, 'store'])->name('siswa.update');
});


Route::group(['prefix' => 'admin-guru'], function(){
    Route::get('/profile', [AdmGuruController::class, 'index'])->name('adm-gru.index');
    Route::get('/profile/edit', [AdmGuruController::class, 'edit'])->name('adm-gru.edit');
    Route::put('/profile/{user}', [AdmGuruController::class, 'store'])->name('adm-gru.update');
    Route::get('/ubah-password', [AdmGuruController::class, 'reset'])->name('adm-gru.reset');
    Route::post('/ubah-password', [AdmGuruController::class, 'updatePass'])->name('adm-gru.updatePass');
});








// Route::group(['prefix' => 'guru', 'middleware' => ['auth:user']], function(){

// });

// Route::group(['prefix' => 'siswa', 'middleware' => ['auth:user']], function(){
//     route::get('/menabung', [MenabungController::class, 'create']);
//     route::post('/menabung', [MenabungController::class, 'store']);
// });
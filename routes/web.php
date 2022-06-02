<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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





















// Route::group(['prefix' => 'admin', 'middleware' => ['auth:user']], function(){

// });

// Route::group(['prefix' => 'guru', 'middleware' => ['auth:user']], function(){

// });

// Route::group(['prefix' => 'siswa', 'middleware' => ['auth:user']], function(){

// });
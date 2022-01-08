<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthController::class, 'todoLogin'])->name('user.todoLogin');
Route::post('login', [AuthController::class, 'login'])->name('user.login');
Route::get('registrasi', [AuthController::class, 'todoRegistrasi'])->name('user.todoRegistrasi');
Route::post('registrasi', [AuthController::class, 'registrasi'])->name('user.registrasi');

Route::middleware('user')->group(function () {
    Route::get('', [BarangController::class, 'index'])->name('barang.index');
    Route::get('create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('update', [BarangController::class, 'update'])->name('barang.update');
    Route::post('delete', [BarangController::class, 'delete'])->name('barang.delete');
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
});
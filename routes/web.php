<?php

use Illuminate\Support\Facades\Route;
use app\http\controllers\database;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin'])->name('admin-dashboard');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("questions", [\App\Http\Controllers\QuestionController::class, 'index'])->name('list-questions');

Route::get("questions/create", [\App\Http\Controllers\QuestionController::class, 'create'])->name('create-question');

Route::post("questions/store", [\App\Http\Controllers\QuestionController::class, 'store'])->name('store-question');


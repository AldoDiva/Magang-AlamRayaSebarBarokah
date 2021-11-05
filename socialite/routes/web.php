<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxProjectController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashController;
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
    return view('auth/login');
});

Auth::routes();



Route::get('/detail', [DetailController::class, 'index'])->name('detail');
Route::get('/dash', [DashController::class, 'Dashboard'])->name('dash');

Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('home', [AjaxProjectController::class, 'index'])->name('home');
Route::post('add-update-project', [AjaxProjectController::class, 'store']);
Route::post('edit-project', [AjaxProjectController::class, 'edit']);
Route::post('delete-project', [AjaxProjectController::class, 'destroy']);
Route::post('start-project', [AjaxProjectController::class, 'startproject']);
Route::get('show-project', [AjaxProjectController::class, 'showproject']);




Route::post('add-update-task', [DetailController::class, 'goal']);
Route::post('delete-task', [DetailController::class, 'hapus']);
Route::post('status',[DetailController::class,'status']);

Route::post('total-skor', [DetailController::class, 'sumskor']);

Route::get('cari', [HomeController::class, 'search']);
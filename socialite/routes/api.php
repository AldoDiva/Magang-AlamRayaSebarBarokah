<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\AjaxProjectController;
use App\Http\Controllers\auth\LoginController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects', [AjaxProjectController::class, 'all']);
Route::post('add-update-project', [AjaxProjectController::class, 'store']);
Route::post('edit-project', [AjaxProjectController::class, 'edit']);
Route::post('delete-project', [AjaxProjectController::class, 'destroy']);
Route::post('start-project', [AjaxProjectController::class, 'startproject']);

Route::post('login', [LoginController::class, 'logen']);

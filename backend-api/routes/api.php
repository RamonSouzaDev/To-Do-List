<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
    
    Route::apiResource('tasks', TaskController::class);

    Route::put('/tasks/{task}/complete', 'App\Http\Controllers\TaskController@markAsCompleted');
    Route::put('/tasks/{task}/incompleted', 'App\Http\Controllers\TaskController@markAsIncompleted');
    Route::post('/tasks/export-excel', 'App\Http\Controllers\TaskController@exportExcel')->name('tasks.export-excel');;
});

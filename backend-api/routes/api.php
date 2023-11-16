<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Laravel\Telescope\Telescope;

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
    
    Route::group(['prefix' => '/tasks'], function () {
        Route::apiResource('', TaskController::class)->parameters([
            '' => 'task',
        ]);
        Route::put('/{task}/complete', 'App\Http\Controllers\TaskController@markAsCompleted');
        Route::put('/{task}/incompleted', 'App\Http\Controllers\TaskController@markAsIncompleted');
        Route::post('/export-excel', 'App\Http\Controllers\TaskController@exportExcel')->name('tasks.export-excel');
        Route::post('/mark-all-as-completed', 'App\Http\Controllers\TaskController@markAllAsCompleted');
        Route::post('/mark-all-as-incompleted', 'App\Http\Controllers\TaskController@markAllAsIncompleted');
        Route::post('/delete-multiple', 'App\Http\Controllers\TaskController@deleteMultiple');
    });
});

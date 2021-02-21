<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/user/signup', [
    UserController::class, 'signup'
]);
Route::post('/user/signin', [
UserController::class, 'signin'
]);

Route::post('/task', [
    TaskController::class, 'addTask'
])->middleware('auth.jwt');

Route::get('/tasks', [
    TaskController::class, 'getAllTasks'
])->middleware('auth.jwt');

Route::get('/task/{id}', [
    TaskController::class, 'getTask'
])->middleware('auth.jwt');

Route::put('/task/{id}', [
    TaskController::class, 'updateTask'
])->middleware('auth.jwt');

Route::delete('/task/{id}', [
    TaskController::class, 'deleteTask'
])->middleware('auth.jwt');
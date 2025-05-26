<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Crudcontroller;
use App\Http\Controllers\UserrepController;
use App\Http\Controllers\TestController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/users', [Crudcontroller::class, 'index']);
// Route::apiResource('users', [Crudcontroller::class'']);
// Route::apiResource('users', Crudcontroller::class);
// Route::apiResource('users', Crudcontroller::class)->only([
//     'index', 'show', 'store', 'update', 'destroy'f
// ]);


// routes/api.php




Route::get('/users', [UserrepController::class, 'index']);
Route::post('/users', [UserrepController::class, 'store']);
Route::post('logins',[UserrepController::class,'logins']);
Route::post('logout',[UserrepController::class,'logout']);
Route::get('/users/{id}', [UserrepController::class, 'show']);
Route::put('/users/{id}', [UserrepController::class, 'update']);
Route::delete('/users/{id}', [UserrepController::class, 'destroy']);

// Route::post('/fileupload', [Crudcontroller::class, 'fileupload']);

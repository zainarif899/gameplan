<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Crudcontroller;
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


Route::get('/users', [Crudcontroller::class, 'index'])->name('users.index');
Route::post('/users', [Crudcontroller::class, 'store']);
Route::get('/users/{id}', [Crudcontroller::class, 'show']);
Route::put('/users/{id}', [Crudcontroller::class, 'update']);
Route::delete('/users/{id}', [Crudcontroller::class, 'destroy']);
// Route::post('/fileupload', [Crudcontroller::class, 'fileupload']);

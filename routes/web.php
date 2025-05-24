<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crudcontroller;
use App\Http\Controllers\UserrepController;
use App\Http\Controllers\FileController;
use App\Repositories\Eloquent\Userrepository;

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
    // $parser = new \Smalot\PdfParser\Parser();
    // $path = storage_path('app/Doc/check.pdf');
    // $pdf = $parser->parseFile($path);
    // $text = $pdf->getText();
    // $metadata = $pdf->getDetails();
    // $pageCount = $pdf->getPages();
    //     dd($pageCount);
        
    return view('welcome');
});



Route::get('/user_index',[UserrepController::class,'index'])->name('user_index');
Route::get('user/create',[UserrepController::class,'create'])->name('create');
Route::get('/user_login',[UserrepController::class,'login'])->name('userlogin');
Route::get('logout',[UserrepController::class,'logout'])->name('logout');
Route::get('home',[UserrepController::class,'homepage'])->name('home');

Route::post('user/logins',[UserrepController::class,'logins'])->name('logins');
Route::post('user/store',[UserrepController::class,'store'])->name('store');






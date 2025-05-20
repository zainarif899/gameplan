<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crudcontroller;

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
     $parser = new \Smalot\PdfParser\Parser();
        $path = public_path('app/public/uploads/1747746010.pdf');
        $pdf = $parser->parseFile($path);
        $text = $pdf->getText();
        $metadata = $pdf->getDetails();
        $pageCount = $pdf->getPages();
        dd($pageCount);
        
    return view('welcome');
});

Route::get('/user_page', [Crudcontroller::class, 'user_page'])->name('user_page');
Route::get('user/create',[Crudcontroller::class,'create'])->name('create');


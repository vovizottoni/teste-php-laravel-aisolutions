<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ler arquivo .json
Route::get('/filescreen', [App\Http\Controllers\ImportacaoController::class, 'fileScreen'])->name('fileScreen');
Route::post('/readfileanddispatch', [App\Http\Controllers\ImportacaoController::class, 'readFileAndDispatch'])->name('readFileAndDispatch');

// Iniciar fila
Route::get('/queuescreen', [App\Http\Controllers\ImportacaoController::class, 'queueScreen'])->name('queueScreen');
Route::post('/runqueue', [App\Http\Controllers\ImportacaoController::class, 'runQueue'])->name('runQueue');
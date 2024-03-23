<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaidaController;
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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'logar'])->middleware('guest');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::resource('produtos', ProdutoController::class);

Route::resource('contactos', ContactoController::class);

Route::resource('entradas', EntradaController::class);
Route::post('entradas/adicionar-item', [EntradaController::class, 'adicionarItem']);
Route::post('entradas/remover-item', [EntradaController::class, 'removerItem']);

Route::resource('saidas', SaidaController::class);

Route::prefix('reports', function(){
    Route::get('/', [ReportController::class, 'index']);
});

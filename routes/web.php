<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendaController;
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

Route::prefix('relatorios', function(){
    Route::get('/', [ReportController::class, 'index']);
});

Route::resource('produtos', ProdutoController::class);

Route::resource('contactos', ContactoController::class);

Route::post('compras/adicionar-item', [CompraController::class, 'adicionarItem']);
Route::get('compras/definir-contacto', [CompraController::class, 'definirContacto']);
Route::get('compras/remover-item/{id}', [CompraController::class, 'removerItem']);
Route::resource('compras', CompraController::class);


Route::post('vendas/adicionar-item', [VendaController::class, 'adicionarItem']);
Route::get('vendas/definir-contacto', [VendaController::class, 'definirContacto']);
Route::get('vendas/remover-item/{id}', [VendaController::class, 'removerItem']);
Route::resource('vendas', VendaController::class);




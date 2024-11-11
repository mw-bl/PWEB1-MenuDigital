<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ItensCardapioController;

Route::get('/', [CardapioController::class, 'index'])->name('paginaPrincipal');

// Rotas para Empresa
Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresa/cadastro', [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/login', [EmpresaController::class, 'loginForm'])->name('login');
Route::post('/login', [EmpresaController::class, 'login'])->name('empresa.login');
Route::post('/logout', [EmpresaController::class, 'destroy'])->name('empresa.logout');


// Rotas para Cardapio
Route::middleware(['auth'])->group(function () {
    Route::get('/cardapio/manageAndCreate', [CardapioController::class, 'manageAndCreate'])->name('cardapio.manageAndCreate');
    Route::get('/empresa/cardapios', [CardapioController::class, 'index'])->name('cardapio.index');
    Route::post('/empresa/cardapios', [CardapioController::class, 'store'])->name('cardapio.store');
    Route::get('/empresa/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');
    Route::get('/empresa/cardapios/{id}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::put('/empresa/cardapios/{id}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::delete('/empresa/cardapios/{id}', [CardapioController::class, 'destroy'])->name('cardapio.destroy');
});

// Rotas para ItensCardapio
Route::middleware(['auth'])->group(function () {
    Route::post('/empresa/cardapios/{id}/itens', [ItensCardapioController::class, 'store'])->name('itensCardapio.store');
});
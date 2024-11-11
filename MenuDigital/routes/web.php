<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ItensCardapioController;

Route::get('/', [CardapioController::class, 'index'])->name('welcome');

//Rotas para Empresa
Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresa/cadastro', [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/login', [EmpresaController::class, 'loginForm'])->name('login');
Route::post('/login', [EmpresaController::class, 'login'])->name('empresa.login');
Route::post('/logout', [EmpresaController::class, 'destroy'])->name('empresa.logout');


//Rotas para Cardapio
Route::middleware(['auth'])->group(function () {
    Route::get('/empresa/{empresaId}/cardapios', [CardapioController::class, 'index'])->name('cardapio.index');
    Route::get('/empresa/{empresaId}/cardapio/create', [CardapioController::class, 'create'])->name('cardapio.create');
    Route::post('/empresa/{empresaId}/cardapio', [CardapioController::class, 'store'])->name('cardapio.store');
    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens', [CardapioController::class, 'itens'])->name('cardapio.itens');
    Route::get('/cardapio/create/{empresaId}', [CardapioController::class, 'showForm'])->name('cardapio.create');
    Route::get('/empresa/{empresaId}/cardapio/{cardapioId}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::put('/empresa/{empresaId}/cardapios/{cardapioId}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::delete('/empresa/{empresaId}/cardapio/{cardapioId}', [CardapioController::class, 'destroy'])->name('cardapio.destroy');

});

//ItensCardapio
Route::middleware(['auth'])->group(function () {
    
    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens/create', [ItensCardapioController::class, 'create'])->name('item.create');    
    Route::post('/empresas/{empresaId}/cardapios/{cardapioId}/itens', [ItensCardapioController::class, 'store'])->name('item.store');
    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}/edit', [ItensCardapioController::class, 'edit'])->name('item.edit');
    Route::put('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}', [ItensCardapioController::class, 'update'])->name('item.update');
    Route::delete('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}', [ItensCardapioController::class, 'destroy'])->name('item.destroy');

});
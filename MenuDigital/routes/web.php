<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ItensCardapioController;



Route::get('/', function () {
    return view('welcome');
});

// Rotas para Empresa
Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresa/cadastro', [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/login', [EmpresaController::class, 'loginForm'])->name('login');
Route::post('/login', [EmpresaController::class, 'login'])->name('empresa.login');
Route::post('/logout', [EmpresaController::class, 'destroy'])->name('empresa.logout');

// Rotas para Empresa



// Rotas para Cardapio
Route::middleware(['auth'])->group(function () {
    Route::get('/', [CardapioController::class, 'index']);
    Route::get('/empresa/{empresaId}/cardapio/manageAndCreate', [CardapioController::class, 'create'])->name('cardapio.manageAndCreate');

    Route::post('/empresa/{empresaId}/cardapio', [CardapioController::class, 'store'])->name('cardapio.store');

    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens', [CardapioController::class, 'itens'])->name('cardapio.itens');

    Route::get('/empresa/{empresaId}/cardapio/{cardapioId}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::put('/empresa/{empresaId}/cardapios/{cardapioId}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::delete('/empresa/{empresaId}/cardapio/{cardapioId}', [CardapioController::class, 'destroy'])->name('cardapio.destroy');

});

// Rotas para ItensCardapio
Route::middleware(['auth'])->group(function () {
    // Rota para criar um novo item
    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens/create', [ItensCardapioController::class, 'create'])->name('item.create');


    // Rota para armazenar o novo item
    Route::post('/empresas/{empresaId}/cardapios/{cardapioId}/itens', [ItensCardapioController::class, 'store'])->name('item.store');

    // Rota para editar um item
    Route::get('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}/edit', [ItensCardapioController::class, 'edit'])->name('item.edit');

    // Rota para atualizar um item
    Route::put('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}', [ItensCardapioController::class, 'update'])->name('item.update');

    // Rota para excluir um item
    Route::delete('/empresas/{empresaId}/cardapios/{cardapioId}/itens/{itemId}', [ItensCardapioController::class, 'destroy'])->name('item.destroy');

});
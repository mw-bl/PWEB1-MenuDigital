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


// Rotas para Cardapio
Route::middleware(['auth',])->group(function () {
    Route::get('/empresa/cardapios', [CardapioController::class, 'manageAndCreate'])->name('cardapio.manageAndCreate');
    Route::post('/empresa/cardapios', [CardapioController::class, 'store'])->name('cardapio.store');
});

// Rotas para ItensCardapio
Route::prefix('itens-cardapio')->group(function () {
    Route::get('/', [ItensCardapioController::class, 'index'])->name('itens_cardapio.index');
    Route::get('/create', [ItensCardapioController::class, 'create'])->name('itens_cardapio.create');
    Route::post('/', [ItensCardapioController::class, 'store'])->name('itens_cardapio.store');
    Route::get('/{id}', [ItensCardapioController::class, 'show'])->name('itens_cardapio.show');
    Route::get('/{id}/edit', [ItensCardapioController::class, 'edit'])->name('itens_cardapio.edit');
    Route::put('/{id}', [ItensCardapioController::class, 'update'])->name('itens_cardapio.update');
    Route::delete('/{id}', [ItensCardapioController::class, 'destroy'])->name('itens_cardapio.destroy');
});

// Rota de pesquisa usando SearchController
Route::get('/pesquisa', [CardapioController::class, 'search'])->name('cardapio.pesquisa');

Route::get('/paginaPrincipal', [CardapioController::class, 'index'])->name('cardapio.paginaPrincipal');
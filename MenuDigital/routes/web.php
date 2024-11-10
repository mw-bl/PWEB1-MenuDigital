<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ItensCardapioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/paginaPrincipal', function () {
    return view('paginaPrincipal');
})->name('paginaPrincipal');

Route::get('/', [CardapioController::class, 'index'])->name('welcome');
Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapio.welcome');



// Rotas para Empresa
Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
// routes/web.php


Route::get('/login', [EmpresaController::class, 'loginForm'])->name('login');
Route::post('/login', [EmpresaController::class, 'login'])->name('empresa.login');
Route::post('/logout', [EmpresaController::class, 'destroy'])->name('empresa.logout');
Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapios.index');

// Rota para buscar itens do cardápio
Route::get('/cardapio-itens/{id}', [CardapioController::class, 'getItens']);
Route::get('/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');


// Rotas para Cardapio
Route::middleware(['auth'])->group(function () {
    Route::get('/empresa/cardapios', [CardapioController::class, 'manageAndCreate'])->name('cardapio.manageAndCreate');
    Route::post('/cardapios', [CardapioController::class, 'store'])->name('cardapios.store');

    Route::get('/empresa/cardapios/{id}', [CardapioController::class, 'show'])->name('cardapio.show');

    Route::get('/empresa/cardapios/{id}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::post('/empresa/cardapios/{id}/add-items', [CardapioController::class, 'addItems'])->name('cardapio.addItems');
    Route::put('/empresa/cardapios/{id}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::delete('/empresa/cardapios/{id}', [CardapioController::class, 'destroy'])->name('cardapio.destroy');
    

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
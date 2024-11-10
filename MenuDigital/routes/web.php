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

Route::get('/', [CardapioController::class, 'index'])->name('paginaPrincipal');



// Rotas para Empresa
Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresa/cadastro', [EmpresaController::class, 'store'])->name('empresa.store');
Route::get('/login', [EmpresaController::class, 'loginForm'])->name('login');
Route::post('/login', [EmpresaController::class, 'login'])->name('empresa.login');
Route::post('/logout', [EmpresaController::class, 'destroy'])->name('empresa.logout');

// Rotas para Cardapio
Route::middleware(['auth'])->group(function () {
    Route::get('/empresa/cardapios', [CardapioController::class, 'manageAndCreate'])->name('cardapio.manageAndCreate');
    Route::post('/empresa/cardapios', [CardapioController::class, 'store'])->name('cardapio.store');
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
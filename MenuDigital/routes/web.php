<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EmpresaController;

Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresa.store');

// Rota para exibir o formulário de login
Route::get('empresa/login', [EmpresaController::class, 'loginForm'])->name('empresa.loginForm');
// Rota para processar o login
Route::post('/empresa/login', [EmpresaController::class, 'login'])->name('empresa.login');



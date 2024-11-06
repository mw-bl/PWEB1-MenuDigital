<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EmpresaController;

Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresa.store');

Route::get('/empresa/login', [EmpresaController::class, 'loginForm'])->name('empresa.loginForm');
Route::post('/empresa/login', [EmpresaController::class, 'login'])->name('empresa.login');




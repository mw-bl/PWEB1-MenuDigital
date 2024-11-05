<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('endereco');
            $table->string('email')->unique();
            $table->string('telefone');
            $table->string('cnpj')->unique();
            $table->json('metodos_pagamento');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};

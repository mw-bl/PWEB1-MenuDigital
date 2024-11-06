<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('telefone')->notNullable();
            $table->string('cnpj')->notNullable();
            $table->string('nome')->notNullable();
            $table->string('email')->notNullable();
            $table->string('endereco')->notNullable();
            $table->string('senha')->notNullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};

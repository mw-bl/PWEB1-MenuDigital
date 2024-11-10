<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateCardapiosTable extends Migration
{
    public function up()
    {
        Schema::create('cardapios', function (Blueprint $table) {
            $table->id('id_cardapio');
            $table->string('descricao')->notNullable();
            $table->string('imagem')->nullable();
            $table->foreignId('fk_Empresa_id_empresa')->constrained('empresas', 'id_empresa')->onDelete('restrict');

            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('cardapios');
    }
};

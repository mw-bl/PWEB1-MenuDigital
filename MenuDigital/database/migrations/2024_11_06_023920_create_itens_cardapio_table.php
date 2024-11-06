<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateItensCardapioTable extends Migration
{
    public function up()
    {
        Schema::create('itens_cardapio', function (Blueprint $table) {
            $table->id('id_item_cardapio');
            $table->string('nome_produto')->notNullable();
            $table->string('descricao')->notNullable();
            $table->decimal('preco', 8, 2)->notNullable();
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itens_cardapio');
    }
};

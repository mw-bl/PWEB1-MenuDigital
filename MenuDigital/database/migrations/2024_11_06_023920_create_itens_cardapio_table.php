<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensCardapioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_cardapio', function (Blueprint $table) {
            $table->id('id_item');
            $table->string('nome_produto');
            $table->string('descricao');
            $table->decimal('preco', 8, 2);
            $table->string('imagem');
            $table->unsignedBigInteger('fk_Cardapio_id_cardapio');
            $table->timestamps();

            $table->foreign('fk_Cardapio_id_cardapio')->references('id_cardapio')->on('cardapios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_cardapio');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensCardapio extends Model
{
    use HasFactory;

    protected $table = 'itens_cardapio';
    protected $primaryKey = 'id_item';

    protected $fillable = [
        'nome_produto',
        'descricao',
        'preco',
        'imagem',
        'fk_Cardapio_id_cardapio',
    ];

   

    public function cardapio()
    {
        return $this->belongsTo(Cardapio::class, 'fk_Cardapio_id_cardapio');
    }
}



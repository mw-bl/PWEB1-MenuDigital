<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensCardapio extends Model
{
    use HasFactory;

    protected $table = 'itens_cardapio';

    protected $primaryKey = 'id_item_cardapio';

    protected $fillable = [
        'nome_produto',
        'descricao',
        'preco',
        'link_imagem_itens',
    ];

    public function cardapios()
    {
        return $this->belongsToMany(Cardapio::class, 'pertence', 'fk_Itens_Cardapio_id_item_cardapio', 'fk_Cardapio_id_cardapio');
    }
}
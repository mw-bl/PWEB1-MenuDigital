<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapio';

    protected $primaryKey = 'id_cardapio';

    protected $fillable = [
        'descricao',
        'link_imagem',
        'fk_Empresa_id_empresa',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'fk_Empresa_id_empresa');
    }

    public function itens()
    {
        return $this->belongsToMany(Itens_Cardapio::class, 'pertence', 'fk_Cardapio_id_cardapio', 'fk_Itens_Cardapio_id_item_cardapio');
    }
}
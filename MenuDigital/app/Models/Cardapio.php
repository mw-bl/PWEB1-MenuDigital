<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapios';

    protected $primaryKey = 'id_cardapio';

    protected $fillable = [
        'descricao',
        'imagem',
        'fk_Empresa_id_empresa',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'fk_Empresa_id_empresa', 'id_empresa');
    }

    public function itens()
    {
        return $this->hasMany(ItensCardapio::class, 'fk_Cardapio_id_cardapio', 'id_cardapio');
    }
}
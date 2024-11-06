<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $primaryKey = 'id_empresa';

    protected $fillable = [
        'telefone',
        'cnpj',
        'nome',
        'email',
        'endereco',
        'senha',
    ];

    public function cardapios()
    {
        return $this->hasMany(Cardapio::class, 'fk_Empresa_id_empresa');
    }
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'empresas';

    protected $primaryKey = 'id_empresa';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'telefone',
        'endereco',
        'senha',
    ];

    protected $hidden = [
        'senha',
    ];

    public function cardapios()
    {
        return $this->hasMany(Cardapio::class, 'fk_Empresa_id_empresa', 'id_empresa');
    }
}
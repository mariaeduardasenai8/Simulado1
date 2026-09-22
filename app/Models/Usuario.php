<?php

   namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nome',
        'login',
        'senha',
        'perfil'
    ];

    protected $hidden = [
        'senha',
    ];

    // Mapeia o campo de senha do Laravel para sua coluna customizada
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class, 'id_usuario', 'id_usuario');
    }
}



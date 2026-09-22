<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';
    protected $primaryKey = 'id_movimentacao';
    
    public $timestamps = false; 

    protected $fillable = [
        'id_produto',
        'id_usuario',
        'tipo',
        'quantidade',
        'motivo'
    ];

    protected $casts = [
        'data_operacao' => 'datetime'
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}


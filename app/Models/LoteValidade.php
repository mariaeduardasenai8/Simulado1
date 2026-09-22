<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoteValidade extends Model
{
    protected $table = 'lotes_validade';
    protected $primaryKey = 'id_lote';
    public $timestamps = false;

    protected $fillable = [
        'id_produto',
        'quantidade_atual',
        'data_validade'
    ];

    protected $casts = [
        'data_validade' => 'date'
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id_produto';
    
    public $timestamps = false; 

    protected $fillable = [
        'nome',
        'descricao',
        'categoria',
        'unidade_medida',
        'estoque_minimo',
        'cor',
        'textura',
        'peso'
    ];


    public function lotes(): HasMany
    {
        return $this->hasMany(LoteValidade::class, 'id_produto', 'id_produto');
    }


    public function movimentacoes(): HasMany
    {
        return $this->hasMany(Movimentacao::class, 'id_produto', 'id_produto');
    }


    public function getEstoqueAtualAttribute(): int
    {
        return $this->lotes()->sum('quantidade_atual');
    }

    
    public function getEstoqueBaixoAttribute(): bool
    {
        return $this->estoque_atual < $this->estoque_minimo;
    }
}

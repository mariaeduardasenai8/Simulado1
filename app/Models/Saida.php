<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente',
        'id_produto',
        'quantidade'
    ];
}

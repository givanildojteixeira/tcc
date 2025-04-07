<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcionais extends Model
{
    use HasFactory;
    protected $fillable = [
        'modelo_fab',
        'cod_opcional',
        'chassi',
        'descricao',
    ];
}

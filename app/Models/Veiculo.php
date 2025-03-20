<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'chassi',
        'novo_usado',
        'marca',
        'familia',
        'desc_veiculo',
        'modelo_fab',
        'cor',
        'cod_opcional',
        'combustivel',
        'ano_fab',
        'ano_modelo',
        'motor',
        'portas',
        'vlr_tabela', 10, 2,
        'vlr_bonus', 10, 2,
        'vlr_nota', 10, 2,
        'user_reserva',
        'desc_nota',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negociacao extends Model
{
    use HasFactory;
    protected $table = 'negociacoes';

    protected $fillable = [
        'id_proposta',
        'id_cond_pagamento',
        'descricao_pagamento',
        'valor',
        'data_vencimento',
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_proposta');
    }

    public function condicaoPagamento()
    {
        return $this->belongsTo(CondicaoPagamento::class, 'id_cond_pagamento');
    }
}

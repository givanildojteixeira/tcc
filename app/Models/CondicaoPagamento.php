<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondicaoPagamento extends Model
{
    use HasFactory;
        protected $table = 'condicao_pagamentos';

    protected $fillable = ['descricao'];
    protected $casts = ['financeira' => 'boolean',];

    public function negociacoes()
    {
        return $this->hasMany(Negociacao::class, 'id_cond_pagamento');
    }


}

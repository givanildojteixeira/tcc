<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'tipo_pessoa',
        'cpf_cnpj',
        'email',
        'celular',
        'telefone',
        'telefone_comercial',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'sexo',
        'estado_civil',
        'data_nascimento',
        'data_fundacao',
        'razao_social',
        'nome_fantasia',
        'inscricao_estadual',
        'inscricao_municipal',
        'ativo',
        'observacoes',
        'user_id',
    ];

    //relacionamento das tabelas
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

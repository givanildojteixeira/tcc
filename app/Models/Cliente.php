<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
            'nome',
            'tipo_Pessoa',
            'cpf_cnpj',
            'email',
            'celular',
            'telefone',
            'telefonecom',
            'cep',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'sexo',
            'estado_Civil',
            'data_fundacao',
            'data_Nascimento',
    ];

    //relacionamento das tabelas
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

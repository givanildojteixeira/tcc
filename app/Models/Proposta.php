<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    protected $table = 'propostas';

    protected $fillable = [
        'id_cliente',
        'id_veiculoNovo',
        'id_veiculoUsado1',
        'id_veiculoUsado2',
        'id_veiculoUsado3',
        'id_negociacao',
        'id_usuario',
        'data_proposta',
        'status',
        'id_user_provação_gerencial',
        'id_user_provação_finaneira',
        'id_user_provação_banco',
        'id_user_provação_diretoria',
        'observacao_nota',
        'observacao_interna',
    ];

    // Cliente da proposta
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    // Veículo novo
    public function veiculoNovo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculoNovo');
    }

    // Veículos usados
    public function veiculoUsado1()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculoUsado1');
    }

    public function veiculoUsado2()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculoUsado2');
    }

    public function veiculoUsado3()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculoUsado3');
    }

    // Negociação
    public function negociacao()
    {
        return $this->belongsTo(Negociacao::class, 'id_negociacao');
    }

    public function negociacoes()
    {
        return $this->hasMany(Negociacao::class, 'id_proposta');
    }
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculoNovo');
    }


    // Usuário que criou a proposta
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function vendedor()
{
    return $this->belongsTo(User::class, 'id_usuario');
}

    // Usuários responsáveis por aprovações
    public function aprovadorGerencial()
    {
        return $this->belongsTo(User::class, 'id_user_provação_gerencial');
    }

    public function aprovadorFinanceiro()
    {
        return $this->belongsTo(User::class, 'id_user_provação_finaneira');
    }

    public function aprovadorBanco()
    {
        return $this->belongsTo(User::class, 'id_user_provação_banco');
    }

    public function aprovadorDiretoria()
    {
        return $this->belongsTo(User::class, 'id_user_provação_diretoria');
    }
}


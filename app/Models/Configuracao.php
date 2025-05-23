<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;
    protected $fillable = ['chave', 'valor'];
    protected $table = 'configuracoes';
    public $timestamps = true;
}

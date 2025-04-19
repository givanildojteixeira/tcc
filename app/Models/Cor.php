<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    protected $table = 'cores';
    protected $fillable = ['cor_desc'];

    /**
     * Relacionamento N:N com a tabela de famílias
     */
    public function familias()
    {
        return $this->belongsToMany(Familia::class, 'cor_familia');
    }
}

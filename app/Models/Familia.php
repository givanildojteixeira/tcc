<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    protected $fillable = [
        'descricao',
        'site',
    ];
    public function cores()
    {
        return $this->belongsToMany(Cor::class, 'cor_familia');
    }

}

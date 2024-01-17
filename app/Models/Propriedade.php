<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriedade extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPropriedade',
        'nomePropriedade',
        'cadastroRural',
        'is_active',
    ];

    public $incementing = false;

    protected $cast = [
       'idPropriedade' => 'string',
       'is_active' => 'boolean',
    ];
}

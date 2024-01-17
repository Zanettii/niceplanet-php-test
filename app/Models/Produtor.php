<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtor extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProdutor',
        'nomeProdutor',
        'cfpProdutor',
        'is_active',
    ];

    public $incementing = false;

    protected $cast = [
       'idProdutor' => 'string',
       'is_active' => 'boolean',
    ];
}

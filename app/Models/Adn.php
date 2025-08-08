<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adn extends Model
{
    protected $table = 'adns';
    protected $fillable = [
        'adn',
        'has_mutation',
    ];
    protected $casts = [
        'adn' => 'array',
        'has_mutation' => 'boolean',
    ];

}

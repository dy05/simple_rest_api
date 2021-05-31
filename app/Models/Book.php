<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'isbn',
        'titre',
        'auteur',
        'price',
        'discovering_date'
    ];

    protected $casts = [
        'discovering_date' => 'datetime'
    ];
}

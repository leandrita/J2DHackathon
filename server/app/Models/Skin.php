<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'type',
        'price',
        'color',
        'image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

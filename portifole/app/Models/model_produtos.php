<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_produtos extends Model
{
    use HasFactory;
    protected $fillable = [
        'desc', 'nome', 'price', 'img'
    ];
}

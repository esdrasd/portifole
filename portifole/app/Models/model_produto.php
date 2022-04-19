<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_produto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'price', 'img',
    ];
}

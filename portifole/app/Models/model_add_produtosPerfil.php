<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_add_produtosPerfil extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'desc',
        'nome',
        'price',
        'img'
    ];
}

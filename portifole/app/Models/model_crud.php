<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_crud extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'ddd',
        'telefone',
        'email',
        'enderecoNome',
        'enderecoNumero',
        'complemento',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'pais',
        'dataNascimento',
        'areaCode',
        'senha',
    ];
}

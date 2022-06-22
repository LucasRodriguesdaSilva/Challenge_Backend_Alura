<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor',
        'descricao',
        'data'
    ];

    public $rules = [
        'valor'     => 'required|numeric|max:99999',
        'descricao' => 'required|min:3|max:100',
        'data'      => 'required'
    ];  

    public $message = [
        'valor.required'  => 'Digite um valor correto',
        'valor.numeric'   => 'O valor deve ser um número',
        'valor.max'       => 'O valor não deve passar de 99999',

        'descricao.required'  => 'Digite uma descrição correta',
        'descricao.min'       => 'Digite no mínimo 3 caracteres',
        'descricao.max'       => 'Digite no máximo 100 caracteres',
    
        'data.required'      => 'Escolha uma data valida'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Categoria;

class Despesa extends Model
{
    use HasFactory;
    protected $fillable = [
        'valor',
        'descricao',
        'data',
        'id_categoria'
    ];

    protected $attributes = ['id_categoria' => 8];

    public function Categoria(){
        return $this->hasOne(Categoria::class, 'id', 'id_categoria');
    }
}

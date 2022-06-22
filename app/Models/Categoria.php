<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome_categoria'
    ];

    public function Despesa(){
        return $this->belongsTo(\App\Models\Despesa::class, 'id_categoria');
    }
}

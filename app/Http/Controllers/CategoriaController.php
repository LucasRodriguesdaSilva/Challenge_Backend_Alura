<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function addCategoria(Request $res){
        $categorias = Categoria::create($res->all());
        return response()->json($categorias, 201);
    }

    public function getAll(){
        return response()->json(Categoria::all(), 200);
    }
}

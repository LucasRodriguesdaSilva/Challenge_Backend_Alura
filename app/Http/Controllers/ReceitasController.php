<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Receita;
use Validator;

class ReceitasController extends Controller
{
    
    public function getAll(Request $res){
        if(!empty($res->all())){
            $receita = Receita::select('valor', 'data', 'descricao')->where('descricao', 'LIKE', "%$res->descricao%")->get();
            if(empty($receita))
                return response()->json(['Receita não encontrada'],404);
            return response()->json($receita, 200);
            
        }
        
        return response()->json(Receita::select('valor', 'data', 'descricao')->get(), 200);
        
    }

    public function getReceita($id){
        $receita = Receita::find($id);

        if(empty($receita))
            return response()->json(['message' =>'Receita não encontrada'], 404);

        return response()->json($receita, 200);
    }

    public function storeReceitas(Request $res){
        $rules = [
            'valor'     => 'required|numeric|max:99999',
            'descricao' => 'required|min:3|max:100',
            'data'      => 'required'
        ]; 

        $validator = Validator::make($res->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $receitas = Receita::all();
        foreach($receitas as $item){
            $data1 = date('m', strtotime($res->data));
            $data2 = date('m', strtotime($item->data));
            if($item->descricao === $res->descricao && $data1 === $data2){
                return response()->json(['message'=>'Receita já cadastrada'], 400);
            }
        }

        $receita = Receita::create($res->all());
        return response()->json($receita, 201);
    }

    public function updateReceita($id, Request $res){
        $rules = [
            'valor'     => 'required|numeric|max:99999',
            'descricao' => 'required|min:3|max:100',
            'data'      => 'required'
        ];

        $receita = Receita::find($id);

        if(empty($receita))
            return response()->json(["message" => "Receita não encontrada"], 404);

        $validator = Validator::make($res->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $receitas = Receita::all();
        foreach($receitas as $item){
            $data1 = date('m', strtotime($res->data));
            $data2 = date('m', strtotime($item->data));
            if($item->descricao === $res->descricao && $data1 === $data2){
                return response()->json(['message'=>'Não pode descrições iguais'], 400);
            }
        }
    
        $receita->update($res->all());
        return response()->json($receita, 200);
    }

    public function deleteReceita($id){
        $receita = Receita::find($id);

        if(empty($receita))
            return response()->json(["message" => "Receita não encontrada"], 404);
        
        $receita->delete();
        return response()->json(null, 204);
    }

    public function getPorMes($ano, $mes){
        $receita = Receita::select('valor', 'data', 'descricao')->whereMonth('data', $mes)->whereYear('data', $ano)->get();

        return response()->json($receita, 200);
    }
}

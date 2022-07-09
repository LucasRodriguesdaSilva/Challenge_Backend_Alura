<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despesa;
use Validator;

class DespesasController extends Controller
{
    
    public function getAll(Request $res){
        if(!empty($res->all())){
            $despesa = Despesa::with('Categoria')->select('id','descricao','data','valor','id_categoria')->where('descricao', 'LIKE', "%$res->descricao%")->get();
            if(empty($despesa))
                return response()->json(['Receita não encontrada'],404);
            return response()->json($despesa, 200);
            
        }
        
        return response()->json(Despesa::with('Categoria')->get(), 200);
    }

    public function getDespesa($id){
        $despesa = Despesa::with('Categoria')->find($id);

        if(empty($despesa))
            return response()->json(['message' =>'Despesa não encontrada'], 404);

        return response()->json($despesa, 200);
    }

    public function storeDespesas(Request $res){
        $rules = [
            'valor'     => 'required|numeric|max:99999',
            'descricao' => 'required|min:3|max:100',
            'data'      => 'required',
            'id_categoria' => 'numeric'
        ]; 

        $validator = Validator::make($res->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        $despesas = Despesa::all();
        foreach($despesas as $item){
            $data1 = date('m', strtotime($res->data));
            $data2 = date('m', strtotime($item->data));
            if($item->descricao === $res->descricao && $data1 === $data2){
                return response()->json(['message'=>'Despesa já cadastrada'], 400);
            }
        }

        if($res->id_categoria == 0 || $res->id_categoria > 8)
            $res->merge(['id_categoria' => 8]);
 
        $despesa = Despesa::create($res->all());
        return response()->json($despesa, 201);
    }

    public function updateDespesa($id, Request $res){
        $rules = [
            'valor'     => 'required|numeric|max:99999',
            'descricao' => 'required|min:3|max:100',
            'data'      => 'required',
            'id_categoria' => 'numeric'
        ];

        $despesa = Despesa::find($id);

        if(empty($despesa))
            return response()->json(["message" => "Receita não encontrada"], 404);

        $validator = Validator::make($res->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $despesas = Despesa::all();
        foreach($despesas as $item){
            $data1 = date('m', strtotime($res->data));
            $data2 = date('m', strtotime($item->data));
            if($item->descricao === $res->descricao && $data1 === $data2){
                return response()->json(['message'=>'Não pode descrições iguais'], 400);
            }
        }
    
        if($res->id_categoria == 0 || $res->id_categoria > 8)
            $res->id_categoria = 8;
        
        $despesa->update($res->all());
        return response()->json($despesa, 200);
    }

    public function deleteDespesa($id){
        $despesa = Despesa::find($id);

        if(empty($despesa))
            return response()->json(["message" => "Despesa não encontrada"], 404);
        
        $despesa->delete();
        return response()->json(null, 204);
    }

    public function getPorMes($ano, $mes){
        $receita = Despesa::select('valor', 'data', 'descricao')->whereMonth('data', $mes)->whereYear('data', $ano)->get();

        return response()->json($receita, 200);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Receita;
use \App\Models\Despesa;

class ResumoController extends Controller
{
    public function resumoMensal($ano, $mes){
        $receitas = Receita::select('valor')->whereMonth('data', $mes)->whereYear('data', $ano)->get();

        $despesas = Despesa::with('Categoria')->whereMonth('data', $mes)->whereYear('data', $ano)->get();
        
        $resumo = [];
        $totalReceitas = 0;
        $totalDespesas = 0;

        foreach($receitas as $item){
            $totalReceitas += $item->valor;
        }
        
        $totalCategoria = [];
        foreach($despesas as $item){
            $totalDespesas += $item->valor;
            if(!isset($totalCategoria[$item->categoria->nome_categoria]))
                $totalCategoria[$item->categoria->nome_categoria] = 0;
            $totalCategoria[$item->categoria->nome_categoria] += $item->valor;
            
        }



        $resumo['Resumo_Receitas'] = $totalReceitas;
        $resumo['Resumo_despesas'] = $totalDespesas;
        $resumo['Saldo_do_Mes'] = ($totalReceitas - $totalDespesas);
        $resumo['Gastos_Categorias'] = $totalCategoria;


        return response($resumo,200);
    }
}

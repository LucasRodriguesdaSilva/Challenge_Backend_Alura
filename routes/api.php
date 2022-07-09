<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\ReceitasController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ResumoController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*Route::get('receitas', 'FinancasController@storeReceitas');*/
Route::post('/receitas/criar', [ReceitasController::class, 'storeReceitas']);
Route::post('/despesas/criar', [DespesasController::class, 'storeDespesas']);

Route::get('/receitas', [ReceitasController::class, 'getAll']);
Route::get('/receitas/{id}', [ReceitasController::class, 'getReceita']);
Route::get('/despesas', [DespesasController::class, 'getAll']);
Route::get('/despesas/{id}', [DespesasController::class, 'getDespesa']);

Route::put('/receitas/{id}', [ReceitasController::class, 'updateReceita']);
Route::put('/despesas/{id}', [DespesasController::class, 'updateDespesa']);

Route::delete('/receitas/{id}', [ReceitasController::class, 'deleteReceita']);
Route::delete('/despesas/{id}', [DespesasController::class, 'deleteDespesa']);

Route::post('/categoria/criar', [CategoriaController::class, 'addCategoria']);
Route::get('/categoria', [CategoriaController::class, 'getAll']);

Route::get('receitas/{ano}/{mes}', [ReceitasController::class, 'getPorMes']);
Route::get('despesas/{ano}/{mes}', [DespesasController::class, 'getPorMes']);

Route::get('resumo/{ano}/{mes}',[ResumoController::class, 'resumoMensal']);
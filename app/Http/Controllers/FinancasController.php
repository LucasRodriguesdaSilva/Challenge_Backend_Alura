<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Receita;
use Illuminate\Cache\Repository;
use Validator;

class FinancasController extends Controller
{
    public function index(){
        return view('welcome');
    }
}

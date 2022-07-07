<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Route;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ReceitasTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_criar_receita(){
        $response = $this->postJson('/api/receitas/criar',['valor' => 100.00, 'descricao' => 'testando', 'data' => '2022-07-06']);

        $response->assertStatus(201);
    }



    public function test_listar_todas_receitas()
    {
        $response = $this->getJson('/api/receitas');

        $response->assertStatus(200);
    }

    public function test_listar_uma_receita_pela_descricao(){
        $response = $this->postJson('/api/receitas/criar',['valor' => 100.00, 'descricao' => 'testando', 'data' => '2022-07-06']);

        $response = $this->getJson('/api/receitas?descricao=testando');


        $response->assertStatus(200);
    }
}

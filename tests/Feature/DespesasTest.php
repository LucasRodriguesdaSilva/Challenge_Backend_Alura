<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;

use Tests\TestCase;

class DespesasTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para criação de uma categoria
     * @return void
     */

    public function test_criar_categoria(){
        $response = $this->postJson('/api/categoria/criar', ['nome_categoria' => 'teste categoria']);


        $response->assertStatus(201);
    }

    /**
     * Teste para listar categoria
     * @return void
     */

    public function test_listar_categoria(){
        
        $response = $this->getJson('/api/categoria');

        //$response->dd();

        $response->assertStatus(200);

    }

    
    /**
     * Teste para criar uma despesa
     * @return void
     */

    public function test_criar_uma_despesa(){
        $this->postJson('/api/categoria/criar', ['nome_categoria' => 'teste']);

        $response = $this->postJson('/api/despesas/criar',["valor" => 100.00, "descricao" =>"teste criação","data" => "2022-07-07", "id_categoria" => 2]);

        $response->assertStatus(201);

    }

    /**
     * Teste para listar despesas.
     *
     * @return void
     */
    public function test_listar_despesas()
    {
        $this->postJson('/api/categoria/criar', ['nome_categoria' => 'teste despesas']);

        $this->postJson('/api/despesas/criar',["valor" => 100.00, "descricao" =>"teste criação para listar","data" => "2022-07-07", "id_categoria" => 3]);

        $response = $this->getJson('/api/despesas');

        $response->assertStatus(200);
    }

     /**
     * Teste para listar despesas pelo id.
     *
     * @return void
     */

    public function test_listar_despesa_pelo_id(){
        $this->postJson('/api/categoria/criar', ['nome_categoria' => 'teste listar pelo id']);

        $this->postJson('/api/despesas/criar',["valor" => 100.00, "descricao" =>"teste criação pelo id","data" => "2022-07-07", "id_categoria" => 4]);

        $response = $this->getJson('/api/despesas/3');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 3)
                 ->etc()
        );
    }

    public function test_listar_despesa_pela_descricao(){
        $this->postJson('/api/categoria/criar', ['nome_categoria' => 'teste listar pela descricao']);

        $this->postJson('/api/despesas/criar',["valor" => 100.00, "descricao" =>"teste de criação descrição","data" => "2022-07-07", "id_categoria" => 5]);

        $response = $this->getJson('/api/despesas?descricao=teste+de+criação+descrição');

        $response->assertStatus(200);
    }
    



}

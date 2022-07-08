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
     * Teste para criação de uma receita
     *
     * @return void
     */

    public function test_criar_receita(){
        $response = $this->postJson('/api/receitas/criar',['valor' => 100.00, 'descricao' => 'testando', 'data' => '2022-07-06']);

        $response->assertStatus(201);
    }

    /**
     * Teste para listar todas as receitas
     *
     * @return void
     */
    public function test_listar_todas_receitas()
    {
        $response = $this->getJson('/api/receitas');

        $response->assertStatus(200);
    }

    /**
     * Teste para listar uma receita pela descrição
     *
     * @return void
     */  

    public function test_listar_uma_receita_pela_descricao(){
        $this->postJson('/api/receitas/criar',["valor" => 100.00, "descricao" => "testando", "data" => "2022-07-06"]);

        $response = $this->getJson('/api/receitas?descricao=testando');

        $response->assertStatus(200);
    }

    /**
     * Teste para listar uma receita pelo id
     *
     * @return void
     */

    public function test_listar_uma_receita_pelo_id(){
        $this->postJson('/api/receitas/criar',["valor" => 110.00, "descricao" => "testando id", "data" => "2022-07-06"]);

        $response = $this->getJson('/api/receitas/3');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 3)
                 ->etc()
        );

    }

    /**
     * Teste para atualizar uma receita
     *
     * @return void
     */

    public function test_atualizar_uma_receita(){
        $this->postJson('/api/receitas/criar',["valor" => 200.00, "descricao" => "testando atualizacao", "data" => "2022-07-06"]);
        
        $response = $this->putJson('/api/receitas/4',["valor" => 230.00, "descricao" => "Atualização", "data" => "2022-07-06"]);

        $response = $this->getJson('/api/receitas/4');

        $response
        ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', 4)
                ->where("valor",'230.00')
                ->where("descricao","Atualização")
                 ->etc()
        );
    }

    /**
     * Teste para deletar uma receita
     * @return void
     */

    public function test_deletar_uma_receita(){
        $this->postJson('/api/receitas/criar',["valor" => 200.00, "descricao" => "testando delete receita", "data" => "2022-07-06"]);
        
        $response = $this->deleteJson('/api/receitas/5');

        $response->assertStatus(204);
    }

}

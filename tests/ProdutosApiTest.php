<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosApiTest extends TestCase
{
    use MakeProdutosTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProdutos()
    {
        $produtos = $this->fakeProdutosData();
        $this->json('POST', '/api/v1/produtos', $produtos);

        $this->assertApiResponse($produtos);
    }

    /**
     * @test
     */
    public function testReadProdutos()
    {
        $produtos = $this->makeProdutos();
        $this->json('GET', '/api/v1/produtos/'.$produtos->id);

        $this->assertApiResponse($produtos->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProdutos()
    {
        $produtos = $this->makeProdutos();
        $editedProdutos = $this->fakeProdutosData();

        $this->json('PUT', '/api/v1/produtos/'.$produtos->id, $editedProdutos);

        $this->assertApiResponse($editedProdutos);
    }

    /**
     * @test
     */
    public function testDeleteProdutos()
    {
        $produtos = $this->makeProdutos();
        $this->json('DELETE', '/api/v1/produtos/'.$produtos->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/produtos/'.$produtos->id);

        $this->assertResponseStatus(404);
    }
}

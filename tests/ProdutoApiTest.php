<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutoApiTest extends TestCase
{
    use MakeProdutoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProduto()
    {
        $produto = $this->fakeProdutoData();
        $this->json('POST', '/api/v1/produtos', $produto);

        $this->assertApiResponse($produto);
    }

    /**
     * @test
     */
    public function testReadProduto()
    {
        $produto = $this->makeProduto();
        $this->json('GET', '/api/v1/produtos/'.$produto->id);

        $this->assertApiResponse($produto->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProduto()
    {
        $produto = $this->makeProduto();
        $editedProduto = $this->fakeProdutoData();

        $this->json('PUT', '/api/v1/produtos/'.$produto->id, $editedProduto);

        $this->assertApiResponse($editedProduto);
    }

    /**
     * @test
     */
    public function testDeleteProduto()
    {
        $produto = $this->makeProduto();
        $this->json('DELETE', '/api/v1/produtos/'.$produto->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/produtos/'.$produto->id);

        $this->assertResponseStatus(404);
    }
}

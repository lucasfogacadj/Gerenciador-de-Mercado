<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FornecedoresApiTest extends TestCase
{
    use MakeFornecedoresTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFornecedores()
    {
        $fornecedores = $this->fakeFornecedoresData();
        $this->json('POST', '/api/v1/fornecedores', $fornecedores);

        $this->assertApiResponse($fornecedores);
    }

    /**
     * @test
     */
    public function testReadFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $this->json('GET', '/api/v1/fornecedores/'.$fornecedores->id);

        $this->assertApiResponse($fornecedores->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $editedFornecedores = $this->fakeFornecedoresData();

        $this->json('PUT', '/api/v1/fornecedores/'.$fornecedores->id, $editedFornecedores);

        $this->assertApiResponse($editedFornecedores);
    }

    /**
     * @test
     */
    public function testDeleteFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $this->json('DELETE', '/api/v1/fornecedores/'.$fornecedores->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/fornecedores/'.$fornecedores->id);

        $this->assertResponseStatus(404);
    }
}

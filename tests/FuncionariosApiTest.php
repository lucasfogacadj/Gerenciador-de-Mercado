<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FuncionariosApiTest extends TestCase
{
    use MakeFuncionariosTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFuncionarios()
    {
        $funcionarios = $this->fakeFuncionariosData();
        $this->json('POST', '/api/v1/funcionarios', $funcionarios);

        $this->assertApiResponse($funcionarios);
    }

    /**
     * @test
     */
    public function testReadFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $this->json('GET', '/api/v1/funcionarios/'.$funcionarios->id);

        $this->assertApiResponse($funcionarios->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $editedFuncionarios = $this->fakeFuncionariosData();

        $this->json('PUT', '/api/v1/funcionarios/'.$funcionarios->id, $editedFuncionarios);

        $this->assertApiResponse($editedFuncionarios);
    }

    /**
     * @test
     */
    public function testDeleteFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $this->json('DELETE', '/api/v1/funcionarios/'.$funcionarios->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/funcionarios/'.$funcionarios->id);

        $this->assertResponseStatus(404);
    }
}

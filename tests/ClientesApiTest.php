<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesApiTest extends TestCase
{
    use MakeClientesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateClientes()
    {
        $clientes = $this->fakeClientesData();
        $this->json('POST', '/api/v1/clientes', $clientes);

        $this->assertApiResponse($clientes);
    }

    /**
     * @test
     */
    public function testReadClientes()
    {
        $clientes = $this->makeClientes();
        $this->json('GET', '/api/v1/clientes/'.$clientes->id);

        $this->assertApiResponse($clientes->toArray());
    }

    /**
     * @test
     */
    public function testUpdateClientes()
    {
        $clientes = $this->makeClientes();
        $editedClientes = $this->fakeClientesData();

        $this->json('PUT', '/api/v1/clientes/'.$clientes->id, $editedClientes);

        $this->assertApiResponse($editedClientes);
    }

    /**
     * @test
     */
    public function testDeleteClientes()
    {
        $clientes = $this->makeClientes();
        $this->json('DELETE', '/api/v1/clientes/'.$clientes->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/clientes/'.$clientes->id);

        $this->assertResponseStatus(404);
    }
}

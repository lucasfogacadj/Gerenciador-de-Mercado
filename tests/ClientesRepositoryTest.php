<?php

use App\Models\Clientes;
use App\Repositories\ClientesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesRepositoryTest extends TestCase
{
    use MakeClientesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClientesRepository
     */
    protected $clientesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->clientesRepo = App::make(ClientesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateClientes()
    {
        $clientes = $this->fakeClientesData();
        $createdClientes = $this->clientesRepo->create($clientes);
        $createdClientes = $createdClientes->toArray();
        $this->assertArrayHasKey('id', $createdClientes);
        $this->assertNotNull($createdClientes['id'], 'Created Clientes must have id specified');
        $this->assertNotNull(Clientes::find($createdClientes['id']), 'Clientes with given id must be in DB');
        $this->assertModelData($clientes, $createdClientes);
    }

    /**
     * @test read
     */
    public function testReadClientes()
    {
        $clientes = $this->makeClientes();
        $dbClientes = $this->clientesRepo->find($clientes->id);
        $dbClientes = $dbClientes->toArray();
        $this->assertModelData($clientes->toArray(), $dbClientes);
    }

    /**
     * @test update
     */
    public function testUpdateClientes()
    {
        $clientes = $this->makeClientes();
        $fakeClientes = $this->fakeClientesData();
        $updatedClientes = $this->clientesRepo->update($fakeClientes, $clientes->id);
        $this->assertModelData($fakeClientes, $updatedClientes->toArray());
        $dbClientes = $this->clientesRepo->find($clientes->id);
        $this->assertModelData($fakeClientes, $dbClientes->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteClientes()
    {
        $clientes = $this->makeClientes();
        $resp = $this->clientesRepo->delete($clientes->id);
        $this->assertTrue($resp);
        $this->assertNull(Clientes::find($clientes->id), 'Clientes should not exist in DB');
    }
}

<?php

use App\Models\Funcionarios;
use App\Repositories\FuncionariosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FuncionariosRepositoryTest extends TestCase
{
    use MakeFuncionariosTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FuncionariosRepository
     */
    protected $funcionariosRepo;

    public function setUp()
    {
        parent::setUp();
        $this->funcionariosRepo = App::make(FuncionariosRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFuncionarios()
    {
        $funcionarios = $this->fakeFuncionariosData();
        $createdFuncionarios = $this->funcionariosRepo->create($funcionarios);
        $createdFuncionarios = $createdFuncionarios->toArray();
        $this->assertArrayHasKey('id', $createdFuncionarios);
        $this->assertNotNull($createdFuncionarios['id'], 'Created Funcionarios must have id specified');
        $this->assertNotNull(Funcionarios::find($createdFuncionarios['id']), 'Funcionarios with given id must be in DB');
        $this->assertModelData($funcionarios, $createdFuncionarios);
    }

    /**
     * @test read
     */
    public function testReadFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $dbFuncionarios = $this->funcionariosRepo->find($funcionarios->id);
        $dbFuncionarios = $dbFuncionarios->toArray();
        $this->assertModelData($funcionarios->toArray(), $dbFuncionarios);
    }

    /**
     * @test update
     */
    public function testUpdateFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $fakeFuncionarios = $this->fakeFuncionariosData();
        $updatedFuncionarios = $this->funcionariosRepo->update($fakeFuncionarios, $funcionarios->id);
        $this->assertModelData($fakeFuncionarios, $updatedFuncionarios->toArray());
        $dbFuncionarios = $this->funcionariosRepo->find($funcionarios->id);
        $this->assertModelData($fakeFuncionarios, $dbFuncionarios->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFuncionarios()
    {
        $funcionarios = $this->makeFuncionarios();
        $resp = $this->funcionariosRepo->delete($funcionarios->id);
        $this->assertTrue($resp);
        $this->assertNull(Funcionarios::find($funcionarios->id), 'Funcionarios should not exist in DB');
    }
}

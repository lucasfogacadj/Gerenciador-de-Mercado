<?php

use App\Models\Fornecedores;
use App\Repositories\FornecedoresRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FornecedoresRepositoryTest extends TestCase
{
    use MakeFornecedoresTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FornecedoresRepository
     */
    protected $fornecedoresRepo;

    public function setUp()
    {
        parent::setUp();
        $this->fornecedoresRepo = App::make(FornecedoresRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFornecedores()
    {
        $fornecedores = $this->fakeFornecedoresData();
        $createdFornecedores = $this->fornecedoresRepo->create($fornecedores);
        $createdFornecedores = $createdFornecedores->toArray();
        $this->assertArrayHasKey('id', $createdFornecedores);
        $this->assertNotNull($createdFornecedores['id'], 'Created Fornecedores must have id specified');
        $this->assertNotNull(Fornecedores::find($createdFornecedores['id']), 'Fornecedores with given id must be in DB');
        $this->assertModelData($fornecedores, $createdFornecedores);
    }

    /**
     * @test read
     */
    public function testReadFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $dbFornecedores = $this->fornecedoresRepo->find($fornecedores->id);
        $dbFornecedores = $dbFornecedores->toArray();
        $this->assertModelData($fornecedores->toArray(), $dbFornecedores);
    }

    /**
     * @test update
     */
    public function testUpdateFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $fakeFornecedores = $this->fakeFornecedoresData();
        $updatedFornecedores = $this->fornecedoresRepo->update($fakeFornecedores, $fornecedores->id);
        $this->assertModelData($fakeFornecedores, $updatedFornecedores->toArray());
        $dbFornecedores = $this->fornecedoresRepo->find($fornecedores->id);
        $this->assertModelData($fakeFornecedores, $dbFornecedores->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFornecedores()
    {
        $fornecedores = $this->makeFornecedores();
        $resp = $this->fornecedoresRepo->delete($fornecedores->id);
        $this->assertTrue($resp);
        $this->assertNull(Fornecedores::find($fornecedores->id), 'Fornecedores should not exist in DB');
    }
}

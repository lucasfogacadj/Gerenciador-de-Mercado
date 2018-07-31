<?php

use App\Models\Produtos;
use App\Repositories\ProdutosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosRepositoryTest extends TestCase
{
    use MakeProdutosTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProdutosRepository
     */
    protected $produtosRepo;

    public function setUp()
    {
        parent::setUp();
        $this->produtosRepo = App::make(ProdutosRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProdutos()
    {
        $produtos = $this->fakeProdutosData();
        $createdProdutos = $this->produtosRepo->create($produtos);
        $createdProdutos = $createdProdutos->toArray();
        $this->assertArrayHasKey('id', $createdProdutos);
        $this->assertNotNull($createdProdutos['id'], 'Created Produtos must have id specified');
        $this->assertNotNull(Produtos::find($createdProdutos['id']), 'Produtos with given id must be in DB');
        $this->assertModelData($produtos, $createdProdutos);
    }

    /**
     * @test read
     */
    public function testReadProdutos()
    {
        $produtos = $this->makeProdutos();
        $dbProdutos = $this->produtosRepo->find($produtos->id);
        $dbProdutos = $dbProdutos->toArray();
        $this->assertModelData($produtos->toArray(), $dbProdutos);
    }

    /**
     * @test update
     */
    public function testUpdateProdutos()
    {
        $produtos = $this->makeProdutos();
        $fakeProdutos = $this->fakeProdutosData();
        $updatedProdutos = $this->produtosRepo->update($fakeProdutos, $produtos->id);
        $this->assertModelData($fakeProdutos, $updatedProdutos->toArray());
        $dbProdutos = $this->produtosRepo->find($produtos->id);
        $this->assertModelData($fakeProdutos, $dbProdutos->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProdutos()
    {
        $produtos = $this->makeProdutos();
        $resp = $this->produtosRepo->delete($produtos->id);
        $this->assertTrue($resp);
        $this->assertNull(Produtos::find($produtos->id), 'Produtos should not exist in DB');
    }
}

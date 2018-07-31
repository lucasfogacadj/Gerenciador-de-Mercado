<?php

use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutoRepositoryTest extends TestCase
{
    use MakeProdutoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProdutoRepository
     */
    protected $produtoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->produtoRepo = App::make(ProdutoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProduto()
    {
        $produto = $this->fakeProdutoData();
        $createdProduto = $this->produtoRepo->create($produto);
        $createdProduto = $createdProduto->toArray();
        $this->assertArrayHasKey('id', $createdProduto);
        $this->assertNotNull($createdProduto['id'], 'Created Produto must have id specified');
        $this->assertNotNull(Produto::find($createdProduto['id']), 'Produto with given id must be in DB');
        $this->assertModelData($produto, $createdProduto);
    }

    /**
     * @test read
     */
    public function testReadProduto()
    {
        $produto = $this->makeProduto();
        $dbProduto = $this->produtoRepo->find($produto->id);
        $dbProduto = $dbProduto->toArray();
        $this->assertModelData($produto->toArray(), $dbProduto);
    }

    /**
     * @test update
     */
    public function testUpdateProduto()
    {
        $produto = $this->makeProduto();
        $fakeProduto = $this->fakeProdutoData();
        $updatedProduto = $this->produtoRepo->update($fakeProduto, $produto->id);
        $this->assertModelData($fakeProduto, $updatedProduto->toArray());
        $dbProduto = $this->produtoRepo->find($produto->id);
        $this->assertModelData($fakeProduto, $dbProduto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProduto()
    {
        $produto = $this->makeProduto();
        $resp = $this->produtoRepo->delete($produto->id);
        $this->assertTrue($resp);
        $this->assertNull(Produto::find($produto->id), 'Produto should not exist in DB');
    }
}

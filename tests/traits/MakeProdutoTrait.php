<?php

use Faker\Factory as Faker;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;

trait MakeProdutoTrait
{
    /**
     * Create fake instance of Produto and save it in database
     *
     * @param array $produtoFields
     * @return Produto
     */
    public function makeProduto($produtoFields = [])
    {
        /** @var ProdutoRepository $produtoRepo */
        $produtoRepo = App::make(ProdutoRepository::class);
        $theme = $this->fakeProdutoData($produtoFields);
        return $produtoRepo->create($theme);
    }

    /**
     * Get fake instance of Produto
     *
     * @param array $produtoFields
     * @return Produto
     */
    public function fakeProduto($produtoFields = [])
    {
        return new Produto($this->fakeProdutoData($produtoFields));
    }

    /**
     * Get fake data of Produto
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProdutoData($produtoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'quantidade' => $fake->randomDigitNotNull,
            'descricao' => $fake->text,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $produtoFields);
    }
}

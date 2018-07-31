<?php

use Faker\Factory as Faker;
use App\Models\Fornecedores;
use App\Repositories\FornecedoresRepository;

trait MakeFornecedoresTrait
{
    /**
     * Create fake instance of Fornecedores and save it in database
     *
     * @param array $fornecedoresFields
     * @return Fornecedores
     */
    public function makeFornecedores($fornecedoresFields = [])
    {
        /** @var FornecedoresRepository $fornecedoresRepo */
        $fornecedoresRepo = App::make(FornecedoresRepository::class);
        $theme = $this->fakeFornecedoresData($fornecedoresFields);
        return $fornecedoresRepo->create($theme);
    }

    /**
     * Get fake instance of Fornecedores
     *
     * @param array $fornecedoresFields
     * @return Fornecedores
     */
    public function fakeFornecedores($fornecedoresFields = [])
    {
        return new Fornecedores($this->fakeFornecedoresData($fornecedoresFields));
    }

    /**
     * Get fake data of Fornecedores
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFornecedoresData($fornecedoresFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'telefone' => $fake->word,
            'descricao' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $fornecedoresFields);
    }
}

<?php

use Faker\Factory as Faker;
use App\Models\Funcionarios;
use App\Repositories\FuncionariosRepository;

trait MakeFuncionariosTrait
{
    /**
     * Create fake instance of Funcionarios and save it in database
     *
     * @param array $funcionariosFields
     * @return Funcionarios
     */
    public function makeFuncionarios($funcionariosFields = [])
    {
        /** @var FuncionariosRepository $funcionariosRepo */
        $funcionariosRepo = App::make(FuncionariosRepository::class);
        $theme = $this->fakeFuncionariosData($funcionariosFields);
        return $funcionariosRepo->create($theme);
    }

    /**
     * Get fake instance of Funcionarios
     *
     * @param array $funcionariosFields
     * @return Funcionarios
     */
    public function fakeFuncionarios($funcionariosFields = [])
    {
        return new Funcionarios($this->fakeFuncionariosData($funcionariosFields));
    }

    /**
     * Get fake data of Funcionarios
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFuncionariosData($funcionariosFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'telefone' => $fake->word,
            'descricao' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $funcionariosFields);
    }
}

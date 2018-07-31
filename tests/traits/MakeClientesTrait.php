<?php

use Faker\Factory as Faker;
use App\Models\Clientes;
use App\Repositories\ClientesRepository;

trait MakeClientesTrait
{
    /**
     * Create fake instance of Clientes and save it in database
     *
     * @param array $clientesFields
     * @return Clientes
     */
    public function makeClientes($clientesFields = [])
    {
        /** @var ClientesRepository $clientesRepo */
        $clientesRepo = App::make(ClientesRepository::class);
        $theme = $this->fakeClientesData($clientesFields);
        return $clientesRepo->create($theme);
    }

    /**
     * Get fake instance of Clientes
     *
     * @param array $clientesFields
     * @return Clientes
     */
    public function fakeClientes($clientesFields = [])
    {
        return new Clientes($this->fakeClientesData($clientesFields));
    }

    /**
     * Get fake data of Clientes
     *
     * @param array $postFields
     * @return array
     */
    public function fakeClientesData($clientesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nome' => $fake->word,
            'telefone' => $fake->word,
            'descricao' => $fake->text,
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s')
        ], $clientesFields);
    }
}

<?php

namespace App\Repositories;

use App\Models\Fornecedores;
use InfyOm\Generator\Common\BaseRepository;

class FornecedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'telefone',
        'descricao'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Fornecedores::class;
    }
}

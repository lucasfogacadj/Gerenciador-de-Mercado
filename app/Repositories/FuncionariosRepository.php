<?php

namespace App\Repositories;

use App\Models\Funcionarios;
use InfyOm\Generator\Common\BaseRepository;

class FuncionariosRepository extends BaseRepository
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
        return Funcionarios::class;
    }
}

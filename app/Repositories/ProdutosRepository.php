<?php

namespace App\Repositories;

use App\Models\Produtos;
use InfyOm\Generator\Common\BaseRepository;

class ProdutosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'quantidade',
        'descricao'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Produtos::class;
    }
}

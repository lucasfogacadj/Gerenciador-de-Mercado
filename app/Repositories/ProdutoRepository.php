<?php

namespace App\Repositories;

use App\Models\Produto;
use InfyOm\Generator\Common\BaseRepository;

class ProdutoRepository extends BaseRepository
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
        return Produto::class;
    }
}

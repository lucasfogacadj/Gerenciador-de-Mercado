<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProdutoAPIRequest;
use App\Http\Requests\API\UpdateProdutoAPIRequest;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProdutoController
 * @package App\Http\Controllers\API
 */

class ProdutoAPIController extends AppBaseController
{
    /** @var  ProdutoRepository */
    private $produtoRepository;

    public function __construct(ProdutoRepository $produtoRepo)
    {
        $this->produtoRepository = $produtoRepo;
    }

    /**
     * Display a listing of the Produto.
     * GET|HEAD /produtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->produtoRepository->pushCriteria(new RequestCriteria($request));
        $this->produtoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $produtos = $this->produtoRepository->all();

        return $this->sendResponse($produtos->toArray(), 'Produtos retrieved successfully');
    }

    /**
     * Store a newly created Produto in storage.
     * POST /produtos
     *
     * @param CreateProdutoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProdutoAPIRequest $request)
    {
        $input = $request->all();

        $produtos = $this->produtoRepository->create($input);

        return $this->sendResponse($produtos->toArray(), 'Produto saved successfully');
    }

    /**
     * Display the specified Produto.
     * GET|HEAD /produtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Produto $produto */
        $produto = $this->produtoRepository->findWithoutFail($id);

        if (empty($produto)) {
            return $this->sendError('Produto not found');
        }

        return $this->sendResponse($produto->toArray(), 'Produto retrieved successfully');
    }

    /**
     * Update the specified Produto in storage.
     * PUT/PATCH /produtos/{id}
     *
     * @param  int $id
     * @param UpdateProdutoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProdutoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Produto $produto */
        $produto = $this->produtoRepository->findWithoutFail($id);

        if (empty($produto)) {
            return $this->sendError('Produto not found');
        }

        $produto = $this->produtoRepository->update($input, $id);

        return $this->sendResponse($produto->toArray(), 'Produto updated successfully');
    }

    /**
     * Remove the specified Produto from storage.
     * DELETE /produtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Produto $produto */
        $produto = $this->produtoRepository->findWithoutFail($id);

        if (empty($produto)) {
            return $this->sendError('Produto not found');
        }

        $produto->delete();

        return $this->sendResponse($id, 'Produto deleted successfully');
    }
}

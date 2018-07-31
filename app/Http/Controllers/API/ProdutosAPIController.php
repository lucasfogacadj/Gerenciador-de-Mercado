<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProdutosAPIRequest;
use App\Http\Requests\API\UpdateProdutosAPIRequest;
use App\Models\Produtos;
use App\Repositories\ProdutosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProdutosController
 * @package App\Http\Controllers\API
 */

class ProdutosAPIController extends AppBaseController
{
    /** @var  ProdutosRepository */
    private $produtosRepository;

    public function __construct(ProdutosRepository $produtosRepo)
    {
        $this->produtosRepository = $produtosRepo;
    }

    /**
     * Display a listing of the Produtos.
     * GET|HEAD /produtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->produtosRepository->pushCriteria(new RequestCriteria($request));
        $this->produtosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $produtos = $this->produtosRepository->all();

        return $this->sendResponse($produtos->toArray(), 'Produtos retrieved successfully');
    }

    /**
     * Store a newly created Produtos in storage.
     * POST /produtos
     *
     * @param CreateProdutosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProdutosAPIRequest $request)
    {
        $input = $request->all();

        $produtos = $this->produtosRepository->create($input);

        return $this->sendResponse($produtos->toArray(), 'Produtos saved successfully');
    }

    /**
     * Display the specified Produtos.
     * GET|HEAD /produtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Produtos $produtos */
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            return $this->sendError('Produtos not found');
        }

        return $this->sendResponse($produtos->toArray(), 'Produtos retrieved successfully');
    }

    /**
     * Update the specified Produtos in storage.
     * PUT/PATCH /produtos/{id}
     *
     * @param  int $id
     * @param UpdateProdutosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProdutosAPIRequest $request)
    {
        $input = $request->all();

        /** @var Produtos $produtos */
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            return $this->sendError('Produtos not found');
        }

        $produtos = $this->produtosRepository->update($input, $id);

        return $this->sendResponse($produtos->toArray(), 'Produtos updated successfully');
    }

    /**
     * Remove the specified Produtos from storage.
     * DELETE /produtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Produtos $produtos */
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            return $this->sendError('Produtos not found');
        }

        $produtos->delete();

        return $this->sendResponse($id, 'Produtos deleted successfully');
    }
}

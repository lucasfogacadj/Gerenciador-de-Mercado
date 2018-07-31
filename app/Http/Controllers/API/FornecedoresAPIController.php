<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFornecedoresAPIRequest;
use App\Http\Requests\API\UpdateFornecedoresAPIRequest;
use App\Models\Fornecedores;
use App\Repositories\FornecedoresRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FornecedoresController
 * @package App\Http\Controllers\API
 */

class FornecedoresAPIController extends AppBaseController
{
    /** @var  FornecedoresRepository */
    private $fornecedoresRepository;

    public function __construct(FornecedoresRepository $fornecedoresRepo)
    {
        $this->fornecedoresRepository = $fornecedoresRepo;
    }

    /**
     * Display a listing of the Fornecedores.
     * GET|HEAD /fornecedores
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fornecedoresRepository->pushCriteria(new RequestCriteria($request));
        $this->fornecedoresRepository->pushCriteria(new LimitOffsetCriteria($request));
        $fornecedores = $this->fornecedoresRepository->all();

        return $this->sendResponse($fornecedores->toArray(), 'Fornecedores retrieved successfully');
    }

    /**
     * Store a newly created Fornecedores in storage.
     * POST /fornecedores
     *
     * @param CreateFornecedoresAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFornecedoresAPIRequest $request)
    {
        $input = $request->all();

        $fornecedores = $this->fornecedoresRepository->create($input);

        return $this->sendResponse($fornecedores->toArray(), 'Fornecedores saved successfully');
    }

    /**
     * Display the specified Fornecedores.
     * GET|HEAD /fornecedores/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Fornecedores $fornecedores */
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            return $this->sendError('Fornecedores not found');
        }

        return $this->sendResponse($fornecedores->toArray(), 'Fornecedores retrieved successfully');
    }

    /**
     * Update the specified Fornecedores in storage.
     * PUT/PATCH /fornecedores/{id}
     *
     * @param  int $id
     * @param UpdateFornecedoresAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFornecedoresAPIRequest $request)
    {
        $input = $request->all();

        /** @var Fornecedores $fornecedores */
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            return $this->sendError('Fornecedores not found');
        }

        $fornecedores = $this->fornecedoresRepository->update($input, $id);

        return $this->sendResponse($fornecedores->toArray(), 'Fornecedores updated successfully');
    }

    /**
     * Remove the specified Fornecedores from storage.
     * DELETE /fornecedores/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Fornecedores $fornecedores */
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            return $this->sendError('Fornecedores not found');
        }

        $fornecedores->delete();

        return $this->sendResponse($id, 'Fornecedores deleted successfully');
    }
}

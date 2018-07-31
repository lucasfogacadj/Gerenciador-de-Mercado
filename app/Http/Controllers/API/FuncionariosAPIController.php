<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFuncionariosAPIRequest;
use App\Http\Requests\API\UpdateFuncionariosAPIRequest;
use App\Models\Funcionarios;
use App\Repositories\FuncionariosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FuncionariosController
 * @package App\Http\Controllers\API
 */

class FuncionariosAPIController extends AppBaseController
{
    /** @var  FuncionariosRepository */
    private $funcionariosRepository;

    public function __construct(FuncionariosRepository $funcionariosRepo)
    {
        $this->funcionariosRepository = $funcionariosRepo;
    }

    /**
     * Display a listing of the Funcionarios.
     * GET|HEAD /funcionarios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->funcionariosRepository->pushCriteria(new RequestCriteria($request));
        $this->funcionariosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $funcionarios = $this->funcionariosRepository->all();

        return $this->sendResponse($funcionarios->toArray(), 'Funcionarios retrieved successfully');
    }

    /**
     * Store a newly created Funcionarios in storage.
     * POST /funcionarios
     *
     * @param CreateFuncionariosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFuncionariosAPIRequest $request)
    {
        $input = $request->all();

        $funcionarios = $this->funcionariosRepository->create($input);

        return $this->sendResponse($funcionarios->toArray(), 'Funcionarios saved successfully');
    }

    /**
     * Display the specified Funcionarios.
     * GET|HEAD /funcionarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Funcionarios $funcionarios */
        $funcionarios = $this->funcionariosRepository->findWithoutFail($id);

        if (empty($funcionarios)) {
            return $this->sendError('Funcionarios not found');
        }

        return $this->sendResponse($funcionarios->toArray(), 'Funcionarios retrieved successfully');
    }

    /**
     * Update the specified Funcionarios in storage.
     * PUT/PATCH /funcionarios/{id}
     *
     * @param  int $id
     * @param UpdateFuncionariosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFuncionariosAPIRequest $request)
    {
        $input = $request->all();

        /** @var Funcionarios $funcionarios */
        $funcionarios = $this->funcionariosRepository->findWithoutFail($id);

        if (empty($funcionarios)) {
            return $this->sendError('Funcionarios not found');
        }

        $funcionarios = $this->funcionariosRepository->update($input, $id);

        return $this->sendResponse($funcionarios->toArray(), 'Funcionarios updated successfully');
    }

    /**
     * Remove the specified Funcionarios from storage.
     * DELETE /funcionarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Funcionarios $funcionarios */
        $funcionarios = $this->funcionariosRepository->findWithoutFail($id);

        if (empty($funcionarios)) {
            return $this->sendError('Funcionarios not found');
        }

        $funcionarios->delete();

        return $this->sendResponse($id, 'Funcionarios deleted successfully');
    }
}

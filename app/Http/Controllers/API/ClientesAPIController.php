<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientesAPIRequest;
use App\Http\Requests\API\UpdateClientesAPIRequest;
use App\Models\Clientes;
use App\Repositories\ClientesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ClientesController
 * @package App\Http\Controllers\API
 */

class ClientesAPIController extends AppBaseController
{
    /** @var  ClientesRepository */
    private $clientesRepository;

    public function __construct(ClientesRepository $clientesRepo)
    {
        $this->clientesRepository = $clientesRepo;
    }

    /**
     * Display a listing of the Clientes.
     * GET|HEAD /clientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clientesRepository->pushCriteria(new RequestCriteria($request));
        $this->clientesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $clientes = $this->clientesRepository->all();

        return $this->sendResponse($clientes->toArray(), 'Clientes retrieved successfully');
    }

    /**
     * Store a newly created Clientes in storage.
     * POST /clientes
     *
     * @param CreateClientesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClientesAPIRequest $request)
    {
        $input = $request->all();

        $clientes = $this->clientesRepository->create($input);

        return $this->sendResponse($clientes->toArray(), 'Clientes saved successfully');
    }

    /**
     * Display the specified Clientes.
     * GET|HEAD /clientes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Clientes $clientes */
        $clientes = $this->clientesRepository->findWithoutFail($id);

        if (empty($clientes)) {
            return $this->sendError('Clientes not found');
        }

        return $this->sendResponse($clientes->toArray(), 'Clientes retrieved successfully');
    }

    /**
     * Update the specified Clientes in storage.
     * PUT/PATCH /clientes/{id}
     *
     * @param  int $id
     * @param UpdateClientesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Clientes $clientes */
        $clientes = $this->clientesRepository->findWithoutFail($id);

        if (empty($clientes)) {
            return $this->sendError('Clientes not found');
        }

        $clientes = $this->clientesRepository->update($input, $id);

        return $this->sendResponse($clientes->toArray(), 'Clientes updated successfully');
    }

    /**
     * Remove the specified Clientes from storage.
     * DELETE /clientes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Clientes $clientes */
        $clientes = $this->clientesRepository->findWithoutFail($id);

        if (empty($clientes)) {
            return $this->sendError('Clientes not found');
        }

        $clientes->delete();

        return $this->sendResponse($id, 'Clientes deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFornecedoresRequest;
use App\Http\Requests\UpdateFornecedoresRequest;
use App\Repositories\FornecedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FornecedoresController extends AppBaseController
{
    /** @var  FornecedoresRepository */
    private $fornecedoresRepository;

    public function __construct(FornecedoresRepository $fornecedoresRepo)
    {
        $this->fornecedoresRepository = $fornecedoresRepo;
    }

    /**
     * Display a listing of the Fornecedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fornecedoresRepository->pushCriteria(new RequestCriteria($request));
        $fornecedores = $this->fornecedoresRepository->all();

        return view('fornecedores.index')
            ->with('fornecedores', $fornecedores);
    }

    /**
     * Show the form for creating a new Fornecedores.
     *
     * @return Response
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Store a newly created Fornecedores in storage.
     *
     * @param CreateFornecedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateFornecedoresRequest $request)
    {
        $input = $request->all();

        $fornecedores = $this->fornecedoresRepository->create($input);

        Flash::success('Fornecedores salvo com sucesso.');

        return redirect(route('fornecedores.index'));
    }

    /**
     * Display the specified Fornecedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            Flash::error('Fornecedores não encontrado.');

            return redirect(route('fornecedores.index'));
        }

        return view('fornecedores.show')->with('fornecedores', $fornecedores);
    }

    /**
     * Show the form for editing the specified Fornecedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            Flash::error('Fornecedores não encontrado');

            return redirect(route('fornecedores.index'));
        }

        return view('fornecedores.edit')->with('fornecedores', $fornecedores);
    }

    /**
     * Update the specified Fornecedores in storage.
     *
     * @param  int              $id
     * @param UpdateFornecedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFornecedoresRequest $request)
    {
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            Flash::error('Fornecedores não encontrado');

            return redirect(route('fornecedores.index'));
        }

        $fornecedores = $this->fornecedoresRepository->update($request->all(), $id);

        Flash::success('Fornecedores atualizado com sucesso.');

        return redirect(route('fornecedores.index'));
    }

    /**
     * Remove the specified Fornecedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fornecedores = $this->fornecedoresRepository->findWithoutFail($id);

        if (empty($fornecedores)) {
            Flash::error('Fornecedores não encontrado');

            return redirect(route('fornecedores.index'));
        }

        $this->fornecedoresRepository->delete($id);

        Flash::success('Fornecedores deletado com sucesso.');

        return redirect(route('fornecedores.index'));
    }
}

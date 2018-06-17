<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProdutosRequest;
use App\Http\Requests\UpdateProdutosRequest;
use App\Repositories\ProdutosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProdutosController extends AppBaseController
{
    /** @var  ProdutosRepository */
    private $produtosRepository;

    public function __construct(ProdutosRepository $produtosRepo)
    {
        $this->produtosRepository = $produtosRepo;
    }

    /**
     * Display a listing of the Produtos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->produtosRepository->pushCriteria(new RequestCriteria($request));
        $produtos = $this->produtosRepository->all();

        return view('produtos.index')
            ->with('produtos', $produtos);
    }

    /**
     * Show the form for creating a new Produtos.
     *
     * @return Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created Produtos in storage.
     *
     * @param CreateProdutosRequest $request
     *
     * @return Response
     */
    public function store(CreateProdutosRequest $request)
    {
        $input = $request->all();

        $produtos = $this->produtosRepository->create($input);

        Flash::success('Produtos salvo com sucesso.');

        return redirect(route('produtos.index'));
    }

    /**
     * Display the specified Produtos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            Flash::error('Produtos não encontrado');

            return redirect(route('produtos.index'));
        }

        return view('produtos.show')->with('produtos', $produtos);
    }

    /**
     * Show the form for editing the specified Produtos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            Flash::error('Produtos não encontrado');

            return redirect(route('produtos.index'));
        }

        return view('produtos.edit')->with('produtos', $produtos);
    }

    /**
     * Update the specified Produtos in storage.
     *
     * @param  int              $id
     * @param UpdateProdutosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProdutosRequest $request)
    {
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            Flash::error('Produtos não encontrado');

            return redirect(route('produtos.index'));
        }

        $produtos = $this->produtosRepository->update($request->all(), $id);

        Flash::success('Produtos atualizado com sucesso.');

        return redirect(route('produtos.index'));
    }

    /**
     * Remove the specified Produtos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produtos = $this->produtosRepository->findWithoutFail($id);

        if (empty($produtos)) {
            Flash::error('Produtos não encontrado');

            return redirect(route('produtos.index'));
        }

        $this->produtosRepository->delete($id);

        Flash::success('Produtos deletado com sucesso.');

        return redirect(route('produtos.index'));
    }
}

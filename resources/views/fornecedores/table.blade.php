<table class="table table-responsive" id="fornecedores-table">
    <thead>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Descrição</th>
        <th colspan="3">Ações</th>
    </thead>
    <tbody>
    @foreach($fornecedores as $fornecedores)
        <tr>
            <td>{!! $fornecedores->nome !!}</td>
            <td>{!! $fornecedores->telefone !!}</td>
            <td>{!! $fornecedores->descricao !!}</td>
            <td>
                {!! Form::open(['route' => ['fornecedores.destroy', $fornecedores->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('fornecedores.show', [$fornecedores->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('fornecedores.edit', [$fornecedores->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

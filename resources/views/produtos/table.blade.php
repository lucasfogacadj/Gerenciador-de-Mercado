<table class="table table-responsive" id="produtos-table">
    <thead>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Descrição</th>
        <th colspan="3">Ações</th>
    </thead>
    <tbody>
    @foreach($produtos as $produtos)
        <tr>
            <td>{!! $produtos->nome !!}</td>
            <td>{!! $produtos->quantidade !!}</td>
            <td>{!! $produtos->descricao !!}</td>
            <td>
                {!! Form::open(['route' => ['produtos.destroy', $produtos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('produtos.show', [$produtos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('produtos.edit', [$produtos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

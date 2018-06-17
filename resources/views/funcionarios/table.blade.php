<table class="table table-responsive" id="funcionarios-table">
    <thead>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Descrição</th>
        <th colspan="3">Ações</th>
    </thead>
    <tbody>
    @foreach($funcionarios as $funcionarios)
        <tr>
            <td>{!! $funcionarios->nome !!}</td>
            <td>{!! $funcionarios->telefone !!}</td>
            <td>{!! $funcionarios->descricao !!}</td>
            <td>
                {!! Form::open(['route' => ['funcionarios.destroy', $funcionarios->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('funcionarios.show', [$funcionarios->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('funcionarios.edit', [$funcionarios->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $produtos->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{!! $produtos->nome !!}</p>
</div>

<!-- Quantidade Field -->
<div class="form-group">
    {!! Form::label('quantidade', 'Quantidade:') !!}
    <p>{!! $produtos->quantidade !!}</p>
</div>

<!-- Descricao Field -->
<div class="form-group">
    {!! Form::label('descricao', 'Descrição:') !!}
    <p>{!! $produtos->descricao !!}</p>
</div>

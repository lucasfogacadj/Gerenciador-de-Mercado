<li class="{{ Request::is('produtos*') ? 'active' : '' }}">
    <a href="{!! route('produtos.index') !!}"><i class="fa fa-edit"></i><span>Produtos</span></a>
</li>

<li class="{{ Request::is('funcionarios*') ? 'active' : '' }}">
    <a href="{!! route('funcionarios.index') !!}"><i class="fa fa-edit"></i><span>Funcionários</span></a>
</li>

<li class="{{ Request::is('fornecedores*') ? 'active' : '' }}">
    <a href="{!! route('fornecedores.index') !!}"><i class="fa fa-edit"></i><span>Fornecedores</span></a>
</li>

<li class="{{ Request::is('clientes*') ? 'active' : '' }}">
    <a href="{!! route('clientes.index') !!}"><i class="fa fa-edit"></i><span>Clientes</span></a>
</li>

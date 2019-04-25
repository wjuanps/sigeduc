@extends('layouts.layout')

@section('page-header')
<h1>Funcionário</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active">Funcionário</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-funcionario') }}" class="btn btn-primary btn-flat">Novo</a>
		<a href="{{ Route('relatorio-funcionario') }}" class="btn btn-success btn-flat">Relatórios</a>
		<hr />
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="dataTable" class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>Matricula</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Celular</th>
					<th>Email</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				@isset($funcionarios)
					@foreach($funcionarios as $funcionario)
						<tr>
							<td>{{ $funcionario->id }}</td>
							<td>{{ $funcionario->pessoa->nome }}</td>
							<td>{{ $funcionario->pessoa->telefone }}</td>
							<td>{{ $funcionario->pessoa->celular }}</td>
							<td>{{ $funcionario->pessoa->email }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-funcionario', $funcionario->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-funcionario', $funcionario->id) }}">Editar</a></li>
										<li><a href="#">Diário de Classe</a></li>
										<li class="divider"></li>
										<li><a href="#">Remover</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				@endisset
			</tbody>
			<tfoot>
				<tr>
					<th>Matricula</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Celular</th>
					<th>Email</th>
					<th>#</th>
				</tr>
			</tfoot>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
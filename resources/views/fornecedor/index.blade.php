@extends('layouts.layout')

@section('page-header')
<h1>Fornecedor</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active">Fornecedor</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-fornecedor') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus-square fw"></i>&nbsp;&nbsp;Novo</a>
		<a href="{{ Route('relatorio-fornecedor') }}" class="btn btn-success btn-flat"><i class="fa fa-bar-chart-o fw"></i>&nbsp;&nbsp;Relatórios</a>
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
					<th>Site</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				@isset($fornecedores)
					@foreach($fornecedores as $fornecedor)
						<tr>
							<td>{{ $fornecedor->id }}</td>
							<td>{{ $fornecedor->nome_fantasia }}</td>
							<td>{{ $fornecedor->telefone }}</td>
							<td>{{ $fornecedor->celular }}</td>
							<td>{{ $fornecedor->email }}</td>
							<td>{{ $fornecedor->site }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-fornecedor', $fornecedor->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-fornecedor', $fornecedor->id) }}"><i class="fa fa-edit fw"></i> Editar</a></li>
										<li><a href="#"><i class="fa fa-file-text-o fw"></i> Diário de Classe</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="fa fa-trash-o fw"></i> Remover</a></li>
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
@extends('layouts.layout')

@section('page-header')
<h1>Professor</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Professor</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-professor') }}" class="btn btn-primary btn-flat">Novo</a>
		<a href="{{ Route('relatorio-professor') }}" class="btn btn-success btn-flat">Relatórios</a>
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
				@isset($professores)
					@foreach($professores as $professor)
						<tr>
							<td>{{ $professor->id }}</td>
							<td>{{ $professor->pessoa->nome }}</td>
							<td>{{ $professor->pessoa->telefone }}</td>
							<td>{{ $professor->pessoa->celular }}</td>
							<td>{{ $professor->pessoa->email }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-professor', $professor->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-professor', $professor->id) }}">Editar</a></li>
										<li><a href="{{ Route('diario-de-classe') }}">Diário de Classe</a></li>
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
@extends('layouts.layout')

@section('page-header')
<h1>Cargos</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active"> Cargo/Função</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-cargo') }}" class="btn btn-primary"><i class="fa fa-plus-square fw"></i>&nbsp;&nbsp;Novo</a>
		<hr />
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="dataTable" class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Cargo/Função</th>
					<th>Descrição</th>
					<th>Funcionários</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				@isset($cargos)
					@foreach($cargos as $cargo)
						<tr>
							<td>{{ $cargo->id }}</td>
							<td>{{ $cargo->cargo_funcao }}</td>
							<td>{{ $cargo->descricao }}</td>
							<td>{{ count($cargo->funcionarios) }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-cargo', $cargo->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-cargo', $cargo->id) }}"><i class="fa fa-edit fw"></i> Editar</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				@endisset
			</tbody>
			<tfoot>
				<tr>
					<th>Codigo</th>
					<th>Cargo/Função</th>
					<th>Descrição</th>
					<th>Funcionários</th>
					<th>#</th>
				</tr>
			</tfoot>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
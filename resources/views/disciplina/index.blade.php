@extends('layouts.layout')

@section('page-header')
<h1>Disciplina</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active"> Disciplina</li>
</ol>
@endsection

@section('content')

<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-disciplina') }}" class="btn btn-primary"><i class="fa fa-plus-square fw"></i>&nbsp;&nbsp;Novo</a>
		<hr />
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="dataTable" class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>Código</th>
					<th>Disciplina</th>
					<th>Descrição</th>
					<th>Professores</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				@isset($disciplinas)
					@foreach($disciplinas as $disciplina)
						<tr>
							<td>{{ $disciplina->id }}</td>
							<td>{{ $disciplina->disciplina }}</td>
							<td>{{ $disciplina->descricao }}</td>
							<td>
								<span data-toggle="tooltip" title="{{ count($disciplina->professores) . ' Professores' }}" class="badge bg-red">
									{{ count($disciplina->professores) }} 
								</span>&nbsp;&nbsp;&nbsp;<span> - </span>
								<button class="btn btn-link btn-sm" title="Ver todos" data-toggle="tooltip" ><i class="fa fa-external-link fw"></i></button>
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-disciplina', $disciplina->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-disciplina', $disciplina->id) }}"><i class="fa fa-edit fw"></i> Editar</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
				@endisset
			</tbody>
			<tfoot>
				<tr>
                    <th>Código</th>
					<th>Disciplina</th>
					<th>Descrição</th>
					<th>Professores</th>
					<th>#</th>
				</tr>
			</tfoot>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
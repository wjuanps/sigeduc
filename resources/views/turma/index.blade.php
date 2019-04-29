@extends('layouts.layout')

@section('page-header')
<h1>Turma</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Turma</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-turma') }}" class="btn btn-primary btn-flat">Novo</a>
		<a href="{{ Route('relatorio-turma') }}" class="btn btn-success btn-flat">Relatórios</a>
		<hr />
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="dataTable" class="table table-striped table-hover table-responsive">
			<thead>
				<tr>
					<th>Turma</th>
					<th>Série</th>
					<th>Modalidade</th>
					<th>Turno</th>
					<th>Alunos</th>
					<th>Professores</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				@isset($turmas)
					@foreach($turmas as $turma)
						<tr>
							<td>{{ $turma->nome_turma }}</td>
							<td>{{ $turma->serie }}</td>
							<td>{{ $turma->modalidade }}</td>
							<td>{{ $turma->turno }}</td>
							<td>{{ count($turma->alunos) }}</td>
							<td>{{ count($turma->professores) }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ Route('editar-turma', $turma->id) }}" class="btn btn-info btn-flat btn-sm">Editar</a>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-turma', $turma->id) }}">Editar</a></li>
										<li>
											<form id="{{ 'formEditarTurmas'.$turma->id }}" action="{{ Route('adicionar-alunos') }}" method="POST">
												@csrf <input type="hidden" name="id_turma" value="{{ $turma->id }}" />
											</form>
											<a href="#" onclick="event.preventDefault(); document.getElementById({{'\''. 'formEditarTurmas'.$turma->id . '\'' }}).submit()">Adicionar Alunos</a>
										</li>
										<li>
											<form id="{{ 'gradeProfessores'.$turma->id }}" action="{{ Route('grade-de-professores') }}" method="POST">
												@csrf <input type="hidden" name="id_turma" value="{{ $turma->id }}" />
											</form>
											<a href="#" onclick="event.preventDefault(); document.getElementById({{'\''. 'gradeProfessores'.$turma->id . '\'' }}).submit()">Grade de Professores</a>
										</li>
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
					<th>Turma</th>
					<th>Série</th>
					<th>Modalidade</th>
					<th>Turno</th>
					<th>Alunos</th>
					<th>Professores</th>
					<th>#</th>
				</tr>
			</tfoot>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
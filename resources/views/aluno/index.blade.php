@extends('layouts.layout')

@section('page-header')
<h1>Aluno</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active">Aluno</li>
</ol>
@endsection

@section('content')
<div class="box box-info">
	<div class="box-header">
		<a href="{{ Route('cadastrar-aluno') }}" class="btn btn-primary btn-flat">Novo</a>
		<a href="{{ Route('relatorio-aluno') }}" class="btn btn-success btn-flat">Relatórios</a>
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
				@isset($alunos)
					@foreach($alunos as $aluno)
						<tr>
							<td>{{ $aluno->matricula }}</td>
							<td>{{ $aluno->pessoa->nome }}</td>
							<td>{{ $aluno->pessoa->telefone }}</td>
							<td>{{ $aluno->pessoa->celular }}</td>
							<td>{{ $aluno->pessoa->email }}</td>
							<td>
								<div class="btn-group">
									<button class="btn btn-info btn-flat btn-sm" data-toggle="dropdown" aria-expanded="false">Ações</button>
									<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ Route('editar-aluno', $aluno->id) }}">Editar</a></li>
										<li><a href="{{ Route('editar-turmas-aluno', $aluno->id) }}">Editar Turmas</a></li>
										<li><a href="#">Gerar Histórico</a></li>
										<li><a href="#">Gerar Boletim</a></li>
										<li><a href="#">Gerar Declaração</a></li>
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
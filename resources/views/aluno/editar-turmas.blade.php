@extends('layouts.layout')

@section('page-header')
<h1>Editar Aluno</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('aluno') }}"> Alunos</a></li>
	<li><a href="{{ Route('turma') }}"> Turmas</a></li>
	<li class="active">Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('aluno-teste') }}" method="POST" class="formCadastroAluno">
	@csrf

	<div class="box box-danger">
		<div class="box-header with-border">
			<h3 class="box-title">Seleção de Turmas</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="modalidade">Modalidade</label>
					<select id="modalidade" onchange="selecionarSerie(this.value)" class="form-control">
                        <option value="">Escolha a Modalidade</option>
                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                        <option value="Ensino Médio">Ensino Médio</option>
                        <option value="EJA">EJA</option>
                    </select>
				</div>

				<div class="form-group col-md-3">
					<label for="serie">Série</label>
					<select id="serie" class="form-control">
                        <option value="">Escolha a Série</option>
                    </select>
				</div>

				<div class="form-group col-md-3">
					<label for="turno">Turno</label>
					<select id="turno" class="form-control">
                        <option value="">Escolha o Turno</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>
				</div>

				<div class="form-group col-md-3">
					<button class="btn btn-success" type="button" id="pesquisarTurmas" style="margin-top: 23px">Pesquisar</button>
				</div>
			</div>

			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-responsive" id="tabelaTurmaAlunoTemp">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Série</th>
                                <th>Modalidade</th>
                                <th>Turno</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-gray">
		<div class="box-header with-border">
			<h3 class="box-title">Turmas do Aluno</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-responsive" id="tabelaTurmasAluno">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Série</th>
                                <th>Modalidade</th>
                                <th>Turno</th>
                                <th>Ano</th>
                                <th>Repetente</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
							@isset($aluno->turmas)
								@foreach($aluno->turmas as $turma)
									<tr>
										<td>{{ $turma->turma }}</td>
										<td>{{ $turma->serie }}</td>
										<td>{{ $turma->modalidade }}</td>
										<td>{{ $turma->turno }}</td>
										<td>{{ $turma->pivot->ano }}</td>
										<td>{{ $turma->pivot->is_repetente }}</td>
										<td>{{ $turma->id }}</td>
									</tr>
								@endforeach
							@endisset
						</tbody>
                    </table>
                    <input type="hidden" class="form-control" id="turmasAluno" name="turmasAluno" />
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" type="button" id="submeterFormulario" ><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>

</form>
@endsection

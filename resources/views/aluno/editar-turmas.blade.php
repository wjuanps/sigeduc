@extends('layouts.layout')

@section('page-header')
<h1>Turmas de {{ $aluno->pessoa->nome }}</h1>
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

	@include('includes.alert-errors')

	<div class="box box-danger">
		<div class="box-header with-border">
			<h3 class="box-title">Seleção de Turmas</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<form action="{{ Route('editar-turmas-aluno') }}" method="POST">
					@csrf
				
					<input type="hidden" name="id_aluno" value="{{ $aluno->id }}" />

					<div class="form-group col-md-3">
						<label for="modalidade">Modalidade</label>
						<select id="modalidade" name="modalidade" required onchange="selecionarSerie(this.value)" class="form-controll select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
							<option value="">Escolha a Modalidade</option>
							<option value="Ensino Fundamental">Ensino Fundamental</option>
							<option value="Ensino Médio">Ensino Médio</option>
							<option value="EJA">EJA</option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="serie">Série</label>
						<select id="serie" name="serie" required class="form-controll select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
							<option value="">Escolha a Série</option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<label for="turno">Turno</label>
						<select id="turno" name="turno" required class="form-controll select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
							<option value="">Escolha o Turno</option>
							<option value="Matutino">Matutino</option>
							<option value="Vespertino">Vespertino</option>
							<option value="Noturno">Noturno</option>
						</select>
					</div>

					<div class="form-group col-md-3">
						<button class="btn btn-success" type="submit" id="pesquisarTurmas" style="margin-top: 23px">Pesquisar</button>
					</div>
				</form>
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
                                <th>Repetente</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
							@if (isset($turmas) && count($turmas) > 0)
								@foreach ($turmas as $turma)
									<form action="{{ Route('editar-turmas-aluno') }}" method="POST">
										@csrf

										<input type="hidden" name="id_aluno" value="{{ $aluno->id }}" />
										<input type="hidden" name="id_turma" value="{{ $turma->id }}" />

										<tr>
											<td> {{ $turma->nome_turma }} </td>
											<td> {{ $turma->serie }} </td>
											<td> {{ $turma->modalidade }} </td>
											<td> {{ $turma->turno }} </td>
											<td> <input type="checkbox" name="is_repetente" /> </td>
											<td>
												<button type='submit' class='btn btn-success'> 
													<i class='fa fa-check fw'></i> 
												</button> 
											</td>
										</tr>
									</form>
								@endforeach
							@endif
						</tbody>
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
                    <table class="table table-striped table-hover table-responsive" id="tabelaTurmasAluno">
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
							@isset($alunoTurmas)
								<form id="formAtualizarTurmasAluno" action="{{ Route('editar-turmas-aluno') }}" method="POST">
									@csrf
								
									<input type="hidden" name="id_aluno" value="{{ $aluno->id }}" />
								
									@foreach($alunoTurmas as $turma)
										<input type="hidden" name="turmas[]" value="{{ $turma->id }}" />

										<tr>
											<td>{{ $turma->nome_turma }}</td>
											<td>{{ $turma->serie }}</td>
											<td>{{ $turma->modalidade }}</td>
											<td>{{ $turma->turno }}</td>
											<td>{{ ((isset($turma->ano)) ? $turma->ano : '') }}</td>
											<td>
												<input type="hidden" name="is_repetente[]" value="{{ $turma->is_repetente }}" />
												{{ ((isset($turma->pivot->is_repetente)) ? (($turma->pivot->is_repetente) ? 'Sim' : 'Não') : (($turma->is_repetente) ? 'Sim' : 'Não')) }}
											</td>
											<td class="{{ ((isset($turma->is_repetente)) ? 'hidden' : '') }}">
												<div class="btn-group">
													<button class="btn btn-info btn-flat btn-sm" data-toggle="dropdown" aria-expanded="false">Ações</button>
													<button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
														<span class="caret"></span>
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
														<li><a href="#">Editar</a></li>
														<li class="divider"></li>
														<li><a href="#">Remover</a></li>
													</ul>
												</div>
											</td>
											<td class="{{ ((!isset($turma->is_repetente)) ? 'hidden' : '') }}">
												<button type="button" onclick="document.getElementById('formCancelarAtualizacaoTurmasAluno').submit()" class="btn btn-danger"><i class="fa fa-trash-o fw"></i></button>
											</td>
										</tr>
									@endforeach
								</form>
								<form id="formCancelarAtualizacaoTurmasAluno" action="{{ Route('editar-turmas-aluno') }}" method="POST">
									@csrf <input type="hidden" name="id_aluno" value="{{ $aluno->id }}" />
								</form>
							@endisset
						</tbody>
                    </table>
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" type="button" id="submeterFormulario" {{ ((count($aluno->turmas) < count($alunoTurmas)) ? '' : 'disabled') }} ><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('aluno') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>
@endsection

@extends('layouts.layout')

@section('page-header')
<h1>Cadastrar Turma</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('turma') }}"> Turma</a></li>
	<li class="active"> Cadastrar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('gravar-turma') }}" method="POST" id="formCadastrarTurma">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados da Turma</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="modalidade">Modalidade</label>
					<select name="modalidade" id="modalidade" onchange="selecionarSerie(this.value)" class="form-control">
                        <option value="">Escolha a Modalidade</option>
                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                        <option value="Ensino Médio">Ensino Médio</option>
                        <option value="EJA">EJA</option>
                    </select>
				</div>

				<div class="form-group col-md-3">
                    <label for="serie">Série</label>
					<select name="serie" id="serie" class="form-control">
                        <option value="">Escolha a Série</option>
                    </select>
				</div>

				<div class="form-group col-md-3">
                    <label for="descricaoSerie">Descrição da Série</label>
					<input type="text" name="descricao_serie" class="form-control" id="descricaoSerie" placeholder="Descrição da Série" />
				</div>

				<div class="form-group col-md-3">
                    <label for="turno">Turno</label>
					<select name="turno" id="turno" class="form-control">
                        <option value="">Escolha o Turno</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>	
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="turma">Turma</label>
					<input type="text" name="turma" class="form-control" id="turma" placeholder="Turma" />
				</div>
				<div class="form-group col-md-3">
					<label for="descricaoTurma">Descrição da Turma</label>
					<input type="text" name="descriao_turma" class="form-control" id="descricaoTurma" placeholder="Descrição da Turma" />
				</div>
				<div class="form-group col-md-3">
					<label for="dataCadastro">Data Cadastro</label>
					<input type="text" class="form-control mask-data" id="dataCadastro" name="dataCadastro" value="{{ date_format(date_create(), 'd/m/Y' ) }}" placeholder="Data Cadastro" disabled />
				</div>
				<div class="form-group col-md-3">
					<label for="modificadaEm">Modificada Em</label>
					<input type="text" class="form-control mask-data" id="modificadaEm" name="modificadaEm" value="{{ date_format(date_create(), 'd/m/Y' ) }}" placeholder="Modificada Em" disabled />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
                    <div class="checkbox" style="margin-top: 35px">
                        <label>
                          <input type="checkbox" name="is_active" id="isAtiva" checked />
                          Ativada
                        </label>
                    </div>
				</div>
				
				<div class="form-group col-md-3">
                    <div class="checkbox" style="margin-top: 35px">
                        <label>
                          <input type="checkbox" name="is_cancelada" id="isCancelada" />
                          Cancelada
                        </label>
                    </div>
				</div>

				<div class="form-group col-md-3">
                    <label for="canceladaEm">Cancelada Em</label>
					<input type="text" class="form-control mask-data" id="canceladaEm" name="cancelado_em" placeholder="Cancelada Em" disabled />
				</div>

				<div class="form-group col-md-3">
                    <label for="ativadaEm">Ativada Em</label>
					<input type="text" class="form-control mask-data" id="ativadaEm" name="ativadaEm"  placeholder="Ativada Em" disabled />
				</div>

			</div>

			<div class="form-group col-md-3">
				<input type="hidden" class="form-control" name="created_at" disabled id="dataCadastro" value="{{ date_format(date_create(), 'Y-m-d H:i:s' ) }}" />
			</div>

		</div><!-- /.box-body -->
	</div>

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Grade de Professores</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-5">
                    <label>Disciplinas</label>
                    <select class="form-control select-disciplina" onchange="buscarProfessores(this.value)" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Selecione a Disciplina</option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{ $disciplina->id.' - '.$disciplina->disciplina}}">{{ $disciplina->disciplina }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-5">
                    <label>Professores</label>
                    <select class="form-control select-professor" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected='selected'>Selecione o Professor</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <button class="btn btn-success add-disciplina" type="button" style="margin-top: 23px">Adicionar</button>
                </div>
			</div>

			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-responsive" id="tabelaDisciplinaProfessor">
                        <thead>
                            <tr>
                                <th>Matricula Professor</th>
                                <th>Nome Professor</th>
                                <th>Código Disciplina</th>
                                <th>Nome Disciplina</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <input type="hidden" class="form-control" id="disciplinas" name="disciplinas" />
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Alunos</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-5">
                    <input type="search" class="form-control select-disciplina" id="search" placeholder="Pesquisar Aluno" />
                </div>

                <div class="form-group col-md-2">
                    <button class="btn btn-success pesquisar-aluno" type="button">Pesquisar</button>
                </div>
			</div>

			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-responsive" id="tabelaAluno">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nome</th>
                                <th>CPF</th>
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
			<h3 class="box-title">Alunos Matriculados</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-responsive" id="tabelaAlunosMatriculados">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <input type="hidden" class="form-control" id="alunos" name="alunos" />
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">

            <div class="row-fluid">
				<div class="form-group col-md-12">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>

			<button class="btn btn-primary cadastrar-turma" type="button"><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger cadastrar-turma" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>

</form>
@endsection
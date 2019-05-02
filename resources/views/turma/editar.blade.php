@extends('layouts.layout')

@section('page-header')
<h1>Editar Turma {{ $turma->nome_turma }}</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard fw"></i> Dashboard</a></li>
	<li><a href="{{ Route('turma') }}"> Turmas</a></li>
	<li class="active"> Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('turma-teste') }}" method="POST" id="formCadastrarTurma">
	@csrf

	@include('includes.alert-errors')

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados da Turma</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="modalidade">Modalidade</label>
					<select name="modalidade" id="modalidade" value="{{ $turma->modalidade }}" class="form-control">
                        <option value="">Escolha a Modalidade</option>
                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                        <option value="Ensino Médio">Ensino Médio</option>
                        <option value="EJA">EJA</option>
                    </select>
				</div>

				<div class="form-group col-md-4">
                    <label for="serie">Série</label>
					<select name="serie" id="serie" value="{{ $turma->serie }}" class="form-control">
                        <option value="">Escolha a Série</option>
                    </select>
				</div>

				<div class="form-group col-md-4">
                    <label for="descricaoSerie">Descrição da Série</label>
					<input type="text" name="descricao_serie" class="form-control" id="descricaoSerie" value="{{ $turma->descricao_serie }}" placeholder="Descrição da Série" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-4">
                    <label for="turno">Turno</label>
					<select name="turno" id="turno" value="{{ $turma->turno }}" class="form-control">
                        <option value="">Escolha o Turno</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Noturno">Noturno</option>
                    </select>	
				</div>
				
				<div class="form-group col-md-4">
					<label for="descricaoTurma">Descrição da Turma</label>
					<input type="text" name="descriao_turma" class="form-control" id="descricaoTurma" value="{{ $turma->descriao_turma }}" placeholder="Descrição da Turma" />
				</div>

				<div class="form-group col-md-2">
                    <div class="checkbox" style="margin-top: 35px">
                        <label>
                          <input type="checkbox" name="is_active" id="isAtiva" {{ (($turma->is_active) ? 'checked' : '') }} />
                          Ativada
                        </label>
                    </div>
				</div>
				
				<div class="form-group col-md-2">
                    <div class="checkbox" style="margin-top: 35px">
                        <label>
                          <input type="checkbox" name="is_cancelada" id="isCancelada" {{ (($turma->is_cancelada) ? 'checked' : '') }} />
                          Cancelada
                        </label>
                    </div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="dataCadastro">Data Cadastro</label>
					<input type="text" class="form-control mask-data" id="dataCadastro" name="dataCadastro" value="{{ date_format(date_create($turma->created_at), 'd/m/Y' ) }}" disabled />
				</div>
				<div class="form-group col-md-3">
					<label for="modificadaEm">Modificada Em</label>
					<input type="text" class="form-control mask-data" id="modificadaEm" name="modificadaEm" value="{{ date_format(date_create($turma->modified_at), 'd/m/Y' ) }}" disabled />
				</div>

				<div class="form-group col-md-3">
                    <label for="canceladaEm">Cancelada Em</label>
					<input type="text" class="form-control mask-data" id="canceladaEm" name="cancelado_em" value="{{ (($turma->cancelada_em) ? date_format(date_create($turma->cancelada_em), 'd/m/Y' ) : '') }}" placeholder="Cancelada Em" disabled />
				</div>

				<div class="form-group col-md-3">
                    <label for="ativadaEm">Desativada Em</label>
					<input type="text" class="form-control mask-data" id="ativadaEm" name="desativada_em" value="{{ (($turma->desativada_em) ? date_format(date_create($turma->desativada_em), 'd/m/Y' ) : '') }}" placeholder="Desativada Em" disabled />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-6">
					<label for="turma">Turma</label>
					<input type="text" class="form-control" id="turma" value="{{ $turma->nome_turma }}" disabled />
				</div>
				<div class="form-group col-md-6">
					<input type="hidden" name="nome_turma" id="turmaHidden" value="{{ $turma->nome_turma }}" class="form-control" />
				</div>
			</div>

		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" type="button"><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('turma') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>

</form>
@endsection
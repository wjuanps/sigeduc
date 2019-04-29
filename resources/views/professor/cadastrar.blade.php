@extends('layouts.layout')

@section('page-header')
<h1>Cadastrar Professor</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('professor') }}">Professor</a></li>
	<li class="active">Cadastrar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('gravar-professor') }}" method="POST" class="form">
	@csrf

	@include('includes.alert-errors')

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados Pessoais</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-8">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" required="true" placeholder="Informe o nome" />
				</div>

				<div class="form-group col-md-4">
					<div class="radio">
						<fieldset style=" margin-top: -12px">
							<legend style="font-size: 14px; font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bolder">Sexo</legend>
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="M" checked="true" />
								Masculino
							</label>&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="F" />
								Feminino
							</label>
							<label>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="sexo" id="optionsRadios1" value="I" />
								Não Declarado
							</label>
						</fieldset>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="nascimento">Nascimento</label>
					<input type="text" name="data_nascimento" class="form-control mask-data" id="nascimento" placeholder="Nascimento" />
				</div>
				<div class="form-group col-md-3">
					<label for="nacionalidade">Nacionalidade</label>
					<input type="text" class="form-control" id="nacionalidade" name="nacionalidade" placeholder="Nacionalidade" />
				</div>
				<div class="form-group col-md-3">
					<label for="naturalidade">Naturalidade</label>
					<input type="text" class="form-control" id="naturalidade" name="naturalidade" placeholder="Naturalidade" />
				</div>
				<div class="form-group col-md-3">
					<label for="uf">UF</label>
					<select name="naturalidade_uf" id="ufNaturalidade" class="form-control uf1"></select>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="identidade">Identidade</label>
					<input type="text" name="rg" class="form-control mask-identidade" id="identidade" placeholder="Identidade" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="cpf">CPF</label>
					<input type="text" class="form-control mask-cpf" id="cpf" name="cpf" placeholder="CPF" />
				</div>

				<div class="form-group col-md-6">
					<label for="foto">Foto</label>
					<input type="file" id="foto" name="foto" class="form-control btn-block">
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
					<br /><legend>Endereço</legend><br />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-5">
					<label for="rua">Rua</label>
					<input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" />
				</div>
				<div class="form-group col-md-4">
					<label for="complemento">Complemento</label>
					<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" />
				</div>
				<div class="form-group col-md-3">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="cidade">Cidade</label>
					<input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" />
				</div>
				<div class="form-group col-md-4">
					<label for="uf">UF</label>
					<select name="uf" id="uf" class="form-control uf2"></select>
				</div>
				<div class="form-group col-md-4">
					<label for="cep">CEP</label>
					<input type="text" class="form-control mask-cep" id="cep" name="cep" placeholder="CEP" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" class="form-control mask-telefone" id="telefone" placeholder="Telefone" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="celular">Celular</label>
					<input type="text" class="form-control mask-telefone" id="celular" name="celular" placeholder="Celular" />
				</div>

				<div class="form-group col-md-6">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" />
				</div>
			</div>

			<div class="form-group col-md-3">
				<input type="hidden" class="form-control" name="dataCadastro" disabled id="dataCadastro" value="{{ date_format(date_create(), 'Y-m-d H:i:s' ) }}" />
			</div>

		</div><!-- /.box-body -->
	</div>

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Formação Acadêmica</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label>Titulo</label>
					<select class="form-control" id="titulo" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option></option>
						<option>Graduação</option>
						<option>Especialização</option>
						<option>Mestrado</option>
						<option>Doutorado</option>
						<option>Pós Doutorado</option>
					</select>
				</div>

				<div class="form-group col-md-4">
					<label for="curso">Curso</label>
					<input type="text" id="curso" class="form-control" placeholder="curso" />
				</div>

				<div class="form-group col-md-4">
					<label for="instituicao">Instituição</label>
					<input type="text" id="instituicao" class="form-control" placeholder="Instituição" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="anoInicio">Ano Inicio</label>
					<select class="form-control" id="anoInicio" style="width: 100%;" tabindex="-1" aria-hidden="true">
						@for($i = 1970; $i <= date_format(date_create(), 'Y' ) + 10; $i++) @if(date_format(date_create(), 'Y' )==$i)
						 <option selected>{{ $i }}</option>
							@else
							<option>{{ $i }}</option>
							@endif
							@endfor
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="anoTermino">Ano Término</label>
					<select class="form-control" id="anoTermino" style="width: 100%;" tabindex="-1" aria-hidden="true">
						@for($i = 1970; $i <= date_format(date_create(), 'Y' ) + 10; $i++) @if((date_format(date_create(), 'Y' ) + 4)==$i)
						 <option selected>{{ $i }}</option>
							@else
							<option>{{ $i }}</option>
							@endif
							@endfor
					</select>
				</div>

				<div class="form-group col-md-6">
					<label for="diploma">Diploma</label>
					<input type="file" id="diploma" class="form-control btn-block" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<button type="button" id="addFormacao" class="btn btn-success">Adicionar Formação</button>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<br /><legend>Lista de Formações</legend><br />
				</div>
			</div>

			<div class="row-fluid">
				<table class="table table-responsive table-striped" id="tableProfessor">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Curso</th>
							<th>Instituição</th>
							<th>Ano Inicio</th>
							<th>Ano Término</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<input type="hidden" class="form-control" name="formacoes" id="formacoes" />
		</div><!-- /.box-body -->
	</div>

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Disciplinas</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group">
					<label>Disciplinas</label>
					<select class="form-control select2 select2-hidden-accessible" name="disciplinas[]" multiple="" data-placeholder="Selecionar Desciplina"
						style="width: 100%;" tabindex="-1" aria-hidden="true">
						@foreach($disciplinas as $disciplina)
						<option value="{{ $disciplina->id }}">{{ $disciplina->disciplina }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" id="submeterCadastroProfessor" type="button">Salvar Alterações</button>
			<a href="{{ Route('professor') }}" class="btn btn-danger">Cancelar</a>
		</div>
	</div>
</form>
@endsection
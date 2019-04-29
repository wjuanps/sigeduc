@extends('layouts.layout')

@section('page-header')
<h1>Cadastrar Funcionário</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('funcionario') }}"> Funcionário</a></li>
	<li class="active"> Cadastrar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('gravar-funcionario') }}" method="POST" id="formCadastroFuncionario">
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

				<div class="form-group col-md-3">
                    <label>Escolaridade</label>
                    <select class="form-control select2 select2-hidden-accessible" name="escolaridade" id="escolaridade" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected">Selecione</option>
						<option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
						<option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
						<option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
						<option value="Ensino Médio Completo">Ensino Médio Completo</option>
						<option value="Ensino Superior Incompleto">Ensino Superior Incompleto</option>
						<option value="Ensino Superior Completo">Ensino Superior Completo</option>
						<option value="Pós Graduação">Pós Graduação</option>
						<option value="Mestrado">Mestrado</option>
						<option value="Doutorado">Doutorado</option>
                    </select>
                </div>

				<div class="form-group col-md-3">
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

		</div><!-- /.box-body -->
	</div>

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Dados da Carteira de Trabalho</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="numero">Número</label>
					<input type="text" id="numero" name="numero_ctps" class="form-control" placeholder="Número" />
                </div>

				<div class="form-group col-md-4">
					<label for="serie">Série</label>
					<input type="text" id="serie" name="serie_ctps" class="form-control" placeholder="Série" />
				</div>

				<div class="form-group col-md-4">
					<label for="dataEmissao">Data de Emissão</label>
					<input type="text" id="dataEmissao" name="data_emissao_carteira" class="form-control mask-data" placeholder="Data de Emissão" />
				</div>

			</div>

			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="numeroPis">Número do PIS</label>
					<input type="text" id="numeroPis" name="numero_pis" class="form-control" placeholder="Número do PIS" />
                </div>

				<div class="form-group col-md-4">
					<label for="dependentes">Dependentes</label>
					<input type="number" id="dependentes" name="qtd_dependentes" class="form-control" placeholder="Dependentes" />
				</div>

				<div class="form-group col-md-4">
					
				</div>

			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Dados da Função</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-3">
                    <label>Cargo/Função</label>
                    <select class="form-control select2 select2-hidden-accessible" name="cargo" id="cargo" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected">Selecione</option>
						@isset($cargos)
							@foreach($cargos as $cargo)
								<option value="{{ ($cargo->id . ' - ' . $cargo->cargo_funcao) }}">{{ $cargo->cargo_funcao }}</option>
							@endforeach
						@endisset
                    </select>
                </div>

				<div class="form-group col-md-3">
					<label for="cargaHoraria">Carga Horária (Semanal)</label>
					<input type="number" id="cargaHoraria" name="carga_horaria" class="form-control" placeholder="Carga Horária" />
				</div>

				<div class="form-group col-md-3">
					<div class="checkbox" style="margin-top: 30px">
                        <label>
                          <input type="checkbox" name="is_cargo_atual" id="cargoAtual" />
                          Cargo Atual
                        </label>
                    </div>
				</div>

				<div class="form-group col-md-3">
					<button class="btn btn-success" type="button" id="adicionarCargo" style="margin-top: 23px">Adicionar</button>
				</div>

				<div class="row">
					<div class="col-md-12">
						<br /><legend>Cargos/Funções</legend><br />
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-12">
						<table class="table table-striped table-responsive" id="tabelaFuncionario">
							<thead>
								<tr>
									<th>Cargo/Função</th>
									<th>Cargo Horária</th>
									<th>Data Admissão</th>
									<th>Data Demissão</th>
									<th>Cargo Atual</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						<input type="hidden" class="form-control" id="funcionarioCargos" name="funcionarioCargos" />
					</div>
				</div>

			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" type="button" id="submeterCadastroFuncionario">Salvar Alterações</button>
			<a href="{{ Route('home') }}" class="btn btn-danger">Cancelar</a>
		</div>
	</div>

</form>
@endsection
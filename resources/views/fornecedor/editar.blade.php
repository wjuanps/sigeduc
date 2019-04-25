@extends('layouts.layout')

@section('page-header')
<h1>Editar Fornecedor</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li><a href="{{ Route('fornecedor') }}">Fornecedor</a></li>
	<li class="active">Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('fornecedor-teste') }}" method="POST">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Fornecedor</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-8">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="nome" id="nome" value="{{ $fornecedor->nome_fantasia }}" placeholder="Informe o nome" />
				</div>

				<div class="form-group col-md-4">
					<div class="radio">
						<fieldset style=" margin-top: -12px">
							<legend style="font-size: 14px; font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bolder">tipo</legend>
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="Pessoa Física" {{ ($fornecedor->tipo == 'Pessoa Física') ? 'checked' : '' }} />
								Pessoa Física
							</label>&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="Pessoa Jurídica" {{ ($fornecedor->tipo == 'Pessoa Jurídica') ? 'checked' : '' }} />
								Pessoa Jurídica
							</label>
						</fieldset>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="nascimento">Razão Social</label>
					<input type="text" name="razaoSocial" class="form-control" id="razaoSocial" value="{{ $fornecedor->razao_social }}" placeholder="Razão Social" />
				</div>
				<div class="form-group col-md-3">
					<label for="nacionalidade">Segmento</label>
					<input type="text" class="form-control" name="segmento" id="segmento" value="{{ $fornecedor->segmento }}" placeholder="Segmento" />
				</div>
				<div class="form-group col-md-3">
					<label for="naturalidade">Data Fundação</label>
					<input type="text" class="form-control mask-data" name="dataFundacao" id="dataFundacao" value="{{ date_format(date_create($fornecedor->data_fundacao), 'd/m/Y') }}" placeholder="Data Fundação" />
				</div>
				<div class="form-group col-md-3">
					<label for="logo">Logo</label>
					<input type="file" id="logo" class="form-control btn-block" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="ie">Inscrição Estadual</label>
					<input type="text" name="ie" class="form-control" id="ie" value="{{ $fornecedor->inscricao_estadual }}" placeholder="Inscrição Estadua" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="cpfCnpj">CPF/CNPJ</label>
					<input type="text" class="form-control" name="cpfCnpj" id="cpfCnpj" value="{{ $fornecedor->cnpj }}" placeholder="CPF/CNPJ" />
				</div>

				<div class="form-group col-md-6">
					<label for="site">Site</label>
					<input type="text" id="site" name="site" class="form-control" value="{{ $fornecedor->site }}" placeholder="Site" />
				</div>

			</div>

		</div><!-- /.box-body -->
	</div>

	<div class="box box-danger">
		<div class="box-header with-border">
			<h3 class="box-title">Endereço</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-5">
					<label for="nascimento">Rua</label>
					<input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" value="{{ $fornecedor->endereco->rua }}" />
				</div>
				<div class="form-group col-md-4">
					<label for="complemento">Complemento</label>
					<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="{{ $fornecedor->endereco->complemento }}" />
				</div>
				<div class="form-group col-md-3">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{ $fornecedor->endereco->bairro }}" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="cidade">Cidade</label>
					<input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" value="{{ $fornecedor->endereco->cidade }}" />
				</div>
				<div class="form-group col-md-4">
					<label for="uf">UF</label>
					<input type="text" class="form-control" id="uf" name="uf" placeholder="UF" value="{{ $fornecedor->endereco->uf }}" />
				</div>
				<div class="form-group col-md-4">
					<label for="cep">CEP</label>
					<input type="text" class="form-control mask-cep" id="cep" name="cep" placeholder="CEP" value="{{ $fornecedor->endereco->cep }}" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" class="form-control mask-telefone" id="telefone" placeholder="Telefone" value="{{ $fornecedor->telefone }}" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="celular">Celular</label>
					<input type="text" class="form-control mask-telefone" id="celular" name="celular" placeholder="Celular" value="{{ $fornecedor->celular }}" />
				</div>

				<div class="form-group col-md-6">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $fornecedor->email }}" />
				</div>

			</div>
		</div><!-- /.box-body -->
	</div>
	
	<div class="box box-warning">
		<div class="box-body">
		<button class="btn btn-primary" type="submit"><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>
</form>
@endsection

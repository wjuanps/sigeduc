@extends('layouts.layout')

@section('page-header')
<h1>Cadastrar Fornecedor</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li><a href="{{ Route('fornecedor') }}">Fornecedor</a></li>
	<li class="active">Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('gravar-fornecedor') }}" method="POST">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Fornecedor</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-8">
					<label for="nome_fantasia">Nome Fantasia</label>
					<input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" required="required" placeholder="Informe o nome fantasia" />
				</div>

				<div class="form-group col-md-4">
					<div class="radio">
						<fieldset style=" margin-top: -12px">
							<legend style="font-size: 14px; font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bolder">tipo</legend>
							<label>
								<input type="radio" name="tipo" id="optionsRadios1" value="Pessoa Física" />
								Pessoa Física
							</label>&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="tipo" id="optionsRadios1" value="Pessoa Jurídica" />
								Pessoa Jurídica
							</label>
						</fieldset>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="razao_social">Razão Social</label>
					<input type="text" name="razao_social" class="form-control" id="razao_social" required="required" placeholder="Razão Social" />
				</div>
				<div class="form-group col-md-3">
					<label for="segmento">Segmento</label>
					<input type="text" class="form-control" name="segmento" id="segmento" placeholder="Segmento" />
				</div>
				<div class="form-group col-md-3">
					<label for="data_fundacao">Data Fundação</label>
					<input type="text" class="form-control mask-data" name="data_fundacao" id="data_fundacao" placeholder="Data Fundação" />
				</div>
				<div class="form-group col-md-3">
					<label for="logo">Logo</label>
					<input type="file" id="logo" class="form-control btn-block" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="inscricao_estadual">Inscrição Estadual</label>
					<input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual" placeholder="Inscrição Estadua" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="cnpj">CPF/CNPJ</label>
					<input type="text" class="form-control" name="cnpj" id="cnpj" required="required" placeholder="CPF/CNPJ" />
				</div>

				<div class="form-group col-md-6">
					<label for="site">Site</label>
					<input type="text" id="site" name="site" class="form-control" placeholder="Site" />
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
					<input type="text" class="form-control" id="uf" name="uf" placeholder="UF" />
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

			<button class="btn btn-primary" type="submit"><i class="fa fa-external-link-square fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>
</form>
@endsection

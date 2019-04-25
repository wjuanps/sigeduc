@extends('layouts.layout')

@section('page-header')
<h1>Editar Aluno</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li><a href="{{ Route('aluno') }}">Aluno</a></li>
	<li class="active">Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('aluno-teste') }}" method="POST" class="formCadastroAluno">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Aluno</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-8">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="nome" id="nome" value="{{ $aluno->pessoa->nome }}" placeholder="Informe o nome" />
				</div>

				<div class="form-group col-md-4">
					<div class="radio">
						<fieldset style=" margin-top: -12px">
							<legend style="font-size: 14px; font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bolder">Sexo</legend>
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="M" {{ ($aluno->pessoa->sexo == 'M') ? 'checked' : '' }} />
								Masculino
							</label>&nbsp;&nbsp;&nbsp;
							<label>
								<input type="radio" name="sexo" id="optionsRadios1" value="F" {{ ($aluno->pessoa->sexo == 'F') ? 'checked' : '' }} />
								Feminino
							</label>
							<label>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="sexo" id="optionsRadios1" value="I" {{ ($aluno->pessoa->sexo == 'I') ? 'checked' : '' }} />
								Não Declarado
							</label>
						</fieldset>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="nascimento">Nascimento</label>
					<input type="text" name="data_nascimento" class="form-control mask-data" id="nascimento" value="{{ date_format(date_create($aluno->pessoa->data_nascimento), 'd/m/Y') }}" placeholder="Nascimento" />
				</div>
				<div class="form-group col-md-3">
					<label for="nacionalidade">Nacionalidade</label>
					<input type="text" class="form-control" name="nacionalidade" id="nacionalidade" value="{{ $aluno->pessoa->nacionalidade }}" placeholder="Nacionalidade" />
				</div>
				<div class="form-group col-md-3">
					<label for="naturalidade">Naturalidade</label>
					<input type="text" class="form-control" name="naturalidade" id="naturalidade" value="{{ $aluno->pessoa->naturalidade }}" placeholder="Naturalidade" />
				</div>
				<div class="form-group col-md-3">
					<label for="uf">UF</label>
					<select name="ufNaturalidade" id="ufNaturalidade" class="form-control uf1"></select>
					<input type="hidden" disabled value="{{ $aluno->pessoa->naturalidade_uf }}" class="ufHidden1" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="identidade">Identidade</label>
					<input type="text" name="identidade" class="form-control mask-identidade" id="identidade" value="{{ $aluno->pessoa->rg }}" placeholder="Identidade" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="cpf">CPF</label>
					<input type="text" class="form-control mask-cpf" name="cpf" id="cpf" value="{{ $aluno->pessoa->cpf }}" placeholder="CPF" />
				</div>

				<div class="form-group col-md-6">
					<label for="foto">Foto</label>
					<input type="file" id="foto" class="form-control btn-block">
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3">
					<div class="checkbox" style="margin-top: 20px">
                        <label>
                          <input type="checkbox" name="praticaEdFisica" id="praticaEdFisica" {{ ($aluno->pratica_ed_fisica) ? 'checked' : '' }} />
                          Pratica ed. Física
                        </label>
                    </div>
				</div>
				
				<div class="form-group col-md-3">
					<div class="checkbox" style="margin-top: 20px">
                        <label>
                          <input type="checkbox" name="irmaosNaEscola" id="irmaosNaEscola" {{ ($aluno->irmao_na_escola) ? 'checked' : '' }} />
                          Irmãos na Escola
                        </label>
                    </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<legend>Endereço</legend>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-5">
					<label for="nascimento">Rua</label>
					<input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" value="{{ $aluno->pessoa->endereco->rua }}" />
				</div>
				<div class="form-group col-md-4">
					<label for="complemento">Complemento</label>
					<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="{{ $aluno->pessoa->endereco->complemento }}" />
				</div>
				<div class="form-group col-md-3">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{ $aluno->pessoa->endereco->bairro }}" />
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-4">
					<label for="cidade">Cidade</label>
					<input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" value="{{ $aluno->pessoa->endereco->cidade }}" />
				</div>
				<div class="form-group col-md-4">
					<label for="uf">UF</label>
					<select name="uf" id="uf" value="{{ $aluno->pessoa->endereco->uf }}" class="form-control uf2"></select>
					<input type="hidden" disabled value="{{ $aluno->pessoa->endereco->uf }}" class="ufHidden2" />
				</div>
				<div class="form-group col-md-4">
					<label for="cep">CEP</label>
					<input type="text" class="form-control mask-cep" id="cep" name="cep" placeholder="CEP" value="{{ $aluno->pessoa->endereco->cep }}" />
				</div>
			</div>

			<div class="row-fluid">
			<div class="form-group col-md-3">
					<label for="telefone">Telefone</label>
					<input type="text" name="telefone" class="form-control mask-telefone" id="telefone" placeholder="Telefone" value="{{ $aluno->pessoa->telefone }}" />
				</div>
				
				<div class="form-group col-md-3">
					<label for="celular">Celular</label>
					<input type="text" class="form-control mask-telefone" id="celular" name="celular" placeholder="Celular" value="{{ $aluno->pessoa->celular }}" />
				</div>

				<div class="form-group col-md-6">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $aluno->pessoa->email }}" />
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Responsável</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div id="formularioCadastroResponsavel" class="hidden">
				<div class="row-fluid">
					<div class="form-group col-md-4">
						<label for="nomeResponsavel">Nome Completo</label>
						<input type="text" class="form-control" id="nomeResponsavel" placeholder="Informe o nome" />
					</div>
					
					<div class="form-group col-md-4">
						<label for="parentesco">Parentesco</label>
						<input type="text" class="form-control" id="parentesco" placeholder="Informe o parentesco" />
					</div>

					<div class="form-group col-md-4">
						<div class="radio">
							<fieldset style=" margin-top: -12px">
								<legend style="font-size: 14px; font-family:'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-weight: bolder">Sexo</legend>
								<label>
									<input type="radio" name="sexoResponsavel" id="sexoResponsavel" value="M" checked="true" />
									Masculino
								</label>&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="sexoResponsavel" id="sexoResponsavel" value="F" />
									Feminino
								</label>
								<label>&nbsp;&nbsp;&nbsp;
									<input type="radio" name="sexoResponsavel" id="sexoResponsavel" value="I" />
									Não Declarado
								</label>
							</fieldset>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-3">
						<label for="nascimentoResponsavel">Nascimento</label>
						<input type="text" class="form-control mask-data" id="nascimentoResponsavel" placeholder="Nascimento" />
					</div>
					<div class="form-group col-md-3">
						<label for="nacionalidadeResponsavel">Nacionalidade</label>
						<input type="text" class="form-control" id="nacionalidadeResponsavel" placeholder="Nacionalidade" />
					</div>
					<div class="form-group col-md-3">
						<label for="naturalidadeResponsavel">Naturalidade</label>
						<input type="text" class="form-control" id="naturalidadeResponsavel" placeholder="Naturalidade" />
					</div>
					<div class="form-group col-md-3">
						<label for="ufNaturalidadeResponsavel">UF</label>
						<input type="text" class="form-control" id="ufNaturalidadeResponsavel" placeholder="UF" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-3">
						<label for="identidadeResponsavel">Identidade</label>
						<input type="text" class="form-control mask-identidade" id="identidadeResponsavel" placeholder="Identidade" />
					</div>
					
					<div class="form-group col-md-3">
						<label for="cpfResponsavel">CPF</label>
						<input type="text" class="form-control mask-cpf" id="cpfResponsavel" placeholder="CPF" />
					</div>

					<div class="form-group col-md-6">
						<div class="form-group col-md-6">
							<div class="checkbox" style="margin-top: 30px">
								<label>
									<input type="checkbox" id="moraComOFilho" onchange="copiarEnderecoAlunoParaResponsavel(this)" />
									Mora com o Filho
								</label>
							</div>
						</div>
						
						<div class="form-group col-md-6">
							<div class="checkbox" style="margin-top: 30px">
								<label>
									<input type="checkbox" id="outroFilhoNaEscola" />
									Outro Filho na Escola
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<legend>Endereço</legend>
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-5">
						<label for="ruaResponsavel">Rua</label>
						<input type="text" class="form-control" id="ruaResponsavel" placeholder="Rua" />
					</div>
					<div class="form-group col-md-4">
						<label for="complementoResponsavel">Complemento</label>
						<input type="text" class="form-control" id="complementoResponsavel" placeholder="Complemento" />
					</div>
					<div class="form-group col-md-3">
						<label for="bairroResponsavel">Bairro</label>
						<input type="text" class="form-control" id="bairroResponsavel" placeholder="Bairro" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-4">
						<label for="cidadeResponsavel">Cidade</label>
						<input type="text" class="form-control" id="cidadeResponsavel" placeholder="Cidade" />
					</div>
					<div class="form-group col-md-4">
						<label for="ufResponsavel">UF</label>
						<input type="text" class="form-control" id="ufResponsavel" placeholder="UF" />
					</div>
					<div class="form-group col-md-4">
						<label for="cepResponsavel">CEP</label>
						<input type="text" class="form-control mask-cep" id="cepResponsavel" placeholder="CEP" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-3">
						<label for="telefoneResponsavel">Telefone</label>
						<input type="text" class="form-control mask-telefone" id="telefoneResponsavel" placeholder="Telefone" />
					</div>
					
					<div class="form-group col-md-3">
						<label for="celularResponsavel">Celular</label>
						<input type="text" class="form-control mask-telefone" id="celularResponsavel" placeholder="Celular" />
					</div>

					<div class="form-group col-md-6">
						<label for="emailResponsavel">Email</label>
						<input type="email" id="emailResponsavel" class="form-control" placeholder="Email" />
					</div>
				</div>
			</div>	

			<div id="tabelaSelecionarResponsavel" class="">
				<div class="row-fluid">
					<div class="form-group col-md-5">
						<input type="search" class="form-control" id="searchResponsavel" placeholder="Pesquisar Responsável" />
					</div>

					<div class="form-group col-md-2">
						<button class="btn btn-success pesquisar-responsavel" type="button">Pesquisar</button>
					</div>
				</div>

				<div class="row-fluid">
					<div class="form-group col-md-12">
						<table class="table table-striped table-responsive" id="tabelaResponsavel">
							<thead>
								<tr>
									<th>Nome</th>
									<th>CPF</th>
									<th>Parentesco</th>
									<th>#</th>
									<th>#</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="form-group col-md-3 hidden" id="salvarDadosResponsavel">
					<br /><button class="btn btn-primary" type="button">Salvar dados do Responsável</button>
				</div>

				<div class="form-group col-md-3">
					<div class="checkbox" style="margin-top: 30px">
						<label>
							<input type="checkbox" id="possuiCadastro" />
							Não Possui Cadastro
						</label>
					</div>
				</div>
			</div>		

		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Responsáveis</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-12">

                    <table class="table table-striped table-responsive" id="tabelaResponsaveisAluno">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Parentesco</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>email</th>
                                <th>Mora com o filho</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
							@isset($aluno->responsaveis)
								@foreach($aluno->responsaveis as $responsavel)
									<tr>
										<td>{{ $responsavel->pessoa->nome }}</td>
										<td>{{ $responsavel->pivot->parentesco }}</td>
										<td>{{ $responsavel->pessoa->telefone }}</td>
										<td>{{ $responsavel->pessoa->celular }}</td>
										<td>{{ $responsavel->pessoa->email }}</td>
										<td>{{ $responsavel->pivot->mora_com_filho }}</td>
										<td>{{ $responsavel->id }}</td>
									</tr>
								@endforeach
							@endisset
						</tbody>
                    </table>
                    <input type="hidden" class="form-control" id="responsaveisAluno" name="responsaveisAluno" />
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

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
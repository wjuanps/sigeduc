@extends('layouts.layout')

@section('page-header')
<h1>Diário de Classe</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('professor') }}"> Professor</a></li>
	<li class="active"> Diário de Classe</li>
</ol>
@endsection

@section('content')
<form action="" method="POST">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Diário de Classe</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-3">
					<label for="serie">Professor</label>
					<select class="form-control select2 select2-hidden-accessible" onchange="buscarDisciplinas(this.value)" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected">Selecione</option>
						@isset($professores)
						@foreach($professores as $professor)
						<option value="{{ $professor->id }}">{{ $professor->pessoa->nome }}</option>
						@endforeach
						@endisset
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="serie">Disciplina</label>
					<select class="form-control select2 select2-hidden-accessible select-disciplina" onchange="buscarTurmas(this.value)" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected">Selecione</option>
					</select>
				</div>

				<div class="form-group col-md-3">
					<label for="serie">Turma</label>
					<select class="form-control select2 select2-hidden-accessible select-turma" onchange="getIdTurma(this.value)" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option selected="selected">Selecione</option>
					</select>
				</div>

				<div class="form-group col-md-3">
					<button class="btn btn-primary" type="button" id="gerarDiarioClasse" style="margin-top: 23px">Gerar Diário de Classe</button>
				</div>
			</div>

		</div><!-- /.box-body -->
	</div>

	<div class="box box-gray">
		<div class="box-header with-border">
			<h3 class="box-title">Diário de Classe</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">

				<div class="form-group">
					<div class="col-md-12">
						<table class="table table-responsive table-bordered">
							<tr><td class="bg-gray text-center" style="font-size: 15pt; font-weight: 600; color: #193774" colspan="3">Diário de Classe</td></tr>
							<tr>
								<td class="bg-gray" style="width: 20%">Turma</td>
								<td><span id="diarioTurma"></span></td>
								<td><span id="diarioModalidade"></span></td>
							</tr>
							<tr>
								<td class="bg-gray" style="width: 20%">Docente</td>
								<td colspan="2"><span id="diarioDocente"></span></td>
							</tr>
							<tr>
								<td class="bg-gray" style="width: 20%">Disciplina</td>
								<td><span id="diarioDisciplina"></span></td>
								<td>Data:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;{{ date_format(date_create(), 'Y') }}</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="form-group col-md-12">
					<table class="table table-bordered table-responsive" id="tabelaDiario">
						<thead class="bg-gray">
							<tr>
								<th>#</th>
								<th>Matricula</th>
								<th>Discente</th>
								<th>Assinatura</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary cadastrar-turma" type="button"><i class="fa fa-print fw"></i> Imprimir</button>
			<a class="btn btn-danger cadastrar-turma" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>

</form>
@endsection
@extends('layouts.layout')

@section('page-header')
<h1>Editar Cargo/Função</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li><a href="{{ Route('cargo') }}"> Cargo/Função</a></li>
	<li class="active"> Editar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('funcionario-teste') }}" method="POST">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados do Cargo</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-6">
                    <label for="cargo">Cargo/Função</label>
					<input type="text" name="cargo" class="form-control" id="cargo" value="{{ $cargo->cargo_funcao }}" placeholder="Cargo/Função" />
				</div>
			</div>

            <div class="row">
                <div class="col-md-12"><br />
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group col-md-6">
                    <label for="descricao">Descrição</label>
					<textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição" rows="3">{{ $cargo->descricao }}</textarea>
				</div>
            </div>

            <div class="row-fluid">
                <div class="form-group col-md-12"><br />
                    <button class="btn btn-primary" type="submit"><i class="fa fa-external-link-square fw"></i> Salvar Alterações</button>
                    <a class="btn btn-danger" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
                </div>
            </div>

            <input type="hidden" value="{{ $cargo->id }}" name="id" />

		</div><!-- /.box-body -->
	</div>
</form>
@endsection

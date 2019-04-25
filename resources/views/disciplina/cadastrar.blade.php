@extends('layouts.layout')

@section('page-header')
<h1>Cadastrar Disciplina</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li><a href="{{ Route('disciplina') }}">Disciplina</a></li>
	<li class="active">Cadastrar</li>
</ol>
@endsection

@section('content')
<form action="{{ Route('gravar-disciplina') }}" method="POST">
	@csrf

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Dados da disciplina</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
				<div class="form-group col-md-6">
                    <label for="disciplina">Disciplina</label>
					<input type="text" name="disciplina" class="form-control" id="disciplina" required="required" placeholder="Disciplina" />
				</div>
			</div>

            <div class="row">
                <div class="col-md-12"><br />
                </div>
            </div>

            <div class="row-fluid">
                <div class="form-group col-md-6">
                    <label for="descricao">Descrição</label>
					<textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição" required="required" rows="3"></textarea>
				</div>
            </div>

            <div class="row-fluid">
                <div class="form-group col-md-12"><br />
                    <button class="btn btn-primary" type="submit"><i class="fa fa-external-link-square fw"></i> Salvar Alterações</button>
                    <a class="btn btn-danger" href="{{ Route('home') }}"><i class="fa fa-times fw"></i> Cancelar</a>
                </div>
            </div>

		</div><!-- /.box-body -->
	</div>
</form>
@endsection

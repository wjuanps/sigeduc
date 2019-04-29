@extends('layouts.layout')

@section('page-header')
<h1>Turma {{ $turma->nome_turma.' - ('. count($turma->alunos). ' '. Str::plural('Aluno', count($turma->alunos)). ') ' }} </h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('turma') }}"> Turmas</a></li>
	<li><a href="{{ Route('aluno') }}"> Alunos</a></li>
	<li class="active"> Adicionar</li>
</ol>
@endsection

@section('content')

	@include('includes.alert-errors')
    
    <div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Alunos</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <form action="{{ Route('adicionar-alunos') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_turma" value="{{ $turma->id }}" />

                    <div class="form-group col-md-5">
                        <input type="search" class="form-control select-disciplina" required name="nomeAluno" placeholder="Pesquisar Aluno" />
                    </div>

                    <div class="form-group col-md-2">
                        <button class="btn btn-success" type="submit">Pesquisar</button>
                    </div>
                </form>
			</div>

			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-hover table-responsive" id="tabelaAluno">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Repetente</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($alunos) && count($alunos) > 0)
                                @foreach ($alunos as $aluno)
                                    <form action="{{ Route('adicionar-alunos') }}" method="POST">
										@csrf

                                        <input type="hidden" name="id_turma" value="{{ $turma->id }}" />
                                        <input type="hidden" name="id_aluno" value="{{ $aluno->id }}" />

                                        <tr>
                                            <td>{{ $aluno->matricula }}</td>
                                            <td>{{ $aluno->nome }}</td>
                                            <td>{{ $aluno->cpf }}</td>
                                            <td><input type="checkbox" name="is_repetente" /></td>
                                            <td>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check fw"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            @endif
                        </tbody>
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
                    <table class="table table-striped table-hover table-responsive" id="tabelaAlunosMatriculados">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Repetente</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($turmaAlunos) && count($turmaAlunos) > 0)
                                <form id="formAtualizarTurmasAluno" action="{{ Route('adicionar-alunos') }}" method="POST">
									@csrf

                                    <input type="hidden" name="id_turma" value="{{ $turma->id }}" />

                                    @foreach ($turmaAlunos as $aluno)
                                        <input type="hidden" name="alunos[]" value="{{ $aluno->id }}" />

                                        <tr>
                                            <td>{{ $aluno->matricula }}</td>
                                            <td>{{ $aluno->pessoa->nome }}</td>
                                            <td>{{ $aluno->pessoa->cpf }}</td>
                                            <td>{{ $aluno->pessoa->celular }}</td>
                                            <td>{{ $aluno->pessoa->email }}</td>
                                            <td>
                                                <input type="hidden" name="is_repetente[]" value="{{ $aluno->is_repetente }}" />
                                                {{ ((isset($aluno->pivot->is_repetente)) ? (($aluno->pivot->is_repetente) ? 'Sim' : 'Não') : (($aluno->is_repetente) ? 'Sim' : 'Não') ) }}
                                            </td>
                                            <td class="{{ ((isset($aluno->is_repetente)) ? 'hidden' : '') }}">
                                                <div class="btn-group">
                                                    <button class="btn btn-info btn-flat btn-sm" data-toggle="dropdown" aria-expanded="false">Ações</button>
                                                    <button type="button" class="btn btn-info btn-flat btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Editar</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#">Remover</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="{{ ((!isset($aluno->is_repetente)) ? 'hidden' : '') }}">
                                                <button class="btn btn-danger" onclick="document.getElementById('formCancelarAtualizacaoTurmasAluno').submit()" type="button"><i class="fa fa-trash-o fw"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </form>
                                <form id="formCancelarAtualizacaoTurmasAluno" action="{{ Route('adicionar-alunos') }}" method="POST">
									@csrf <input type="hidden" name="id_turma" value="{{ $turma->id }}" />
								</form>
                            @endif
                        </tbody>
                    </table>
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
			<button class="btn btn-primary" id="submeterFormulario" type="button" {{ ((count($turmaAlunos) > count($turma->alunos)) ? '' : 'disabled') }}><i class="fa fa-save fw"></i> Salvar Alterações</button>
			<a class="btn btn-danger" href="{{ Route('turma') }}"><i class="fa fa-times fw"></i> Cancelar</a>
		</div>
	</div>

@endsection

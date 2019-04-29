@extends('layouts.layout')

@section('page-header')
<h1>Turma {{ $turma->nome_turma.' - ('. count($turma->professores). ' Professores) ' }}</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('turma') }}"> Turmas</a></li>
	<li class="active"> Grade de Professores</li>
</ol>
@endsection

@section('content')

	@include('includes.alert-errors')

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Grade de Professores</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <form action="{{ Route('grade-de-professores') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_turma" value="{{ $turma->id }}" />

                    @isset($professor_ids)
                        @foreach ($professor_ids as $id)
                            <input type="hidden" name="professor_ids[]" value="{{ $id }}" />
                        @endforeach
                    @endisset

                    @isset($disciplina_ids)
                        @foreach ($disciplina_ids as $id)
                            <input type="hidden" name="disciplina_ids[]" value="{{ $id }}" />
                        @endforeach
                    @endisset

                    <div class="form-group col-md-3">
                        <label>Disciplinas</label>
                        <select name="id_disciplina" onchange="buscarProfessores(this.value)" required class="form-controll select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="">Selecione a Disciplina</option>
                            @foreach($disciplinas as $disciplina)
                                <option value="{{ $disciplina->id }}">{{ $disciplina->disciplina }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Professores</label>
                        <select name="id_professor" required class="form-controll select2 select2-hidden-accessible select-professor" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option value="">Selecione o Professor</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <button class="btn btn-success" type="submit" style="margin-top: 23px">Adicionar</button>
                    </div>
                </form>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Grade de Professores</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">
			<div class="row-fluid">
                <div class="form-group col-md-12">
                    <table class="table table-striped table-hover table-responsive" id="tabelaDisciplinaProfessor">
                        <thead>
                            <tr>
                                <th>Matricula Professor</th>
                                <th>Nome Professor</th>
                                <th>Código Disciplina</th>
                                <th>Nome Disciplina</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($professores) && count($professores) > 0)
                                @foreach ($professores as $professor)
                                    <tr>
                                        <td>{{ $professor->id_professor }}</td>
                                        <td>{{ $professor->nome_professor }}</td>
                                        <td>{{ $professor->id_disciplina }}</td>
                                        <td>{{ $professor->nome_disciplina }}</td>
                                        <td class="{{ ((!$professor->novoProfessor) ? '' : 'hidden') }}">
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
                                        <td class="{{ (($professor->novoProfessor) ? '' : 'hidden') }}">
                                            <form action="{{ Route('grade-de-professores') }}" method="POST">
                                                @csrf

                                                @isset($professor_ids)
                                                    @foreach ($professor_ids as $id)
                                                        <input type="hidden" name="professor_ids[]" value="{{ $id }}" />
                                                    @endforeach
                                                @endisset

                                                @isset($disciplina_ids)
                                                    @foreach ($disciplina_ids as $id)
                                                        <input type="hidden" name="disciplina_ids[]" value="{{ $id }}" />
                                                    @endforeach
                                                @endisset

                                                <input type="hidden" name="id_turma" value="{{ $turma->id }}" />
                                                <input type="hidden" name="id_disciplina" value="{{ $professor->id_disciplina }}" />
                                                <input type="hidden" name="id_professor" value="{{ $professor->id_professor }}" />

                                                <button class="btn btn-danger btn-sm" name="excluirProfessor" value="excluir"><i class="fa fa-minus fw"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
			</div>
		</div><!-- /.box-body -->
	</div>

	<div class="box box-warning">
		<div class="box-body">
            <form action="{{ Route('grade-de-professores') }}" method="POST">
                @csrf

                @isset($professor_ids)
                    @foreach ($professor_ids as $id)
                        <input type="hidden" name="professor_ids[]" value="{{ $id }}" />
                    @endforeach
                @endisset

                @isset($disciplina_ids)
                    @foreach ($disciplina_ids as $id)
                        <input type="hidden" name="disciplina_ids[]" value="{{ $id }}" />
                    @endforeach
                @endisset

                <input type="hidden" name="id_turma" value="{{ $turma->id }}" />

                <button class="btn btn-primary" type="submit" name="salvarProfessores" value="salvar" {{ ((count($professores) > count($turma->professores)) ? '' : 'disabled') }}><i class="fa fa-save fw"></i> Salvar Alterações</button>
                <a class="btn btn-danger" href="{{ Route('turma') }}"><i class="fa fa-times fw"></i> Cancelar</a>
            </form>
		</div>
	</div>
@endsection
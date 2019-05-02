@extends('layouts.layout')

@section('page-header')
<h1>Lançar Nota</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li><a href="{{ Route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="{{ Route('aluno') }}"> Alunos</a></li>
	<li class="active"> Lançar Nota</li>
</ol>
@endsection

@section('content')

    @if (isset($success))
        <div class="box box-info">
            <div class="box-body">
                <div class="row-fluid">
                    <div class="form-group col-md-12">
                        <h3>Dados atualizados com sucesso!!</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Selecionar Aluno</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row-fluid">
                <form action="{{ Route('lancar-nota') }}" method="POST">
                    @csrf

                    <div class="form-group col-md-3">
                        <label for="anoLetivo">Ano Letivo</label>
                        <select class="form-control select2 select2-hidden-accessible" name="anoLetivo" id="anoLetivo" style="width: 100%;" tabindex="-1" aria-hidden="true" required="required">
                            <option value="">Selecione</option>
                            @for ($i = 1970; $i <= 2100; $i++)
                                <option {{ (($aluno->anoLetivo == $i) ? 'selected' : '') }} value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nomeAluno">Nome do(a) Aluno(a)</label>
                        <input type="text" name="nomeAluno" class="form-control" id="nomeAluno" value="{{ $aluno->nomeAluno }}" required="required" />
                    </div>

                    <div class="form-group col-md-2" style="margin-top: 25px">
                        <button class="btn btn-success"><i class="fa fa-search fw"></i></button>
                    </div>
                </form>

            </div>

            @if (isset($alunos) && count($alunos) > 0)
                <div class="row-fluid">
                    <div class="form-group col-md-12">
                        <table class="table table-hover table-responsive" id="tabelaDiario">
                            <thead>
                                <tr>
                                    <th>Matricula</th>
                                    <th>Nome</th>
                                    <th>cpf</th>
                                    <th>Turma</th>
                                    <th>Série</th>
                                    <th>Modalidade</th>
                                    <th>Ano</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alunos as $aluno)
                                    <tr>
                                        <form action="{{ Route('lancar-nota') }}" method="POST" id="formAluno">
                                            @csrf

                                            <input type="hidden" name="alunoSelecionado" value="{{ $aluno }}" />

                                            <td>{{ $aluno->matricula }}</td>
                                            <td>{{ $aluno->nome }}</td>
                                            <td>{{ $aluno->cpf }}</td>
                                            <td>{{ $aluno->nome_turma }}</td>
                                            <td>{{ $aluno->serie }}</td>
                                            <td>{{ $aluno->modalidade }}</td>
                                            <td>{{ $aluno->ano }}</td>
                                            <td><button class="btn btn-success btn-sm" type="submit"><i class="fa fa-check fw"></i></button></td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @if (isset($alunoSelecionado) && isset($professores) && count($professores) > 0)
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Selecionar Professor e Disciplina</h3>
            </div>

            <div class="box-body">
                <div class="row-fluid">
                    <div class="form-group col-md-3">
                        <label for="matriculaAluno">Matricula</label>
                        <input id="matriculaAluno" value="{{ $alunoSelecionado->matricula }}" type="text" disabled="disabled" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nomeAluno">Aluno(a)</label>
                        <input id="nomeAluno" value="{{ $alunoSelecionado->nome }}" type="text" disabled="disabled" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="turma">Turma</label>
                        <input id="turma" value="{{ $alunoSelecionado->nome_turma }}" type="text" disabled="disabled" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ano">Ano</label>
                        <input id="ano" value="{{ $alunoSelecionado->ano }}" type="text" disabled="disabled" class="form-control">
                    </div>
                </div>

                <div class="row-fluid">
                    
                    <form action="{{ Route('lancar-nota') }}" method="POST" id="selecionarProfessorDisciplina">
                        @csrf

                        <input type="hidden" value="{{ json_encode($alunoSelecionado) }}" name="alunoSelecionado" />

                        <div class="form-group col-md-4">
                            <label for="professor">Professor</label>
                            <select class="form-control select2 select2-hidden-accessible" onchange="buscarDisciplinas(this.value, {{ $alunoSelecionado->turma_id }});" name="professor" id="professor" style="width: 100%;" tabindex="-1" aria-hidden="true" required="required">
                                <option value="">Selecione</option>
                                @foreach ($professores as $professor)
                                    <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="disciplina">Disciplina</label>
                            <select class="form-control select2 select2-hidden-accessible select-disciplina" onchange="habilitarDesabilitarBotaoSubmit(this.value)"; name="disciplina" id="disciplina" style="width: 100%;" tabindex="-1" aria-hidden="true" required="required">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-footer">
                <div class="row-fluid">
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary" type="button" id="submeterFormSelecionarProfessorDisciplina" disabled onclick="$('#selecionarProfessorDisciplina').submit();">Confirmar Seleção</button>
                    </div>
                </div>
            </div>

        </div>
    @endif

    @if (isset($alunoSelecionado) && isset($alunoSelecionado->notas))
        <div class="box box-gray">
            <div class="box-header with-border">
                <h3 class="box-title">Lançar Nota</h3>
            </div>

            <div class="box-body">

                @if (count($alunoSelecionado->notas) > 0)
                    @foreach ($alunoSelecionado->notas as $nota)
                        <form action="{{ Route('lancar-nota') }}" method="POST">
                            @csrf
            
                            <input type="hidden" value="{{ json_encode($alunoSelecionado) }}" name="alunoSelecionado" />

                            <div class="row-fluid">
                                <div class="form-group col-md-3">
                                    <label for="avaliacao">Avaliação</label>
                                    <select class="form-control select2 select2-hidden-accessible avaliacoesSelect" name="avaliacao" id="avaliacao" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">Selecione</option>
                                        <optgroup label="Normal">
                                            <option value="1ª Avaliação">1ª Avaliação</option>
                                            <option value="2ª Avaliação">2ª Avaliação</option>
                                            <option value="3ª Avaliação">3ª Avaliação</option>
                                            <option value="4ª Avaliação">4ª Avaliação</option>
                                        </optgroup>
                                        <optgroup label="Recuperação">
                                            <option value="1ª Recuperação">1ª Recuperação</option>
                                            <option value="2ª Recuperação">2ª Recuperação</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="nota">Nota</label>
                                    <select class="form-control select2 select2-hidden-accessible notasSelect" name="nota" id="nota" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">Selecione</option>
                                        @for ($i = 0.0; $i < 10.0; $i += 0.1)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="anotacoes">Anotações</label>
                                    <textarea name="anotacoes" id="anotacoes" class="form-control" rows="1">{{ $nota->anotacoes }}</textarea>
                                </div>

                                <div class="form-group col-md-2">
                                    <button class="btn btn-success" name="atualizarNota" value="{{ $nota->id }}" type="submit" style="margin-top: 25px"><i class="fa fa-refresh fw"></i></button>
                                </div>
                            </div>
                            
                            <input type="hidden" class="notas" value="{{ $nota->nota }}" />
                            <input type="hidden" class="avaliacoes" value="{{ $nota->avaliacao }}" />
                        </form>
                    @endforeach
                @endif

                <div class="row-fluid">
                    <div class="form-group col-md-12"></div>
                </div>
                
                @foreach ($alunoSelecionado->tempNotas as $tempNota)
                    <form action="{{ Route('lancar-nota') }}" method="POST">
                        @csrf
        
                        <input type="hidden" value="{{ json_encode($alunoSelecionado) }}" name="alunoSelecionado" />

                        <div class="row-fluid">
                            <div class="form-group col-md-3">
                                <label for="avaliacao">Avaliação</label>
                                <select class="form-control select2 select2-hidden-accessible tempAvaliacoesSelect" onchange="habilitarDesabilitarBotaoAdicionarNota()" name="avaliacao" id="avaliacao" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Selecione</option>
                                    <optgroup label="Normal">
                                        <option value="1ª Avaliação">1ª Avaliação</option>
                                        <option value="2ª Avaliação">2ª Avaliação</option>
                                        <option value="3ª Avaliação">3ª Avaliação</option>
                                        <option value="4ª Avaliação">4ª Avaliação</option>
                                    </optgroup>
                                    <optgroup label="Recuperação">
                                        <option value="1ª Recuperação">1ª Recuperação</option>
                                        <option value="2ª Recuperação">2ª Recuperação</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="nota">Nota</label>
                                <select class="form-control select2 select2-hidden-accessible tempNotasSelect" onchange="habilitarDesabilitarBotaoAdicionarNota()" name="nota" id="nota" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Selecione</option>
                                    @for ($i = 0.0; $i < 10.0; $i += 0.1)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="anotacoes">Anotações</label>
                                <textarea name="anotacoes" id="anotacoes" class="form-control" rows="1">{{ $tempNota->anotacoes }}</textarea>
                            </div>

                            <div class="form-group col-md-2">
                                
                                @if ($tempNota->index == end($alunoSelecionado->tempNotas)->index)
                                    <button class="btn btn-success" name="adicionarAvaliacao" id="adicionarAvaliacao" value="{{ $tempNota->index }}" disabled type="submit" style="margin-top: 25px"><i class="fa fa-save fw"></i></button>
                                @endif
                                
                                @if ($tempNota->index < end($alunoSelecionado->tempNotas)->index)
                                    <button class="btn btn-success" name="atualizarAvaliacao" value="{{ $tempNota->index }}" type="submit" style="margin-top: 25px"><i class="fa fa-refresh fw"></i></button>
                                @endif

                                <button class="btn btn-danger" name="removerAvaliacao" value="{{ $tempNota->index }}" type="submit" style="margin-top: 25px" {{ ((count($alunoSelecionado->tempNotas) == 1) ? 'disabled' : '') }}><i class="fa fa-minus fw"></i></button>
                            </div>

                            <input type="hidden" class="tempNotas" value="{{ $tempNota->nota }}" />
                            <input type="hidden" class="tempAvaliacoes" value="{{ $tempNota->avaliacao }}" />
                        </div>
                    </form>

                @endforeach
            </div>

            <div class="box-footer">
                <div class="row-fluid">
                    <div class="form-group col-md-12">

                        <form action="{{ Route('lancar-nota') }}" id="lancarNotas" method="POST">
                            @csrf
            
                            <input type="hidden" value="{{ json_encode($alunoSelecionado) }}" name="alunoSelecionado" />
                            <input type="hidden" value="true" name="lancarNotas" />
                        </form>

                        <button class="btn btn-primary" type="button" onclick="$('#lancarNotas').submit();">Salvar Alterações</button>
                        <button class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

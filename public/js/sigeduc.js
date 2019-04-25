'use strict';

var formacoes = [];
var disciplinasProfessor = [];
var alunosMatriculados = [];
var alunoResponsaveis = [];
var turmasAluno = [];
var funcionarioCargos = [];

var diarioClasse = {};

var estados = {
    'estado': ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Destrito Federal", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Roraima", "Roraima", "São Paulo", "Santa Catarina", "Sergipe", "Tocantins"],
    'uf': ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SP", "SC", "SE", "TO"]
};

var series = {
    'Ensino Fundamental': ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano', '6º Ano', '7º Ano', '8º Ano', '9º Ano'],
    'Ensino Médio': ['1º Ano', '2º Ano', '3º Ano'],
    'EJA': ['5-6', '7-8']
};

$(document).ready(function () {

    $('html').bind('keypress', function (e) {
        if (e.keyCode === 13) {
            return false;
        }
    });

    $('#canceladaEm').val(new Date());

    $('#addFormacao').bind('click', function () {
        adicionarFormacao();
    });

    $("#submeter").bind('click', function () {
        submeter();
    });

    $("#submeterFormulario").bind('click', function () {
        submeterCadastroAluno();
    });

    $("#submeterCadastroFuncionario").bind('click', function () {
        submeterCadastroFuncionario();
    });

    $(".cadastrar-turma").bind('click', function () {
        cadastrarTurma();
    });

    $(".add-disciplina").bind('click', function () {
        adicionarDisciplinasProfessor();
    });

    $("#pesquisarTurmas").bind('click', function () {
        filtrarTurmas();
    });

    $('.pesquisar-aluno').bind('click', function () {
        let _search = $('#search').val();
        pesquisarAluno(_search);
    });

    $('.pesquisar-responsavel').bind('click', function () {
        let _search = $('#searchResponsavel').val();
        pesquisarResponsavel(_search);
    });

    $('#adicionarCargo').bind('click', function () {
        adicionarCargo();
    });

    $('#salvarDadosResponsavel button').bind('click', function () {
        salvarDadosResponsavel();
    });

    $('#gerarDiarioClasse').bind('click', function () {
        gerarDiarioClasse();
    });

    $('#possuiCadastro').bind('click', function () {
        $('#formularioCadastroResponsavel').toggleClass('hidden');
        $('#tabelaSelecionarResponsavel').toggleClass('hidden');
        $('#salvarDadosResponsavel').toggleClass('hidden');
    });

    carregarTabelaFormacaoEdicao();
    carregarTabelaResponsaveisEdicao();
    carregarTabelaTurmasEdicao();
    carregarTabelaFuncionarioCargosEdicao();

    carregarUfs();

});

/*
|--------------------------------------------------------------------------
| Professor
|--------------------------------------------------------------------------
|
|
|
*/

/**
 * 
 */
var adicionarFormacao = function () {
    let _formacao = {};
    _formacao.titulo = $('#titulo').val();
    _formacao.curso = $('#curso').val();
    _formacao.instituicao = $('#instituicao').val();
    _formacao.anoInicio = $('#anoInicio').val();
    _formacao.anoTermino = $('#anoTermino').val();

    formacoes.push(_formacao);
    carregarTabelaFormacao();

    $('#titulo').val('');
    $('#curso').val('');
    $('#instituicao').val('');
    $('#anoInicio').val(2019);
    $('#anoTermino').val(2023);
};

/**
 * 
 */
var carregarTabelaFormacao = function () {
    let _table = $('#tableProfessor tbody');
    _table.empty();

    formacoes.forEach(function (formacao, i) {
        _table.append(
            "<tr>" +
                "<td>" + formacao.titulo + "</td>" +
                "<td>" + formacao.curso + "</td>" +
                "<td>" + formacao.instituicao + "</td>" +
                "<td>" + formacao.anoInicio + "</td>" +
                "<td>" + formacao.anoTermino + "</td>" +
                "<td>" +
                    "<div class='btn-group'>" +
                        "<button type='button' class='btn btn-info btn-flat btn-sm'>Editar</button>" +
                        "<button type='button' class='btn btn-info btn-flat btn-sm dropdown-toggle' data-toggle='dropdown'" +
                            "aria-expanded='false'>" +
                            "<span class='caret'></span>" +
                            "<span class='sr-only'>Toggle Dropdown</span>" +
                        "</button>" +
                        "<ul class='dropdown-menu' role='menu'>" +
                            "<li><a href='#'>Editar</a></li>" +
                            "<li><a href='#' onclick='event.preventDefault(); removerFormacao(" + i + ")'>Remover</a></li>" +
                        "</ul>" +
                    "</div>" +
                "</td>" +
            "</tr>"
        );
    });
};

/**
 * 
 */
var carregarTabelaFormacaoEdicao = function () {
    try {
        let _table = $('#tableProfessor tbody tr');
        _table.each(function () {
            let _colunas = $(this).children();
            let _formacao = {
                'titulo': $(_colunas[0]).text(),
                'curso': $(_colunas[1]).text(),
                'instituicao': $(_colunas[2]).text(),
                'anoInicio': $(_colunas[3]).text(),
                'anoTermino': $(_colunas[4]).text()
            }
            formacoes.push(_formacao);
        });
        carregarTabelaFormacao();
    } catch (error) { }
};

/**
 * 
 * @param {*} formacao 
 */
var removerFormacao = function (formacao) {
    formacoes.splice(formacao, 1);
    carregarTabelaFormacao();
};

/**
 * 
 */
var submeter = function () {
    let _formacoes = JSON.stringify(formacoes);
    $('#formacoes').val(_formacoes);
    $('.form').submit();
}

/**
 * 
 */
var carregarUfs = function () {
    let uf1 = $('.uf1');
    let uf2 = $('.uf2');
    let selected1 = (!!$('.ufHidden1').val()) ? $('.ufHidden1').val() : '';
    let selected2 = (!!$('.ufHidden2').val()) ? $('.ufHidden2').val() : '';
    estados.uf.forEach(function (e) {
        uf1.append("<option " + ((selected1 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
        uf2.append("<option " + ((selected2 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
    });
};

/*
|--------------------------------------------------------------------------
| Turma
|--------------------------------------------------------------------------
|
|
|
*/

/**
 * 
 * @param {*} modalidade 
 */
var selecionarSerie = function (modalidade) {
    let _select = $('#serie');
    _select.empty().append("<option value=''>Escolha a Série</option>");
    if (!!modalidade) {
        series[modalidade].forEach(function (e) {
            _select.append("<option value='" + e + "'>" + e + "</option>");
        });
    }
};

/**
 * 
 * @param {*} id 
 */
var buscarProfessores = function (id) {
    $.ajax({
        type: 'GET',
        url: '/professor/get/professores/' + id,
        dataType: 'json',
        success: function (response) {
            let _select = $('.select-professor');
            _select.empty();
            if (!!response) {
                try {
                    _select.append("<option selected='selected'>Selecione o Professor</option>");
                    response.forEach(function (e) {
                        _select.append("<option value='" + e.id + ' - ' + e.nome + "'>" + e.nome + "</option>");
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 * @param {*} id 
 */
var buscarDisciplinas = function (id) {
    $.ajax({
        type: 'GET',
        url: '/professor/get/disciplinas/' + id,
        dataType: 'json',
        success: function (response) {
            let _select = $('.select-disciplina');
            _select.empty();
            if (!!response) {
                try {
                    diarioClasse.idProfessor = id;
                    _select.append("<option selected='selected'>Selecione a Disciplina</option>");
                    response.forEach(function (e) {
                        _select.append("<option value='" + e.id + "'>" + e.disciplina + "</option>");
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 * @param {*} id 
 */
var buscarTurmas = function (id) {
    $.ajax({
        type: 'GET',
        url: '/professor/get/turmas/'.concat(id + '/').concat(diarioClasse.idProfessor),
        dataType: 'json',
        success: function (response) {
            let _select = $('.select-turma');
            _select.empty();
            if (!!response) {
                try {
                    diarioClasse.idDisciplina = id;
                    _select.append("<option selected='selected'>Selecione a Disciplina</option>");
                    response.forEach(function (e) {
                        _select.append("<option value='" + e.id + "'>" + e.turma + "</option>");
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 * @param {*} id 
 */
var getIdTurma = function (id) {
    diarioClasse.idTurma = id;
};

/**
 * 
 */
var gerarDiarioClasse = function () {
    if (!!diarioClasse.idProfessor && !!diarioClasse.idTurma && !!diarioClasse.idDisciplina) {
        let _table = $('#tabelaDiario tbody');
        _table.empty();
        $.ajax({
            type: 'GET',
            url: '/professor/get/professores/diario-de-classe/'
                    .concat(diarioClasse.idProfessor + '/').concat(diarioClasse.idTurma + '/').concat(diarioClasse.idDisciplina),
            dataType: 'json',
            success: function (response) {
                if (!!response) {
                    try {
                        response.forEach(function (e, i) {
                            _table.append(
                                "<tr>" +
                                    "<td>" + (i + 1) + "</td>" +
                                    "<td>" + e.matricula + "</td>" +
                                    "<td>" + e.discente + "</td>" +
                                    "<td style='width: 50%'></td>" +
                                "</tr>"
                            );
                        });
                    } catch (error) {
                        console.error(error);
                    }
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    } else {
        console.error('Erro')
    }
};

/**
 * 
 */
var adicionarDisciplinasProfessor = function () {
    try {
        let _selectDisciplina = $('.select-disciplina');
        let _selectProfessor = $('.select-professor');
        console.log(_selectProfessor.val());
        let _disciplina = {
            'idDisciplina': _selectDisciplina.val().split('-')[0].trim(),
            'disciplina': _selectDisciplina.val().split('-')[1].trim(),
            'idProfessor': _selectProfessor.val().split('-')[0].trim(),
            'professor': _selectProfessor.val().split('-')[1].trim()
        };
        
        disciplinasProfessor.push(_disciplina);
        carregarTabelaDisciplinaProfessor();

        _selectDisciplina.val('');
        _selectProfessor.empty();
        _selectProfessor.append("<option value=''>Selecione o Professor</option>");
    } catch (error) {}
}

/**
 * 
 */
var carregarTabelaDisciplinaProfessor = function () {
    let _table = $('#tabelaDisciplinaProfessor tbody');
    _table.empty();
    disciplinasProfessor.forEach(function (e, i) {
        _table.append(
            "<tr>" +
                "<td>" + e.idProfessor + "</td>" +
                "<td>" + e.professor + "</td>" +
                "<td>" + e.idDisciplina + "</td>" +
                "<td>" + e.disciplina + "</td>" +
                "<td><button type='button' onclick='removerDisciplinaProfessor(" + i + ")' class='btn btn-danger'><i class='fa fa-trash-o fw'></i></button></td>" +
            "</tr>"
        );
    });
}

/**
 * 
 * @param {*} disciplina 
 */
var removerDisciplinaProfessor = function (disciplina) {
    disciplinasProfessor.splice(disciplina, 1);
    carregarTabelaDisciplinaProfessor();
}

/**
 * 
 */
var filtrarTurmas = function () {
    let _filter = {
        'modalidade': $('#modalidade').val(),
        'turno': $('#turno').val(),
        'serie': $('#serie').val()
    };

    let _table = $('#tabelaTurmaAlunoTemp tbody');
    _table.empty();
    $.ajax({
        type: 'GET',
        url: '/turma/get/' + JSON.stringify(_filter),
        dataType: 'json',
        success: function (response) {
            if (!!response) {
                try {
                    response.forEach(function (e) {
                        _table.append(
                            "<tr>" +
                                "<td>" + e.turma + "</td>" +
                                "<td>" + e.serie + "</td>" +
                                "<td>" + e.modalidade + "</td>" +
                                "<td>" + e.turno + "</td>" +
                                "<td><button type='button' class='btn btn-success' onclick='selecionarTurma(" + JSON.stringify(e) + ")' ><i class='fa fa-check fw'></i></button></td>" +
                            "</tr>"
                        );
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 * @param {*} turma 
 * @param {*} table 
 */
var selecionarTurma = function (turma) {
    let _tableTemp = $('#tabelaTurmaAlunoTemp tbody');
    _tableTemp.empty();
    turmasAluno.push(turma);
    carregarTabelaTurmas();
};

/**
 * 
 */
var cadastrarTurma = function () {
    let _disciplinas = JSON.stringify(disciplinasProfessor);
    let _alunos = JSON.stringify(alunosMatriculados);
    $('#disciplinas').val(_disciplinas);
    $('#alunos').val(_alunos);

    $('#formCadastrarTurma').submit();
};

/**
 * 
 */
var carregarTabelaTurmas = function () {
    try {
        let _tableAluno = $('#tabelaTurmasAluno tbody');
        _tableAluno.empty();
        turmasAluno.forEach(function (e) {
            _tableAluno.append(
                "<tr>" +
                    "<td>" + e.turma + "</td>" +
                    "<td>" + e.serie + "</td>" +
                    "<td>" + e.modalidade + "</td>" +
                    "<td>" + e.turno + "</td>" +
                    "<td>" + ((!!e.ano) ? e.ano : new Date().getFullYear()) + "</td>" +
                    "<td>" + ((!!e.repetente) ? 'Sim' : 'Não') + "</td>" +
                    "<td><button type='button' class='btn btn-danger'><i class='fa fa-trash-o fw'></i></button></td>" +
                "</tr>"
            );
        });
    } catch (error) {
        console.error(error);
    }
};

/**
 * 
 */
var carregarTabelaTurmasEdicao = function () {
    try {
        let _table = $('#tabelaTurmasAluno tbody tr');
        _table.each(function () {
            let _colunas = $(this).children();
            let _turma = {
                'turma': $(_colunas[0]).text(),
                'serie': $(_colunas[1]).text(),
                'modalidade': $(_colunas[2]).text(),
                'turno': $(_colunas[3]).text(),
                'ano': parseInt($(_colunas[4]).text()),
                'repetente': parseInt($(_colunas[5]).text()),
                'id': parseInt($(_colunas[6]).text())
            };
            turmasAluno.push(_turma);
        });
        carregarTabelaTurmas();
    } catch (error) {
        console.error(error);
     }
};

/*
|--------------------------------------------------------------------------
| Aluno
|--------------------------------------------------------------------------
|
|
|
*/

/**
 * 
 */
var pesquisarAluno = function (search) {
    let _table = $('#tabelaAluno tbody');
    _table.empty();
    $.ajax({
        type: 'GET',
        url: '/aluno/get/' + search,
        dataType: 'json',
        success: function (response) {
            if (!!response) {
                try {
                    response.forEach(function (e, i) {
                        _table.append(
                            "<tr>" +
                                "<td>" + e.matricula + "</td>" +
                                "<td>" + e.nome + "</td>" +
                                "<td>" + e.cpf + "</td>" +
                                "<td><button type='button' onclick='adicionarAlunoTurma(" + JSON.stringify(e) + ")' class='btn btn-success'><i class='fa fa-check-square-o fw'></i></button></td>" +
                            "</tr>"
                        );
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 */
var pesquisarResponsavel = function (search) {
    let _table = $('#tabelaResponsavel tbody');
    _table.empty();
    $.ajax({
        type: 'GET',
        url: '/aluno/get/responsaveis/' + search,
        dataType: 'json',
        success: function (response) {
            if (!!response) {
                try {
                    response.forEach(function (e, i) {
                        _table.append(
                            "<tr>" +
                                "<td>" + e.nome + "</td>" +
                                "<td>" + e.cpf + "</td>" +
                                "<td><input type='text' class='form-control' /></td>" +
                                "<td><div class='checkbox'><label><input type='checkbox' /> Outro Filho na Escola</label></div></td>" +
                                "<td><div class='checkbox'><label><input type='checkbox' /> Mora com o Filho</label></div></td>" +
                                "<td><button type='button' onclick='adicionarAlunoResponsavel(" + JSON.stringify(e) + ", " + i + ")' class='btn btn-success'><i class='fa fa-check-square-o fw'></i></button></td>" +
                            "</tr>"
                        );
                    });
                } catch (error) {
                    console.error(error);
                }
            }
        },
        error: function (error) {
            console.error(error);
        }
    });
};

/**
 * 
 * @param {*} responsavel 
 * @param {*} i 
 */
var adicionarAlunoResponsavel = function (responsavel, i) {
    let _table = $('#tabelaResponsavel tbody tr');
    let _tr = _table[i];
    let _td = $(_tr).children();

    let _responsavel = {
        'responsavel': responsavel,
        'alunoHasResponsavel': {
            'parentesco': $(_td[2]).find('input').val(),
            'outroFilhoEscola': $(_td[3]).find('input').is(':checked'),
            'moraComFilho': $(_td[4]).find('input').is(':checked')
        }
    };

    alunoResponsaveis.push(_responsavel);
    carregarTabelaAlunoResponsaveis();
    _table.empty();
    $('#searchResponsavel').val(null);
};

/**
 * 
 */
var salvarDadosResponsavel = function () {
    try {
        let _responsavel = {
            'responsavel': {
                'id': null,
                'nome': $('#nomeResponsavel').val(),
                'nascimento': $('#nascimentoResponsavel').val(),
                'nacionalidade': $('#nacionalidadeResponsavel').val(),
                'naturalidade': $('#naturalidadeResponsavel').val(),
                'ufNaturalidade': $('#ufNaturalidadeResponsavel').val(),
                'cpf': $('#cpfResponsavel').val(),
                'rua': $('#ruaResponsavel').val(),
                'complemento': $('#complementoResponsavel').val(),
                'bairro': $('#bairroResponsavel').val(),
                'cidade': $('#cidadeResponsavel').val(),
                'uf': $('#ufResponsavel').val(),
                'cep': $('#cepResponsavel').val(),
                'telefone': $('#telefoneResponsavel').val(),
                'celular': $('#celularResponsavel').val(),
                'email': $('#emailResponsavel').val(),
                'sexo': $("#sexoResponsavel:checked").val()
            },
            'alunoHasResponsavel': {
                'parentesco': $('#parentesco').val(),
                'outroFilhoEscola': $('#outroFilhoNaEscola').is(':checked'),
                'moraComFilho': $('#moraComOFilho').is(':checked')
            }
        };
        
        $('input:checkbox').prop('checked', false);
        $('input:radio').prop('checked', false);
        $("#sexoResponsavel").prop('checked', true);
        $('#nomeResponsavel').val('');
        $('#nascimentoResponsavel').val('');
        $('#nacionalidadeResponsavel').val('');
        $('#naturalidadeResponsavel').val('');
        $('#ufNaturalidadeResponsavel').val('');
        $('#cpfResponsavel').val('');
        $('#ruaResponsavel').val('');
        $('#complementoResponsavel').val('');
        $('#bairroResponsavel').val('');
        $('#cidadeResponsavel').val('');
        $('#ufResponsavel').val('');
        $('#cepResponsavel').val('');
        $('#telefoneResponsavel').val('');
        $('#celularResponsavel').val('');
        $('#emailResponsavel').val('');
        $('#parentesco').val('');

        alunoResponsaveis.push(_responsavel);
        carregarTabelaAlunoResponsaveis();
    } catch (error) {
        console.error(error);
    }
};

/**
 * 
 */
var carregarTabelaAlunoResponsaveis = function () {
    try {
        if (!!alunoResponsaveis) {
            let _table = $('#tabelaResponsaveisAluno tbody');
            _table.empty();
            alunoResponsaveis.forEach(function (e) {
                _table.append(
                    "<tr>" +
                        "<td>" + e.responsavel.nome + "</td>" +
                        "<td>" + e.alunoHasResponsavel.parentesco + "</td>" +
                        "<td>" + e.responsavel.telefone + "</td>" +
                        "<td>" + e.responsavel.celular + "</td>" +
                        "<td>" + e.responsavel.email + "</td>" +
                        "<td>" + ((!!e.alunoHasResponsavel.moraComFilho) ? 'Sim' : 'Não') + "</td>" +
                        "<td><button type='button' class='btn btn-primary'><i class='fa fa-edit fw'></i></button></td>" +
                    "</tr>"
                );
            });
        }
    } catch (error) {
        console.error(error);
    }
};


/**
 * 
 */
var carregarTabelaResponsaveisEdicao = function () {
    try {
        let _table = $('#tabelaResponsaveisAluno tbody tr');
        _table.each(function () {
            let _colunas = $(this).children();
            let _responsavel = {
                'responsavel': {
                    'nome': $(_colunas[0]).text(),
                    'telefone': $(_colunas[2]).text(),
                    'celular': $(_colunas[3]).text(),
                    'email': $(_colunas[4]).text(),
                    'id': $(_colunas[6]).text()
                },
                'alunoHasResponsavel': {
                    'parentesco': $(_colunas[1]).text(),
                    'moraComFilho': $(_colunas[5]).text()
                }
            }
            alunoResponsaveis.push(_responsavel);
        });
        carregarTabelaAlunoResponsaveis();
    } catch (error) { }
};

/**
 * 
 * @param {*} obj 
 */
var copiarEnderecoAlunoParaResponsavel = function (obj) {
    if (obj.checked) {
        $('#ruaResponsavel').val($('#rua').val());
        $('#complementoResponsavel').val($('#complemento').val());
        $('#bairroResponsavel').val($('#bairro').val());
        $('#cidadeResponsavel').val($('#cidade').val());
        $('#ufResponsavel').val($('#uf').val());
        $('#cepResponsavel').val($('#cep').val());
    } else {
        $('#ruaResponsavel').val('');
        $('#complementoResponsavel').val('');
        $('#bairroResponsavel').val('');
        $('#cidadeResponsavel').val('');
        $('#ufResponsavel').val('');
        $('#cepResponsavel').val('');
    }
};

/**
 * 
 * @param {*} aluno 
 */
var adicionarAlunoTurma = function (aluno) {
    alunosMatriculados.push(aluno);
    let _table = $('#tabelaAlunosMatriculados tbody');
    _table.empty();

    try {
        if (!!alunosMatriculados) {
            alunosMatriculados.forEach(function (e) {
                _table.append(
                    "<tr>" +
                        "<td>" + e.matricula + "</td>" +
                        "<td>" + e.nome + "</td>" +
                        "<td>" + e.cpf + "</td>" +
                        "<td>" + e.telefone + "</td>" +
                        "<td>" + e.celular + "</td>" +
                        "<td>" + e.email + "</td>" +
                        "<td><button type='button' class='btn btn-danger'><i class='fa fa-trash-o fw'></i></button></td>" +
                    "</tr>"
                );
            });
        }
        $('#tabelaAluno tbody').empty();
        $('#search').val('');
    } catch (error) {
        console.error(error);
    }
};

/**
 * 
 */
var submeterCadastroAluno = function () {
    let _responsaveis = JSON.stringify(alunoResponsaveis);
    let _turmas = JSON.stringify(turmasAluno);

    $('#responsaveisAluno').val(_responsaveis);
    $('#turmasAluno').val(_turmas);
    $('.formCadastroAluno').submit();
};

/*
|--------------------------------------------------------------------------
| Funcionário
|--------------------------------------------------------------------------
|
|
|
*/

/**
 * 
 */
var adicionarCargo = function () {
    try {
        let _cargo = {
            'id': parseInt($('#cargo').val()),
            'cargo': $('#cargo').val().split('-')[1].trim(),
            'cargaHoraria': $('#cargaHoraria').val(),
            'cargoAtual': $('#cargoAtual').is(':checked'),
            'dataAdmissao': '',
            'dataDemissao': ''
        };
        funcionarioCargos.push(_cargo);
        carregarTabelaFuncionarioCargos();
        $('#cargoAtual').prop('checked', false);
        $('#cargaHoraria').val(null);
    } catch (error) {
        console.error(error);
    }

};

var carregarTabelaFuncionarioCargos = function () {
    let _table = $('#tabelaFuncionario tbody');
    _table.empty();
    if (!!funcionarioCargos) {
        funcionarioCargos.forEach(function (e) {
            _table.append(
                "<tr>" +
                    "<td>" + e.cargo + "</td>" +
                    "<td>" + e.cargaHoraria + "</td>" +
                    "<td>" + e.dataAdmissao + "</td>" +
                    "<td>" + e.dataDemissao + "</td>" +
                    "<td>" + ((!!e.cargoAtual) ? 'Sim' : 'Não') + "</td>" +
                    "<td><button type='button' class='btn btn-danger'><i class='fa fa-trash-o fw'></i></button></td>" +
                "</tr>"
            );
        });
    }
};


/**
 * 
 */
var carregarTabelaFuncionarioCargosEdicao = function () {
    try {
        let _table = $('#tabelaFuncionario tbody tr');
        _table.each(function () {
            let _colunas = $(this).children();
            let _cargoFuncionario = {
                'cargo': $(_colunas[0]).text(),
                'cargaHoraria': $(_colunas[1]).text(),
                'dataAdmissao': $(_colunas[2]).text(),
                'cargoAtual': (!!$(_colunas[4]).text()) ? 'Sim' : 'Não',
                'dataDemissao': '',
                'id': $(_colunas[6]).text()
            }
            funcionarioCargos.push(_cargoFuncionario);
        });
        carregarTabelaFuncionarioCargos();
    } catch (error) { }
};

/**
 * 
 */
var submeterCadastroFuncionario = function () {
    let _cargos = JSON.stringify(funcionarioCargos);
    $('#funcionarioCargos').val(_cargos);
    $('#formCadastroFuncionario').submit();
};
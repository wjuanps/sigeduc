'use strict';

var formacoes = [];
var disciplinasProfessor = [];
var alunosMatriculados = [];
var turmasAluno = [];

var diarioClasse = {};

var series = {
    'Ensino Fundamental': ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano', '6º Ano', '7º Ano', '8º Ano', '9º Ano'],
    'Ensino Médio': ['1º Ano', '2º Ano', '3º Ano'],
    'EJA': ['5-6', '7-8']
};

$(document).ready(function () {

    $('#canceladaEm').val(new Date());

    $('#addFormacao').bind('click', function () {
        adicionarFormacao();
    });

    $("#submeterCadastroProfessor").bind('click', function () {
        submeterCadastroProfessor();
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

    $('#gerarDiarioClasse').bind('click', function () {
        gerarDiarioClasse();
    });

    carregarTabelaFormacaoEdicao();
    carregarTabelaTurmasEdicao();

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
var submeterCadastroProfessor = function () {
    let _formacoes = JSON.stringify(formacoes);
    $('#formacoes').val(_formacoes);
    $('.form').submit();
}

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
        url: '/turma/get/turmas/'.concat(id + '/').concat(diarioClasse.idProfessor),
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
                            $('#diarioTurma').text(e.turma.concat(' - (').concat(response.length).concat(' alunos)'));
                            $('#diarioModalidade').text(e.modalidade);
                            $('#diarioDocente').text(e.docente);
                            $('#diarioDisciplina').text(e.disciplina);
                            _table.append(
                                "<tr>" +
                                    "<td>" + (i + 1) + "</td>" +
                                    "<td>" + e.matricula + "</td>" +
                                    "<td>" + e.discente + "</td>" +
                                    "<td style='width: 60%'></td>" +
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
        url: '/turma/get/turmas/' + JSON.stringify(_filter),
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
                                "<td>" +
                                    "<button type='button' class='btn btn-success' onclick='selecionarTurma(" + JSON.stringify(e) + ")' >" + 
                                        "<i class='fa fa-check fw'></i>" + 
                                    "</button>" + 
                                "</td>" +
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
    let _professores = JSON.stringify(disciplinasProfessor);
    let _alunos = JSON.stringify(alunosMatriculados);
    $('#professores').val(_professores);
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

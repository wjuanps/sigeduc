'use strict';

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

    $(".cadastrar-turma").bind('click', function () {
        cadastrarTurma();
    });

    $('#submeterFormulario').bind('click', function () {
        atualizarTurmasAluno();
    });

    $('#modalidade').bind('change', function () {
        selecionarSerie($(this).val());
    });

    $('#serie').bind('change', function () {
        let _modalidade = $('#modalidade').val();
        let _turno = $('#turno').val();
        nomeTurma(_modalidade, $(this).val(), _turno);
    });

    $('#turno').bind('change', function () {
        let _modalidade = $('#modalidade').val();
        let _serie = $('#serie').val();
        nomeTurma(_modalidade, _serie, $(this).val());
    });

});

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
 * @param {*} serie 
 * @param {*} turno 
 * 
 * @returns void
 */
var nomeTurma = function (modalidade, serie, turno) {
    let _nomeTurma = $('#turma').val().substring(0, 4);
    if (!!turno && !!serie && !!modalidade) {
        if (modalidade !== 'EJA') {
            let _modalidade = modalidade.split(' ');
            _modalidade = _modalidade.map(function (e) {
                return e.substring(0, 1);
            });
            modalidade = _modalidade.join('');
        }

        serie = (modalidade === "EJA") ? serie.split('-').join('') : serie.substring(0, 1);
        turno = turno.substring(0, 1);

        _nomeTurma = _nomeTurma.concat(modalidade).concat(turno).concat(serie);

        $.ajax({
            type: 'GET',
            url: '/turma/get/nome-turma/' + _nomeTurma,
            dataType: 'json',
            success: function (response) {
                if (!!response) {
                    try {
                        $('#turma').val(response.nomeTurma);
                        $('#turmaHidden').val(response.nomeTurma);
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
        $('#turma').val(_nomeTurma);
        $('#turmaHidden').val(_nomeTurma);
    }
}

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
                    _select.append("<option value=''>Selecione o Professor</option>");
                    response.forEach(function (e) {
                        _select.append("<option value='" + e.id + "'>" + e.nome + "</option>");
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
                        _select.append("<option value='" + e.id + "'>" + e.nome_turma + "</option>");
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
                    "<td>" + e.nome_turma + "</td>" +
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
var atualizarTurmasAluno = function () {
    $('#formAtualizarTurmasAluno').submit();
};

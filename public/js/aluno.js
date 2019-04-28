'use strict';

var alunosMatriculados = [];
var alunoResponsaveis = [];
var turmasAluno = [];

$(document).ready(function () {

    $("#submeterFormulario").bind('click', function () {
        submeterCadastroAluno();
    });

    $('.pesquisar-aluno').bind('click', function () {
        let _search = $('#search').val();
        pesquisarAluno(_search);
    });

    $('.pesquisar-responsavel').bind('click', function () {
        let _search = $('#searchResponsavel').val();
        pesquisarResponsavel(_search);
    });

    $('#salvarDadosResponsavel button').bind('click', function () {
        salvarDadosResponsavel();
    });

    $('#possuiCadastro').bind('click', function () {
        $('#formularioCadastroResponsavel').toggleClass('hidden');
        $('#tabelaSelecionarResponsavel').toggleClass('hidden');
        $('#salvarDadosResponsavel').toggleClass('hidden');
    });

    carregarTabelaTurmasEdicao();

});

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
                                "<td>" + 
                                    "<button type='button' onclick='adicionarAlunoResponsavel(" + JSON.stringify(e) + ", " + i + ")' class='btn btn-success'>" + 
                                        "<i class='fa fa-check-square-o fw'></i>" + 
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
 * @param {*} responsavel 
 * @param {*} i 
 */
var adicionarAlunoResponsavel = function (responsavel, i) {
    console.log(responsavel);
    let _table = $('#tabelaResponsavel tbody tr');
    let _tr = _table[i];
    let _td = $(_tr).children();

    let _responsavel = {
        'responsavel': responsavel,
        'alunoHasResponsavel': {
            'parentesco': $(_td[2]).find('input').val(),
            'outro_filho_na_escola': $(_td[3]).find('input').is(':checked'),
            'mora_com_filho': $(_td[4]).find('input').is(':checked')
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
                'data_nascimento': $('#nascimentoResponsavel').val(),
                'nacionalidade': $('#nacionalidadeResponsavel').val(),
                'naturalidade': $('#naturalidadeResponsavel').val(),
                'naturalidade_uf': $('#ufNaturalidadeResponsavel').val(),
                'rg': $('#identidadeResponsavel').val(),
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
                'sexo': $("#sexoResponsavel:checked").val(),
                'foto': ''
            },
            'alunoHasResponsavel': {
                'parentesco': $('#parentesco').val(),
                'outro_filho_na_escola': $('#outroFilhoNaEscola').is(':checked'),
                'mora_com_filho': $('#moraComOFilho').is(':checked')
            }
        };
        
        $('#moraComOFilho').prop('checked', false);
        $('#outroFilhoNaEscola').prop('checked', false);
        $("#sexoResponsavel").prop('checked', true);
        $('#nomeResponsavel').val('');
        $('#nascimentoResponsavel').val('');
        $('#nacionalidadeResponsavel').val('');
        $('#naturalidadeResponsavel').val('');
        $('#ufNaturalidadeResponsavel').val('');
        $('#identidadeResponsavel').val('');
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
                        "<td>" + ((e.alunoHasResponsavel.mora_com_filho) ? 'Sim' : 'Não') + "</td>" +
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
                    'mora_com_filho': $(_colunas[5]).text()
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

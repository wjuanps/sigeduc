'use strict';

var formacoes = [];

$(document).ready(function () {

    $('#addFormacao').bind('click', function () {
        adicionarFormacao();
    });

    $("#submeterCadastroProfessor").bind('click', function () {
        submeterCadastroProfessor();
    });

    carregarTabelaFormacaoEdicao();

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

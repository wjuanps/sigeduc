'use strict';

var funcionarioCargos = [];

$(document).ready(function () {

    $("#submeterCadastroFuncionario").bind('click', function () {
        submeterCadastroFuncionario();
    });

    $('#adicionarCargo').bind('click', function () {
        adicionarCargo();
    });

    carregarTabelaFuncionarioCargosEdicao();

});

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
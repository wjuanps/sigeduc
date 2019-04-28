'use strict';

var estados = {
    'estado': ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Destrito Federal", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Roraima", "Roraima", "São Paulo", "Santa Catarina", "Sergipe", "Tocantins"],
    'uf': ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SP", "SC", "SE", "TO"]
};

$(document).ready(function () {

    $('html').bind('keypress', function (e) {
        if (e.keyCode === 13) {
            return false;
        }
    });

    // Initialize Select2 Elements
    $(".select2").select2();

    // Initialize Masks
    $('.mask-data').inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/aaaa"});
    $('.mask-telefone').inputmask("(99) 9 9999-9999", {"placeholder": "(__) _ ____-____"});
    $('.mask-identidade').inputmask("999999-9", {"placeholder": "______-_"});
    $('.mask-cpf').inputmask("999.999.999.99", {"placeholder": "___.___.___-__"});
    $('.mask-cep').inputmask("99999-999", {"placeholder": "_____-___"});

    // Initialize datatables
    $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "Mostrando página _PAGE_ de _PAGES_ - total de registros _MAX_",
            "infoEmpty": "Não existem dados para essa busca",
            "infoFiltered": "(filtrado a partir de _MAX_ registros totais)",
            "search": "Procurar",
            "next": "Próximo",
            "previous": "Anterior"
        }
    });

    carregarUfs();

});

/**
 * 
 */
var carregarUfs = function () {
    let uf1 = $('.uf1');
    let uf2 = $('.uf2');
    let uf3 = $('.uf3');
    let uf4 = $('.uf4');
    let selected1 = (!!$('.ufHidden1').val()) ? $('.ufHidden1').val() : '';
    let selected2 = (!!$('.ufHidden2').val()) ? $('.ufHidden2').val() : '';
    let selected3 = (!!$('.ufHidden3').val()) ? $('.ufHidden3').val() : '';
    let selected4 = (!!$('.ufHidden4').val()) ? $('.ufHidden4').val() : '';
    estados.uf.forEach(function (e) {
        uf1.append("<option " + ((selected1 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
        uf2.append("<option " + ((selected2 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
        uf3.append("<option " + ((selected3 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
        uf4.append("<option " + ((selected4 === e) ? 'selected' : '') + " value='" + e + "'>" + e + "</option>");
    });
};

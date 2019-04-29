'use strict';

var estados = [
    [
        "Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Destrito Federal", "Espirito Santo", "Goiás", 
        "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", 
        "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Roraima", "Santa Catarina", "São Paulo", "Sergipe", "Tocantins"
    ], [
        "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", 
        "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", 
        "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO"
    ]
];

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
    $('.mask-cpf').inputmask("999.999.999-99", {"placeholder": "___.___.___-__"});
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
    let _uf1 = $('.uf1');
    let _uf2 = $('.uf2');
    let _uf3 = $('.uf3');
    let _uf4 = $('.uf4');
    let _selected1 = (!!$('.ufHidden1').val()) ? $('.ufHidden1').val() : '';
    let _selected2 = (!!$('.ufHidden2').val()) ? $('.ufHidden2').val() : '';
    for (let i = 0; i < estados[0].length; i++) {            
        _uf1.append("<option " + ((_selected1 === estados[1][i]) ? 'selected' : '') + " value='" + estados[1][i] + "'>" + estados[0][i] + "</option>");
        _uf2.append("<option " + ((_selected2 === estados[1][i]) ? 'selected' : '') + " value='" + estados[1][i] + "'>" + estados[0][i] + "</option>");
        _uf3.append("<option value='" + estados[1][i] + "'>" + estados[0][i] + "</option>");
        _uf4.append("<option value='" + estados[1][i] + "'>" + estados[0][i] + "</option>");
    }
};

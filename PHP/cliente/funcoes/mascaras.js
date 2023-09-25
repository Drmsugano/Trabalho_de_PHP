$(document).ready(function () {
    $("#telefone").mask("(00)00000-0000");
    $("#cep").mask("00.000-000");
    $('#cpfcnpj').mask('000.000.000-00', {
        onKeyPress: function (cpfcnpj, e, field, options) {
            const masks = ['000.000.000-000', '00.000.000/0000-00'];
            const mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('#cpfcnpj').mask(mask, options);
        }
    });
});


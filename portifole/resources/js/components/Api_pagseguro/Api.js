var price = 500.00;
var n_bandeira = 'visa';
var numero = '4111111111111111';
var cvv = '013';
var mes = '12';
var ano = '2026';

function id() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var id = JSON.parse(this.response);
            document.getElementById("id_boleto").value = id.id;
            document.getElementById("id_creditCard").value = id.id;
            PagSeguroDirectPayment.setSessionId(id.id);
            id_comprador();
            meios_pagamentos();
            credit_token();
        }
    };
    xhttp.open("GET", "id");
    xhttp.send();
}
function meios_pagamentos() {
    PagSeguroDirectPayment.getPaymentMethods({
        amount: price,
        success: function (response) {
            var img_boleto = response.paymentMethods.BOLETO.options.BOLETO.images.SMALL.path
            document.getElementById('meios_pagamentos').innerHTML += "<img src=" + 'https://stc.pagseguro.uol.com.br/' + img_boleto + ">";

            var credit = response.paymentMethods.CREDIT_CARD.options;
            var array_credit = Object.values(credit);
            for (let i = 0; i < array_credit.length; i++) {
                var img_card = array_credit[i].images.SMALL.path;
                document.getElementById('meios_pagamentos').innerHTML += "<img src=" + 'https://stc.pagseguro.uol.com.br/' + img_card + ">";
            }
            bandeira();
        }
    });
}
function bandeira() {
    document.getElementById('n_card').onkeyup = function () {
        var n_card = document.getElementById('n_card').value;
        if (n_card.length == 6 || n_card.length > 6) {
            PagSeguroDirectPayment.getBrand({
                cardBin: n_card,
                success: function (response) {
                    var nome = response.brand.name
                    document.getElementById('bandeira').innerHTML = "<img src=" + 'https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/' + nome + '.png' + ">";
                    parcela();
                }
            });
        } else {
            document.getElementById('bandeira').innerHTML = '';
        }
    }
}
function parcela() {
    PagSeguroDirectPayment.getInstallments({

        amount: price,
        maxInstallmentNoInterest: 2,
        brand: n_bandeira,

        success: function (response) {
            var parcelas = Object.values(response.installments)[0]
            document.getElementById('parcelas').innerHTML = ''
            document.getElementById('parcelas').innerHTML = '<option>parcelas</option>'
            var ii = 1
            for (let i = 0; i < parcelas.length; i++) {
                document.getElementById('parcelas').innerHTML += "<option value=" + ii + ">" + 'parcelas: ' + parcelas[i].quantity + "</option>"
                // console.log(ii);
                document.getElementById('parcelas').onclick = function () {
                    var qtd = document.getElementById('parcelas').value;
                    var id = JSON.parse(qtd);
                    id -= 1
                    // console.log(id-=1);
                    document.getElementById('v_parcela').value = parcelas[id].installmentAmount;
                    document.getElementById('t_parcela').value = parcelas[id].totalAmount;
                }
                ii++
            }
        }
    });
}
function credit_token() {
    PagSeguroDirectPayment.createCardToken({

        cardNumber: numero, // Número do cartão de crédito
        brand: n_bandeira, // Bandeira do cartão
        cvv: cvv, // CVV do cartão
        expirationMonth: mes, // Mês da expiração do cartão
        expirationYear: ano, // Ano da expiração do cartão, é necessário os 4 dígitos.

        success: function (response) {
            var id_card = response.card.token;
            document.getElementById('id_card').value = id_card;
        }
    });
}
function id_comprador() {
    PagSeguroDirectPayment.onSenderHashReady(function (response) {
        if (response.status == 'error') {
            console.log(response.message);
            return false;
        }
        document.getElementById('id_comprador_boleto').value = response.senderHash;
        document.getElementById('id_comprador_creditCard').value = response.senderHash;
    });
}
console.clear();
export default id();
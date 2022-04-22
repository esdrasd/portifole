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
        }
    };
    xhttp.open("GET", "id");
    xhttp.send();
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
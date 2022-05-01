<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_produtos;
use App\Models\model_crud;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class controller_ecommerci extends Controller
{
    function add(Request $req)
    {
        $x = $req->file('img');
        foreach ($x as $v) {
            $img[] = $v->store('fotos', 'public');
        };
        $model = new model_produtos;
        $model->nome = $req->nome;
        $model->price = $req->price;
        $model->img = json_encode($img);
        $model->save();
        return redirect()->route('index');
    }
    function show()
    {
        return $model = model_produtos::all();
    }
    function id()
    {
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=esdrassousa76@gmail.com&token=13ACCD9BA759496B98B87DD7AD13DBD3";
        $id = Http::post($url);
        return json_encode(simplexml_load_string($id));
    }
    function boleto(Request $req)
    {
        $comprador = [];
        $config = [];
        $prod = [];
        $shipping = [];
        $key = 0;

        $config['email'] = "esdrassousa76@gmail.com";
        $config['token'] = "13ACCD9BA759496B98B87DD7AD13DBD3";
        $config['paymentMode'] = 'default';
        $config['paymentMethod'] = 'boleto';
        $config['receiverEmail'] = 'esdrassousa76@gmail.com';
        $config['currency'] = 'BRL';
        $config['notificationURL'] = 'https://sualoja.com.br/notifica.html';
        $config['reference'] = 'REF1234';

        $comprador['senderHash'] = $req->id_comprador_boleto;
        $comprador['senderName'] = "Jose Comprador";
        $comprador['senderCPF'] = "72962940005";
        $comprador['senderAreaCode'] = "11";
        $comprador['senderPhone'] = "56273440";
        $comprador['senderEmail'] = "comprador@uol.com.br";

        foreach (json_decode($req->produto) as $i) {
            $key++;

            $prod['itemId' . $key] = $key;
            $prod['itemDescription' . $key] = $i->nome;
            $prod['itemAmount' . $key] = number_format($i->price, 2, '.', '');
            $prod['itemQuantity' . $key] = '1';
        }


        $shipping['shippingAddressRequired'] = "true";
        $shipping['shippingAddressStreet'] = "Av. Brig. Faria Lima";
        $shipping['shippingAddressNumber'] = "1384";
        $shipping['shippingAddressComplement'] = "5o andar";
        $shipping['shippingAddressDistrict'] = "Jardim Paulistano";
        $shipping['shippingAddressPostalCode'] = "01452002";
        $shipping['shippingAddressCity'] = "Sao Paulo";
        $shipping['shippingAddressState'] = "SP";
        $shipping['shippingAddressCountry'] = "BRA";

        $array = $config + $comprador + $prod + $shipping;
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=esdrassousa76@gmail.com&token=13ACCD9BA759496B98B87DD7AD13DBD3";
        $id = Http::asForm()->post($url, $array);
        $xml = simplexml_load_string($id);
        return redirect($xml->paymentLink);
    }
    function credito(Request $req)
    {
        $config = [];
        $comprador = [];
        $prod = [];
        $shipping = [];
        $credit = [];
        $billing = [];
        $install = [];

        $key = 0;

        $config['email'] = "esdrassousa76@gmail.com";
        $config['token'] = "13ACCD9BA759496B98B87DD7AD13DBD3";
        $config['paymentMode'] = 'default';
        $config['paymentMethod'] = 'creditCard';
        $config['receiverEmail'] = 'esdrassousa76@gmail.com'; // vendendor recebe email
        $config['currency'] = 'BRL';
        $config['notificationURL'] = 'https://sualoja.com.br/notifica.html';
        $config['reference'] = 'REF1234';
        $config['noInterestInstallmentQuantity'] = '2';

        foreach (json_decode($req->produto) as $i) {
            $key++;
            $prod['itemId' . $key] = $key;
            $prod['itemDescription' . $key] = $i->nome;
            $prod['itemAmount' . $key] = number_format($i->price, 2, '.', '');
            $prod['itemQuantity' . $key] = '1';
        }

        $comprador['senderHash'] = $req->id_comprador_creditCard;
        $comprador['senderName'] = "Jose Comprador";
        $comprador['senderCPF'] = "72962940005";
        $comprador['senderAreaCode'] = "11";
        $comprador['senderPhone'] = "56273440";
        $comprador['senderEmail'] = "esd@esd"; //cliente

        $shipping['shippingAddressRequired'] = "true";
        $shipping['shippingAddressStreet'] = "Av. Brig. Faria Lima";
        $shipping['shippingAddressNumber'] = "1384";
        $shipping['shippingAddressComplement'] = "5o andar";
        $shipping['shippingAddressDistrict'] = "Jardim Paulistano";
        $shipping['shippingAddressPostalCode'] = "01452002";
        $shipping['shippingAddressCity'] = "Sao Paulo";
        $shipping['shippingAddressState'] = "SP";
        $shipping['shippingAddressCountry'] = "BRA";
        $shipping['shippingType'] = "1";
        $shipping['shippingCost'] = "0.00";

        $credit['creditCardToken'] =  $req->id_card;
        $credit['creditCardHolderName'] = "Jose Comprador";
        $credit['creditCardHolderCPF'] = "22111944785";
        $credit['creditCardHolderBirthDate'] = "27/10/1987";
        $credit['creditCardHolderAreaCode'] = "11";
        $credit['creditCardHolderPhone'] = "56273440";

        $billing['billingAddressStreet'] = "Av. Brig. Faria Lima";
        $billing['billingAddressNumber'] = "1384";
        $billing['billingAddressComplement'] = "5o andar";
        $billing['billingAddressDistrict'] = "Jardim Paulistano";
        $billing['billingAddressPostalCode'] = "01452002";
        $billing['billingAddressCity'] = "Sao Paulo";
        $billing['billingAddressState'] = "SP";
        $billing['billingAddressCountry'] = "BRA";

        $install['installmentQuantity'] = $req->parcelas;
        $install['installmentValue'] = number_format($req->v_parcela, 2, '.', '');

        $array = $config + $comprador + $prod + $shipping + $credit + $billing + $install;
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=esdrassousa76@gmail.com&token=13ACCD9BA759496B98B87DD7AD13DBD3";
        $id = Http::asForm()->post($url, $array);
        return $json = json_encode(simplexml_load_string($id));
    }
    function registrar_cadastrar(Request $req)
    {
        $model = new model_crud;
        $model->nome = $req->nome;
        $model->cpf = $req->cpf;
        $model->ddd = $req->ddd;
        $model->telefone = $req->telefone;
        $model->email = $req->email;
        $model->enderecoNome = $req->enderecoNome;
        $model->enderecoNumero = $req->enderecoNumero;
        $model->complemento = $req->complemento;
        $model->bairro = $req->bairro;
        $model->cep = $req->cep;
        $model->cidade = $req->cidade;
        $model->estado = $req->estado;
        $model->pais = $req->pais;
        $model->dataNascimento = $req->dataNascimento;
        $model->areaCode = $req->areaCode;
        $model->senha = $pass = Hash::make($req->senha);
        $model->save();
        return redirect()->route('index');
    }
    function login(Request $req)
    {
        $user = DB::table('model_cruds')->where('email', $req->email)->first();
        if (Hash::check($req->senha, $user->senha)) {
            session(['key' => 1, 'nome' => $user->nome]);
            return redirect()->route("index");
        }
        return redirect()->route("index");
    }
    function login_sair(){
        session()->flush();
        session(['key' => 0, 'nome' => ""]);
        return redirect()->route("index");
    }
    function session_hash()
    {

        // $user = DB::table('model_cruds')->where('email', 'comprador@uol.com.br')->first();
        // return $user;

        // session add
        // echo session(['key' => 0]);
        // echo session()->put('status', 1);

        // session get
        // echo session()->get('status');

        // session del
        // echo session()->pull('');
        // echo session()->flush();

        // session return 
        return session()->all();


        // $y = 'oii'; $x = 'oi';
        // $pass = Hash::make($x);
        // if (Hash::check($y, $pass)) {
        //     return "true";
        // } else {
        //     return "false";
        // }
    }
}

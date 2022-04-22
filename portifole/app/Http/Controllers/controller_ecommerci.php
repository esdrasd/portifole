<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_produtos;
use Illuminate\Support\Facades\Http;

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
}

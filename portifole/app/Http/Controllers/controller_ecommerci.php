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
    function index()
    {
        if (!session()->has('key')) {
            session()->flush();
            session(['key' => 0, 'nome' => '']);
            return view('welcome');
        }
        if (session()->get('key') == 0 || session()->get('key') == 1) {
            return view('welcome');
        }
    }
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

        if($user == null){
            return redirect()->route("index");
        }

        if (Hash::check($req->senha, $user->senha)) {
            session([
                'key' => 1,
                'nome' => $user->nome,
                'id' => $user->id
            ]);
            return redirect()->route("index");
        }
        return redirect()->route("index");
    }
    function login_sair()
    {
        session()->flush();
        session(['key' => 0, 'nome' => ""]);
        return redirect()->route("index");
    }
    function edit_perfil()
    {
        $id = session()->get('id');
        return $model = model_crud::find($id);        
    }
    function edit_save(Request $req)
    {
        $id = session()->get('id');
        $model = model_crud::find($id);
        
        if(!$req->email == null){
            $model->email = $req->email;
        }
        if(!$req->antigaSenha == null){
            if(Hash::check($req->antigaSenha, $model->senha)){
                $model->senha = Hash::make($req->novaSenha);
            }
        }
        if(!$req->nome == null){
            $model->nome = $req->nome;
            session()->put('nome', $req->nome);
        }
        if(!$req->cpf == null){
            $model->cpf = $req->cpf;
        }
        if(!$req->ddd == null){
            $model->ddd = $req->ddd;
        }
        if(!$req->telefone == null){
            $model->telefone = $req->telefone;
        }
        if(!$req->enderecoNome == null){
            $model->enderecoNome = $req->enderecoNome;
        }
        if(!$req->enderecoNumero == null){
            $model->enderecoNumero = $req->enderecoNumero;
        }
        if(!$req->complemento == null){
            $model->complemento = $req->complemento;
        }
        if(!$req->bairro == null){
            $model->bairro = $req->bairro;
        }
        if(!$req->cep == null){
            $model->cep = $req->cep;
        }
        if(!$req->cidade == null){
            $model->cidade = $req->cidade;
        }
        if(!$req->estado == null){
            $model->estado = $req->estado;
        }
        if(!$req->pais == null){
            $model->pais = $req->pais;
        }
        if(!$req->dataNascimento == null){
            $model->dataNascimento = $req->dataNascimento;
        }
        if(!$req->ddd == null){
            $model->areaCode = $req->ddd;
        }
        $model->save();
        return redirect()->route('edit');
    }
    function session()
    {
        return session()->all();
    }

    function xx()
    {

        // $user = DB::table('model_cruds')->where('email', 'comprador@uol.com.br')->first();
        // return $user;

        // session add
        // echo session()->put('nome', 'esdras');

        // session get
        // echo session()->get('key');

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

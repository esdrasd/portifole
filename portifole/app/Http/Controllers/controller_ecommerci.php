<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_produtos;
use App\Models\model_crud;
use App\Models\model_add_produtosPerfil;
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
        $model->id_perfil = session()->get('id');
        $model->desc = $req->desc;
        $model->nome = $req->nome;
        $model->price = $req->price;
        $model->img = json_encode($img);
        $model->save();
        return redirect()->route('index');
    }
    function add_show_img()
    {
        $id = session()->get('id');
        return $model = model_produtos::where('id_perfil', $id)->get();
    }
    function addCardDel(Request $req)
    {
        $model = model_produtos::where('id', $req->id)->delete();
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
        $test = 0;

        $idx = session()->get('id');
        $model = model_crud::where('id', $idx)->first();

        $config['email'] = "esdrassousa76@gmail.com";
        $config['token'] = "13ACCD9BA759496B98B87DD7AD13DBD3";
        $config['paymentMode'] = 'default';
        $config['paymentMethod'] = 'boleto';
        $config['receiverEmail'] = 'esdrassousa76@gmail.com';
        $config['currency'] = 'BRL';
        $config['notificationURL'] = 'https://sualoja.com.br/notifica.html';
        $config['reference'] = 'REF1234';

        $comprador['senderHash'] = $req->id_comprador_boleto;
        $comprador['senderName'] = $model->nome;
        $comprador['senderCPF'] = $model->cpf;
        $comprador['senderAreaCode'] = $model->ddd;
        $comprador['senderPhone'] = $model->telefone;
        $comprador['senderEmail'] = $model->email;

        foreach (json_decode($req->produto) as $i) {
            $key++;
            $prod['itemId' . $key] = $key;
            $prod['itemDescription' . $key] = $i->nome;
            $prod['itemAmount' . $key] = number_format($i->price, 2, '.', '');
            $prod['itemQuantity' . $key] = $i->count;
        }

        $shipping['shippingAddressRequired'] = "true";
        $shipping['shippingAddressStreet'] = $model->enderecoNome;
        $shipping['shippingAddressNumber'] = $model->enderecoNumero;
        $shipping['shippingAddressComplement'] = $model->complemento;
        $shipping['shippingAddressDistrict'] = $model->bairro;
        $shipping['shippingAddressPostalCode'] = $model->cep;
        $shipping['shippingAddressCity'] = $model->cidade;
        $shipping['shippingAddressState'] = $model->estado;
        $shipping['shippingAddressCountry'] = $model->pais;

        if ($test == 1) {
            return $array = $config + $comprador + $prod + $shipping;
        } else {
            $array = $config + $comprador + $prod + $shipping;
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=esdrassousa76@gmail.com&token=13ACCD9BA759496B98B87DD7AD13DBD3";
            $id = Http::asForm()->post($url, $array);
            $xml = simplexml_load_string($id);
            return redirect($xml->paymentLink);
        }
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
        $test = 0;

        $idx = session()->get('id');
        $model = model_crud::where('id', $idx)->first();

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
            $prod['itemDescription' . $key] = $i->desc . " / " . $i->nome . " / " . $i->img;
            $prod['itemAmount' . $key] = number_format($i->price, 2, '.', '');
            $prod['itemQuantity' . $key] = $i->count;
        }

        $comprador['senderHash'] = $req->id_comprador_boleto;
        $comprador['senderName'] = $model->nome;
        $comprador['senderCPF'] = $model->cpf;
        $comprador['senderAreaCode'] = $model->ddd;
        $comprador['senderPhone'] = $model->telefone;
        $comprador['senderEmail'] = $model->email;

        $shipping['shippingAddressRequired'] = "true";
        $shipping['shippingAddressStreet'] = $model->enderecoNome;
        $shipping['shippingAddressNumber'] = $model->enderecoNumero;
        $shipping['shippingAddressComplement'] = $model->complemento;
        $shipping['shippingAddressDistrict'] = $model->bairro;
        $shipping['shippingAddressPostalCode'] = $model->cep;
        $shipping['shippingAddressCity'] = $model->cidade;
        $shipping['shippingAddressState'] = $model->estado;
        $shipping['shippingAddressCountry'] = $model->pais;
        $shipping['shippingType'] = "1";
        $shipping['shippingCost'] = "0.00";

        $credit['creditCardToken'] =  $req->id_card;
        $credit['creditCardHolderName'] = $model->nome;
        $credit['creditCardHolderCPF'] = $model->cpf;
        $credit['creditCardHolderBirthDate'] = date("d/m/Y", strtotime($model->dataNascimento));
        $credit['creditCardHolderAreaCode'] = $model->ddd;
        $credit['creditCardHolderPhone'] = $model->telefone;

        $billing['billingAddressStreet'] = $model->enderecoNome;
        $billing['billingAddressNumber'] = $model->enderecoNumero;
        $billing['billingAddressComplement'] = $model->complemento;
        $billing['billingAddressDistrict'] = $model->bairro;
        $billing['billingAddressPostalCode'] = $model->cep;
        $billing['billingAddressCity'] = $model->cidade;
        $billing['billingAddressState'] = $model->estado;
        $billing['billingAddressCountry'] = $model->pais;
        $install['installmentQuantity'] = $req->parcelas;
        $install['installmentValue'] = number_format($req->v_parcela, 2, '.', '');

        if ($test == 1) {
            return $array = $config + $comprador + $prod + $shipping + $credit + $billing + $install;
        } else {
            $array = $config + $comprador + $prod + $shipping + $credit + $billing + $install;
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=esdrassousa76@gmail.com&token=13ACCD9BA759496B98B87DD7AD13DBD3";
            $id = Http::asForm()->post($url, $array);
            return $json = json_encode(simplexml_load_string($id));
        }
    }
    function registrar_cadastrar(Request $req)
    {
        $model = new model_crud;
        $validar = new cpf_validar();
        $validar->validar($req->cpf);

        $model->email = $req->email;
        $model->senha = $req->senha;
        // Hash::make($req->senha);
        $model->nome = $req->nome;
        $model->cpf = $validar->cpf;
        $model->ddd = $req->ddd;
        $model->areaCode = $req->ddd;
        $model->telefone = $req->telefone;
        $model->enderecoNome = $req->enderecoNome;
        $model->enderecoNumero = $req->enderecoNumero;
        $model->complemento = $req->complemento;
        $model->bairro = $req->bairro;
        $model->cep = $req->cep;
        $model->cidade = $req->cidade;
        $model->estado = $req->estado;
        $model->pais = $req->pais;
        $model->dataNascimento = $req->dataNascimento;

        if ($validar->error == 0) {
            $model->save();
            return redirect()->route('index');
        } else {
            return redirect()->route('registrar');
        }
    }
    function login(Request $req)
    {
        $user = DB::table('model_cruds')->where('email', $req->email)->first();

        if ($user == null) {
            return redirect()->route("index");
        }
        if (Hash::check($req->senha, $user->senha)) {
            session([
                'key' => 1,
                'nome' => $user->nome,
                'email' => $req->email,
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
        $validar = new cpf_validar();
        $erro = null;
        
        if (!$req->email == null) {
            if (filter_var($req->email, FILTER_VALIDATE_EMAIL)) {
                $model->email = $req->email;
            } else {
                return redirect()->route('edit');
            }
        }
        if (!$req->antigaSenha == null) {
            if (Hash::check($req->antigaSenha, $model->senha)) {
                $model->senha = Hash::make($req->novaSenha);
            }
        }
        if (!$req->nome == null) {
            $model->nome = $req->nome;
            session()->put('nome', $req->nome);
        }
        if (!$req->cpf == null) {
            $validar->validar($req->cpf);
            $model->cpf = $validar->cpf;
            $erro = $validar->error;
        }
        if (!$req->ddd == null) {
            $model->ddd = $req->ddd;
        }
        if (!$req->telefone == null) {
            $model->telefone = $req->telefone;
        }
        if (!$req->enderecoNome == null) {
            $model->enderecoNome = $req->enderecoNome;
        }
        if (!$req->enderecoNumero == null) {
            $model->enderecoNumero = $req->enderecoNumero;
        }
        if (!$req->complemento == null) {
            $model->complemento = $req->complemento;
        }
        if (!$req->bairro == null) {
            $model->bairro = $req->bairro;
        }
        if (!$req->cep == null) {
            $model->cep = $req->cep;
        }
        if (!$req->cidade == null) {
            $model->cidade = $req->cidade;
        }
        if (!$req->estado == null) {
            $model->estado = $req->estado;
        }
        if (!$req->pais == null) {
            $model->pais = $req->pais;
        }
        if (!$req->dataNascimento == null) {
            $model->dataNascimento = $req->dataNascimento;
        }
        if (!$req->ddd == null) {
            $model->areaCode = $req->ddd;
        }

        if ($erro == 0) {
            $model->save();
            return redirect()->route('edit');
        } else {
            return redirect()->route('edit');
        }
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

        // $id = session()->get('id');
        // $model = model_crud::where('id', $id)->first();
        // return $newDate = date("d-m-Y", strtotime($model->dataNascimento));
    }
}

class cpf_validar
{
    public $cpf;
    public $error;
    function validar($validar)
    {
        $cpf = $validar;
        $cpfx = preg_replace('/[^A-Za-z0-9]/', '', $cpf);
        $cpfLimpo = substr(preg_replace('/[^A-Za-z0-9]/', '', $cpf), 0, 9);
        $x = 10;
        $soma = 0;
        $y = 0;
        // $erro = null;
        
        for ($i = 0; $i < strlen($cpfLimpo); $i++) {
            $soma += intval($cpfLimpo[$i])  * $x--;
        }
        if ($soma % 11 < 2) {
            $y = $cpfLimpo . 0;
        } else {
            $y = $cpfLimpo . 11 - $soma % 11;
        }
        $cpfLimpo = substr(preg_replace('/[^A-Za-z0-9]/', '', $cpf), 0, 10);
        $x = 11;
        $soma = 0;
        for ($i = 0; $i < strlen($cpfLimpo); $i++) {
            $soma += intval($cpfLimpo[$i]) * $x--;
        }
        if ($soma % 11 < 2) {
            $y = $cpfLimpo . 0;
        } else {
            $y = $cpfLimpo . 11 - $soma % 11;
        }
        if ($cpfx == $y) {
            $this->cpf = $cpfx;
            $this->error = 0;
        } else {
            $this->error = 1;
        }
    }
}

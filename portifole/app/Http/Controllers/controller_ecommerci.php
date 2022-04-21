<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_produtos;

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
    function boleto(Request $req)
    {
        echo $req->produto;
        echo "<hr>";
        foreach(json_decode($req->produto) as $i){
            echo $i->id;
            echo "<br>";
            echo $i->nome;
            echo "<br>";
            echo $i->price;
            echo "<br>";
            echo $i->img;
            echo "<hr>";
        }
        echo "price: ".$req->price;
    }
}

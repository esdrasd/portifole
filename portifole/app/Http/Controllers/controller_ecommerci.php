<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_produtos;

class controller_ecommerci extends Controller
{
    function add(Request $req)
    {
        $model = new model_produtos;
        $model->nome = $req->nome;
        $model->price = $req->price;
        $x = $req->file('img');
        foreach ($x as $v) {
            $img[] = $v->store('fotos', 'public');
        }
        $model->img = json_encode($img);
        $model->save();
        return redirect()->route('index');
    }
    function show()
    {
        return $model = new model_produtos();
    }
}

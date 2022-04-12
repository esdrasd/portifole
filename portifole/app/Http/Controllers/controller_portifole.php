<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\model_portifole;

class controller_portifole extends Controller
{
    function add(Request $request)
    {
        $x = $request->file('img');
        foreach ($x as $y) {
            $vetor[] = $y->store('fotos', 'public');
        }

        $model = new model_portifole;
        $model->nome = $request->nome;
        $model->price = $request->price;
        $model->img = json_encode($vetor);
        $model->save();
        return redirect()->route('index');
    }
    function show()
    {
        return $users = DB::table('model_portifoles')->get();
    }
    function pagamento(Request $request)
    {
        return $request->pagar;
    }
}

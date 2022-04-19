<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class controller_pagamento extends Controller
{
    function add(Request $req)
    {
        $array = [];
        foreach ($req->img as $value) {
            array_push($array, $value);
        }
        print_r($array[0]);
        // $req->file($value)->store('fotos', 'public');
    }
}

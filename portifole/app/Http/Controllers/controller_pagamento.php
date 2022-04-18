<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class controller_pagamento extends Controller
{
    function add(Request $req)
    {
        echo $req->file('img')->store('fotos','public');
    }
}

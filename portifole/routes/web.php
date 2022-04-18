<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_pagamento;

route::view('/', 'welcome')->name('index');
route::post('add', [controller_pagamento::class, 'add'])->name('add');

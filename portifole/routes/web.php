<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_ecommerci;

route::view('/', 'welcome')->name('index');
route::get('id', [controller_ecommerci::class, 'id'])->name('id');
route::get('show', [controller_ecommerci::class, 'show'])->name('show');
route::post('add', [controller_ecommerci::class, 'add'])->name('add');
route::post('boleto', [controller_ecommerci::class, 'boleto'])->name('boleto');
route::post('credito', [controller_ecommerci::class, 'credito'])->name('credito');


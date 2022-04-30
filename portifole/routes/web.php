<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_ecommerci;

route::view('/', 'welcome')->name('index');
route::view('registrar', 'registrar')->name('registrar');

route::get('id', [controller_ecommerci::class, 'id'])->name('id');
route::get('show', [controller_ecommerci::class, 'show'])->name('show');

route::get('session', [controller_ecommerci::class, 'session'])->name('session');



route::post('add', [controller_ecommerci::class, 'add'])->name('add');
route::post('boleto', [controller_ecommerci::class, 'boleto'])->name('boleto');
route::post('credito', [controller_ecommerci::class, 'credito'])->name('credito');
// route::post('login', [controller_ecommerci::class, 'login'])->name('login');
route::post('registrar_cadastrar', [controller_ecommerci::class, 'registrar_cadastrar'])->name('registrar_cadastrar');

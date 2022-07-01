<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_ecommerci;

route::view('registrar', 'registrar')->middleware('middleware_sair_login')->name('registrar');
route::view('edit', 'edit')->middleware('middleware_login')->name('edit');

route::get('/', [controller_ecommerci::class, 'index'])->name('index');
route::get('id', [controller_ecommerci::class, 'id'])->name('id');
route::get('show', [controller_ecommerci::class, 'show'])->name('show');
route::get('login_sair', [controller_ecommerci::class, 'login_sair'])->middleware('middleware_login')->name('login_sair');
route::get('edit_perfil', [controller_ecommerci::class, 'edit_perfil'])->middleware('middleware_login')->name('edit_perfil');
route::get('session', [controller_ecommerci::class, 'session']);
route::get('add_show_img', [controller_ecommerci::class, 'add_show_img']);

route::post('add', [controller_ecommerci::class, 'add'])->middleware('middleware_login')->name('add');
route::post('addCardDel', [controller_ecommerci::class, 'addCardDel'])->middleware('middleware_login')->name('addCardDel');
route::post('boleto', [controller_ecommerci::class, 'boleto'])->middleware('middleware_login')->name('boleto');
route::post('credito', [controller_ecommerci::class, 'credito'])->middleware('middleware_login')->name('credito');
route::post('registrar_cadastrar', [controller_ecommerci::class, 'registrar_cadastrar'])->middleware('middleware_sair_login')->name('registrar_cadastrar');
route::post('login', [controller_ecommerci::class, 'login'])->name('login');
route::post('edit_save', [controller_ecommerci::class, 'edit_save'])->middleware('middleware_login')->name('edit_save');

//teste;
route::get('x', [controller_ecommerci::class, 'xx']);

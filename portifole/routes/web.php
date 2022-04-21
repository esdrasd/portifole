<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_ecommerci;

route::view('/', 'welcome')->name('index');

route::post('add', [controller_ecommerci::class, 'add'])->name('add');
route::post('pagamento', [controller_ecommerci::class, 'pagamento'])->name('pagamento');

route::get('show', [controller_ecommerci::class, 'show'])->name('show');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_portifole;

route::view('/', 'index')->name('index');
route::post('add', [controller_portifole::class, 'add'])->name('add');
route::get('show', [controller_portifole::class, 'show'])->name('show');
route::post('pagamento', [controller_portifole::class, 'pagamento'])->name('pagamento');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\VendasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/analise', ['App\Http\Controllers\TesteController', 'index']);

Route::get('/', function () {return redirect()->route('login');});

/*Route::get('/inicio',function(){
    return view('layouts.app');
});*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', ['App\Http\Controllers\DashboardController', 'dashboard'])->name('dashboard');
});

Route::get('/analise', ['App\Http\Controllers\TesteController', 'index']);

Route::get('/comprasLista',function(){
        return view('compras.comprasLista');
})->name('compras.comprasLista');

Route::get('/comprasGraficos',function(){
    return view('compras.comprasGraficos');
})->name('compras.comprasGraficos');

Route::get('/vendasGraficos',function(){
    return view('vendas.vendasGraficos');
})->name('vendas.vendasGraficos');

Route::get('/vendasLista',function(){
    return view('vendas.vendasLista');
})->name('vendas.vendasLista');

Route::get('/vendasGraficos',[VendasController::class,'vendasGrafico'])->name('artigos.vendasGraficos');
Route::get('/clientesGraficos',[VendasController::class,'clientesGraficosView'])->name('artigos.clientesGraficos');
Route::get('/artigosVendidosGraficos',[VendasController::class,'artigoGraficosView'])->name('artigos.artigosVendidosGraficos');
///funções que retornam JSON
Route::get('/vendas/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'vendasTotal'])->name('vendas');
Route::get('/vendas/clientesGraficos/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'clientesGraficos'])->name('vendas.clientesGraficos');
Route::get('/vendas/artigosVendidosGraficos/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'artigoGraficos'])->name('vendas.artigoGraficos');

Route::get('/artigosDisponiveisGraficos',[ArtigoController::class,'artigosDisponiveisGraficos'])->name('artigos.artigosDisponiveisGraficos');
Route::get('/artigosIndisponiveisGraficos',[ArtigoController::class,'artigosIndisponiveisGraficos'])->name('artigos.artigosIndisponiveisGraficos');
Route::get('/artigosDisponiveisLista',[ArtigoController::class,'artigosDisponiveisView'])->name('artigos.artigosDisponiveisLista');
Route::get('/artigosIndisponiveisLista',[ArtigoController::class,'artigosIndisponiveisView'])->name('artigos.artigosIndisponiveisLista');

//Reports Referentes a Artigos
Route::get('/artigos/quantidade/',[ArtigoController::class,'qtdArtigos'])->name('artigos.quatidade');
Route::get('/artigos/disponiveis/',[ArtigoController::class,'artigosDisponiveis'])->name('artigos.disponiveis');
Route::get('/artigos/indisponiveis/',[ArtigoController::class,'artigosIndisponiveis'])->name('artigos.indisponiveis');

//Reports Referentes a Vendas
Route::get('/vendas/quantidade/',[VendasController::class,'qtdFacturas'])->name('vendas.quantidade');
Route::get('/vendas/total/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'totalFacturas'])->name('vendas.total');
Route::get('/vendas/clientes/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'topVendaCliente'])->name('vendas.clientes');
Route::get('/vendas/artigos/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'topVendaArtigo'])->name('vendas.artigos');
Route::get('/vendas/notascredito/{moeda}/{data_inicio}/{data_fim}',[VendasController::class,'topVendaArtigo'])->name('vendas.notas.credito');
<?php

namespace App\Http\Controllers;
use  App\Http\Controllers\ArtigoController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard(){ 
        $vendas= new VendasController();
        $artigos = new ArtigoController();

         $totalVenda = $vendas->qtdFacturas('AKZ','2010-01-01',now()->format('Y-m-d'));
         $totalVendas = json_decode($totalVenda->getContent());
         $totalArtigos= json_decode($artigos->qtdArtigos());
        $clientes = $vendas->topVendaCliente('AKZ','2010-01-01',now()->format('Y-m-d'));
        $clientes=count(json_decode($clientes->getContent()));
        $dado= $vendas->topVendaArtigo('AKZ', '2010-01-01', now()->format('Y-m-d'));
        $dados=  $dado->getContent();
 
        
        
        return view('dashboard.dashboard',compact('totalVendas','totalArtigos','clientes','dados'));
    }

    
}
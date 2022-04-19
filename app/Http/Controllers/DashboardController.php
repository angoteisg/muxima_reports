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

        $totalVendas = json_decode($vendas->qtdFacturas());
        $totalArtigos= json_decode($artigos->qtdArtigos());
        
        return view('dashboard.dashboard',compact('totalVendas','totalArtigos'));
    }

    
}

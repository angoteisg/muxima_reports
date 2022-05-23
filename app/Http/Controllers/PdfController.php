<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use  App\Http\Controllers\ArtigoController;
use  App\Http\Controllers\VendasController;

class PdfController extends Controller
{
    protected $Artigo;

    public function report_artigosIndisponiveis(){
        
        $this->Artigo = new ArtigoController();

        $artigos = $this->Artigo->artigosIndisponiveis()->getData();
        
        $pdf = PDF::loadView('pdf.artigos_indisponivel',compact('artigos'));
        $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream(); 
    }

    public function report_topVendaArtigo(Request $request){

        $moeda = $request->input('moeda', 'AKZ');
        $data_inicio = $request->input('data_inicio', '2020-01-01'); 
        $data_fim = $request->input('data_fim', '2022-12-31');

        $this->Artigo = new VendasController();

        $artigosMaisComprados = $this->Artigo->topVendaArtigo($moeda, $data_inicio, $data_fim)->getData();

        $pdf = PDF::loadView('pdf.topVendasArtigo',compact('artigosMaisComprados'));
        $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream();
    }

}

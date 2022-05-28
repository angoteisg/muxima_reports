<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use  App\Http\Controllers\ArtigoController;
use  App\Http\Controllers\VendasController;
//use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfController extends Controller
{
    protected $Artigo;

    public function report_artigosIndisponiveis(){
        
        $this->Artigo = new ArtigoController();

        $artigos = $this->Artigo->artigosIndisponiveis()->getData();
        
        $pdf = PDF::loadView('pdf.artigos_indisponivel',compact('artigos'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream(); 
    }


    public function report_artigosDisponiveis(){
        $this->Artigo = new ArtigoController();

        $artigos = json_decode($this->Artigo->artigosDisponiveis());
        
        $pdf = PDF::loadView('pdf.artigos_disponivel',compact('artigos'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream('artigosDisponiveis.pdf'); 
    }


    
    public function report_artigosVendidos($moeda, $data_inicio, $data_fim){
        $venda = new VendasController();

        $artigos = json_decode($venda->topVendaArtigo($moeda, $data_inicio, $data_fim)->getContent());
      
        $pdf = PDF::loadView('pdf.artigos_vendidos',compact('artigos','data_inicio','data_fim','moeda'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream('artigosVendidos.pdf'); 
    }

    public function report_clientes($moeda, $data_inicio, $data_fim){
        $venda = new VendasController();

        $clientes = json_decode($venda->topVendaCliente($moeda, $data_inicio, $data_fim)->getContent());
        
        $pdf = PDF::loadView('pdf.clientes',compact('clientes','data_inicio','data_fim','moeda'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream('clientes.pdf'); 
    }

    public function report_distribuicaoMensal($moeda, $data_inicio, $data_fim){
        $venda = new VendasController();

        $distribuicao = json_decode($venda->distribuicaoMensal($moeda, $data_inicio, $data_fim)->getContent());
        $mes= [1=>"Janeiro",2=>"Fevereiro",3=>"Março",4=>"Abril",5=>"Maio",6=>"Junho",7=>"Julho",8=>"Agosto",9=>"Setembro",10=>"Outubro",11=>"Novembro",12=>"Dezembro"];

        $pdf = PDF::loadView('pdf.distribuicaoMensal',compact('distribuicao','data_inicio','data_fim','moeda','mes'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream('distribuicaoMensal.pdf'); 
    }

    public function report_distribuicaoMensalClientes($moeda, $data_inicio, $data_fim,$cliente){
        $venda = new VendasController();
        $mes= [1=>"Janeiro",2=>"Fevereiro",3=>"Março",4=>"Abril",5=>"Maio",6=>"Junho",7=>"Julho",8=>"Agosto",9=>"Setembro",10=>"Outubro",11=>"Novembro",12=>"Dezembro"];

        $distribuicao = json_decode($venda->distribuicaoMensalCliente($moeda, $data_inicio, $data_fim,$cliente)->getContent());
       // return $distribuicao;
        $pdf = PDF::loadView('pdf.distribuicaoMensalCliente',compact('distribuicao','data_inicio','data_fim','moeda','cliente','mes'));
       // $pdf->getDOMPdf()->set_option('isPhpEnabled', true);  
        return $pdf->stream('distribuicaoMensalCliente.pdf'); 
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

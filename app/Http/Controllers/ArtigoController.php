<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtigoController extends Controller
{

    /*Função qtdArtigos() Retorna o total de artigos registados no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function qtdArtigos(){
        $artigos = DB::connection('sqlsrv')->select("select count(*) as quantidade from Artigo;");
        return json_encode(array("quantidade" => $artigos[0]->quantidade));
    }

    /*Função artigosDisponiveis() Retorna todos artigos que possuem stock no ERP Primavera V10
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function artigosDisponiveis(){
        $artigos = DB::connection('sqlsrv')->select("select A.Descricao, INV.StkActual from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual > 0 ;");
        $resultado = array();
        $linha = array();

        if(empty($artigos)){
            return json_encode(['descricao' => "Todos Artigos Não Estão Disponiveis No Stock",'stock' => -1]);
        }

        foreach ($artigos as $artigo) {
            $linha['descricao'] = $artigo->Descricao;
            $linha['stock'] = $artigo->StkActual;
            array_push($resultado,$linha);
        }
        
        return json_encode($resultado);
    }

    /*Função artigosIndisponiveis() Retorna todos artigos que não possuem stock no ERP Primavera V10
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function artigosIndisponiveis(){
        $artigos = DB::connection('sqlsrv')->select("select A.Descricao, INV.StkActual from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual <= 0 ;");
        $resultado = array();
        $linha = array();

        if(empty($artigos)){
            return json_encode(['descricao' => "Todos Artigos Estão Disponiveis No Stock",'stock' => -1]);
        }
        
        foreach ($artigos as $artigo) {
            $linha['descricao'] = $artigo->Descricao;
            $linha['stock'] = $artigo->StkActual;
            array_push($resultado,$linha);
        }
        return json_encode($resultado);
    }
}

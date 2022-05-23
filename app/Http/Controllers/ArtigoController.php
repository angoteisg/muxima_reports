<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtigoController extends Controller
{
    public function artigosDisponiveisView(){
            $artigos= json_decode( $this->artigosDisponiveis());

            return view('artigos.artigosDisponiveisLista',compact('artigos'));
    }

    public function artigosIndisponiveisView(){
        $artigos=json_decode( $this->artigosIndisponiveis());

        return view('artigos.artigosIndisponiveisLista',compact('artigos'));
}

public function artigosDisponiveisGraficos(){
    //$artigos=json_decode( $this->artigosIndisponiveis());
    $dados= $this->artigosDisponiveis();
   

  //return $data;
    return view('artigos.artigosDisponiveisGraficos',compact("dados"));
}

public function artigosIndisponiveisGraficos(){
    //$artigos=json_decode( $this->artigosIndisponiveis());
    $dados=  $this->artigosIndisponiveis();
    

  //return $data;
    return view('artigos.artigosIndisponiveisGraficos',compact("dados"));
}




    /*Função qtdArtigos() Retorna o total de artigos registados no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 28/04/2022
    */
    public function qtdArtigos(){
        try{
            $artigos = DB::connection('sqlsrv')->select("select count(*) as quantidade from Artigo A, V_INV_ValoresActuaisStockArm INV where INV.Stock>0 and A.Artigo=INV.Artigo;");
            return json_encode(["quantidade" => $artigos[0]->quantidade]);
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }

    /*Função artigosDisponiveis() Retorna todos artigos que possuem stock no ERP Primavera V10
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function artigosDisponiveis(){
        try{
            $artigos = DB::connection('sqlsrv')->select("select A.Descricao as descricao, INV.StkActual as stock from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual > 0 order by INV.StkActual DESC ;");

            if(empty($artigos)){ 
                return response()->json(['descricao' => "Todos Artigos Não Estão Disponiveis No Stock",'stock' => -1]);
            }
            
            return response()->json($artigos);
        }catch(Exception $e){
            return response()->json(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }

    /*Função artigosIndisponiveis() Retorna todos artigos que não possuem stock no ERP Primavera V10
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function artigosIndisponiveis(){
        try{
            $artigos = DB::connection('sqlsrv')->select("select A.Descricao as descricao, INV.StkActual stock from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual <= 0 ;");

            if(empty($artigos)){
                return response()->json(['descricao' => "Todos Artigos Estão Disponiveis No Stock",'stock' => -1]);
            }

            return response()->json($artigos);
        }catch(Exception $e){
            return response()->json(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }


    
}

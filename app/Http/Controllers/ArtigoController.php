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
    $artigos= json_decode( $this->artigosDisponiveis());
    $label= [];
        $dt= [];
    foreach($artigos as $artigos) {
        array_push($label,substr($artigos->descricao,0,11));
        array_push($dt,number_format($artigos->stock,0));
    }
    
    $labels= json_encode($label);
    $data=json_encode($dt);

  //return $data;
    return view('artigos.artigosDisponiveisGraficos',compact("labels","data"));
}

public function artigosIndisponiveisGraficos(){
    //$artigos=json_decode( $this->artigosIndisponiveis());
    $artigos= json_decode( $this->artigosIndisponiveis());
    $label= [];
        $dt= [];
    foreach($artigos as $artigos) {
        array_push($label,substr($artigos->descricao,0,11));
        array_push($dt,number_format($artigos->stock,0));
    }
    
    $labels= json_encode($label);
    $data=json_encode($dt);

  //return $data;
    return view('artigos.artigosIndisponiveisGraficos',compact("labels","data"));
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
            $artigos = DB::connection('sqlsrv')->select("select A.Descricao, INV.StkActual from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual > 0 order by INV.StkActual DESC ;");
            $resultado = array();
            $linha = array();

            if(empty($artigos)){ 
                return json_encode(array(['descricao' => "Todos Artigos Não Estão Disponiveis No Stock",'stock' => -1]));
            }

            foreach ($artigos as $artigo) {
                $linha['descricao'] = $artigo->Descricao;
                $linha['stock'] = $artigo->StkActual;
                array_push($resultado,$linha);
            }
            
            return json_encode($resultado);
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }

    /*Função artigosIndisponiveis() Retorna todos artigos que não possuem stock no ERP Primavera V10
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function artigosIndisponiveis(){
        try{
            $artigos = DB::connection('sqlsrv')->select("select A.Descricao, INV.StkActual from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual <= 0 ;");
            $resultado = array();
            $linha = array();

            if(empty($artigos)){
                return json_encode(array(['descricao' => "Todos Artigos Estão Disponiveis No Stock",'stock' => -1]));
            }
            
            foreach ($artigos as $artigo) {
                $linha['descricao'] = $artigo->Descricao;
                $linha['stock'] = $artigo->StkActual;
                array_push($resultado,$linha);
            }
            return json_encode($resultado);
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }
}

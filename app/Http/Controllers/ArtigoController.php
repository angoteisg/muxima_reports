<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
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
        try{
            $artigos = DB::connection('sqlsrv')->select("select count(*) as quantidade from Artigo;");
            return json_encode(array(["quantidade" => $artigos[0]->quantidade]));
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
            $artigos = DB::connection('sqlsrv')->select("select A.Descricao, INV.StkActual from Artigo A, V_INV_ArtigoArmazem INV where A.Artigo = INV.Artigo and INV.StkActual > 0 order by INV.StkActual asc ;");
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

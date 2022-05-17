<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MoedaController extends Controller
{
    /*Função isMoeda Retorna as moedas com alguma exitencia 
    Criado: Ricardo Neves
    Data Criação: 29/04/2022
    Ultima Modificação: 29/04/2022
    */ 
    public function isMoedas(){
        try{
            $moedas = DB::connection('sqlsrv')->select("select Moeda as Codigo, Descricao from Moedas where Moeda in (Select Moeda from CabecDoc) order by Moeda asc");
            if(empty($moedas)){
                return json_encode(['Mensagem' => "Nenhuma Moeda"]);
            }
            return json_encode($moedas);
        }catch(Exception $e){
            return json_encode(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }
}

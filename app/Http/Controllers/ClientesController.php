<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function clientesData($data_inicio, $data_fim){
        try{
            $clientes = DB::connection('sqlsrv')->select("select NomeFAC as cliente from CabecDoc where Moeda = 'AKZ' and Id in (
                select IdCabecDoc
                    from LinhasDoc 
                    where    
                        Artigo <> 'NULL' 
                        and Data >= '".$data_inicio."'
                        and Data <= '".$data_fim."'
            ) 
            group by NomeFac");
            return response()->json($clientes);
        }catch(Exception $e){
            return ['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EncomendaController extends Controller
{
     /*
        Método: qtdEncomendasCliente() 
        Retorno:  Quantidade de encomendas de clientes
        Criado: Etevaldo Antunes
        Data Criação: 01/05/2022
        Ultima Modificação:  01/05/2022 
    */
    public function qtdEncomendasCliente(){
        $encomendas = DB::connection('sqlsrv')->select("SELECT COUNT(*) AS quantidade FROM CabecDoc ECL WHERE ECL.TipoDoc = 'ECL'");
        return response()->json(["quantidade" => $encomendas[0]->quantidade]);
    }

     /*
        Método: qtdEncomendasMes()
        Parametros: Moeda, Data Inicio, Data Fim 
        Retorno: Quantidade de Encomendas de Clientes por MES
        Criado: Etevaldo Antunes
        Data Criação: 01/05/2022
        Ultima Modificação:  01/05/2022 
    */
    public function qtdEncomendasMes($moeda, $data_inicio, $data_fim){
        $encomendasMes = DB::connection('sqlsrv')->select("SET DATEFORMAT ymd;
                                                        SELECT COUNT(*) AS quantidade
                                                        FROM CabecDoc ECL
                                                        WHERE
                                                        ECL.TipoDoc = 'ECL'
                                                        and ECL.Moeda='".$moeda."'
                                                        and ECL.DataGravacao >= CAST(N'".$data_inicio."' AS DateTime) 
                                                        and ECL.DataGravacao < CAST(N'".$data_fim."' AS DateTime)");
        if(isset($encomendasMes)){
            return response()->json(["quantidade" => $encomendasMes[0]->quantidade], 200);
        }
        return response()->json(['erro' => 'Encomendas não encontrado'],400); 
    }

     /*
        Método: clientesMaisEncomendas() 
        Parametros: Moeda, Data Inicio, Data Fim
        Retorno: Clientes com mais encomendas
        Estado: Parcial
        Criado: Etevaldo Antunes
        Data Criação: 01/05/2022
        Ultima Modificação:  01/05/2022 
    */
    public function clientesMaisEncomendas($moeda, $data_inicio, $data_fim){
        $clienteMaisEncomendas = DB::connection('sqlsrv')->select("SELECT CL.Cliente, CL.Nome, COUNT(ECL.Entidade) qtd 
        FROM CabecDoc ECL,Clientes CL
        WHERE CL.Cliente = ECL.Entidade
        AND ECL.TipoDoc = 'ECL'
        and ECL.Moeda='".$moeda."'
        and ECL.DataGravacao >= CAST(N'".$data_inicio."' AS DateTime) 
        and ECL.DataGravacao < CAST(N'".$data_fim."' AS DateTime) 
        GROUP BY CL.Cliente, CL.Nome"); 
        
        if(isset($clienteMaisEncomendas)){
            return response()->json(["clienteMaisEncomendas" => $clienteMaisEncomendas], 200);
        }
        return response()->json(['erro' => 'Registos não encontrado'],400);
    }

    /*
        Método: clienteEncomendaMes()
        Parametros: Moeda, Data Inicio, Data Fim
        Retorno: Cliente que mais encomendou por MES
        Criado: Etevaldo Antunes
        Data Criação: 01/05/2022
        Ultima Modificação:  01/05/2022 
    */
    public function clienteEncomendaMes($moeda, $ano){
        $clienteEncomendasMes = DB::connection('sqlsrv')->select("SELECT MONTH(ECL.DataGravacao) AS Mes, CL.Nome, COUNT(ECL.Entidade) as qtd
        FROM CabecDoc ECL, Clientes CL
        WHERE
        ECL.Entidade = CL.Cliente
        and ECL.TipoDoc = 'ECL'
        and ECL.Moeda=?
        and YEAR(ECL.DataGravacao) = ?  
        GROUP BY MONTH(ECL.DataGravacao), CL.Nome
        ORDER BY Mes ASC,CL.Nome ASC", [$moeda, $ano]);

        if(isset($clienteEncomendasMes)){
            return response()->json(["clienteEncomendasMes" => $clienteEncomendasMes]);
        }
        return response()->json(['erro' => 'Registos não encontrado'],400); 
    }
}

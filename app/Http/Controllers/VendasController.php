<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{

    /*Função qtdFacturas() Retorna Quantidade de Facturas Emitidas no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function qtdFacturas(){
        $facturas = DB::connection('sqlsrv')->select("select COUNT(*) as quantidade from CabecDoc where TipoDoc = 'FA';");
        return json_encode(array("quantidade" => $facturas[0]->quantidade));
    }

    /*Função totalFacturas Retorna o total em Dinheiro das 'FA' Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */

    public function totalFacturas($moeda, $data_inicio, $data_fim){
        try{
            $facturas = DB::connection('sqlsrv')->select("select sum(TotalDocumento) as total from CabecDoc where TipoDoc = 'FA' and Moeda='".$moeda."' and DataGravacao >='".$data_inicio."' and DataGravacao <'".$data_fim."';");
            return json_encode(array(["total" => $facturas[0]->total ?? 0]));
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }


    /*Função topVendaCliente Retorna o top com o nome e o somatorio do valor de compras em Dinheiro dos clientes Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */

    public function topVendaCliente($moeda, $data_inicio, $data_fim){
        try{
            $facturas = DB::connection('sqlsrv')->select("select NomeFac as nome, sum(TotalDocumento) as total 
            from CabecDoc 
            where TipoDoc='GR'
            and Moeda='".$moeda."' 
            and DataGravacao >='".$data_inicio."' 
            and DataGravacao <'".$data_fim."'  
            group by NomeFac 
            order by total desc;"); 

            if(empty($facturas)){
                return json_encode(array(['Cliente' => "Nenhum Cliente Encontrado",'total' => -1]));
            }

            $resultado = array();
            $linha = array();

            foreach ($facturas as $factura) {
                $linha['cliente'] = $factura->nome;
                $linha['total'] = $factura->total;
                array_push($resultado,$linha);
            }
            return json_encode($resultado);
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }


    /*Função topVendaArtigo Retorna os Artigos mais comprados com quantidades de compra e total em dinheiro das mesmas Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */ 
    public function topVendaArtigo($moeda, $data_inicio, $data_fim){
        try{
            $facturas = DB::connection('sqlsrv')->select("select A.Descricao as artigo, sum(LD.Quantidade) as qtd, sum((LD.PrecUnit * LD.Quantidade)) as total 
            from LinhasDoc LD, Artigo A, CabecDoc FA 
            where A.Artigo = LD.Artigo 
            and FA.Id = LD.IdCabecDoc 
            and FA.TipoDoc = 'FA'
            and FA.Moeda='".$moeda."' 
            and FA.DataGravacao >='".$data_inicio."' 
            and FA.DataGravacao <'".$data_fim."' 
            group by (A.Descricao) 
            order by qtd desc;");
            
            if(empty($facturas)){
                return json_encode(array(['artigo' => "Nenhum Artigo Vendido",'quantidade'=>-1,'total' => -1]));
            }

            $resultado = array();
            $linha = array();

            foreach ($facturas as $factura) {
                $linha['artigo'] = $factura->artigo;
                $linha['quantidade'] = $factura->qtd;
                $linha['total'] = $factura->total;
                array_push($resultado,$linha);
            }
            return json_encode($resultado);
        
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }

}

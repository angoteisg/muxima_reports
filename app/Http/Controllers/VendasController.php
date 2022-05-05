<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class VendasController extends Controller
{

    /*Função qtdFacturas() Retorna Quantidade de Facturas Emitidas no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function qtdFacturas(){
        $facturas = DB::connection('sqlsrv')->select("select COUNT(*) as quantidade from CabecDoc where TipoDoc = 'FA';");
        return json_encode(["quantidade" => $facturas[0]->quantidade]);
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
            return json_encode(["total" => $facturas[0]->total ?? 0]);
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }

/////////////////////////////////GRAFICOS CLIENTES/////////////////////////////////

    public function clientesGraficosView(){
    
        $dados=  $this->topVendaCliente("AKZ", "2021-01-01", "2022-01-01");
   
            return view('vendas.vendasClientesGraficos',compact("dados"));

    }
    public function clientesGraficos($moeda, $data_inicio, $data_fim){
    
        $dados=  $this->topVendaCliente($moeda, $data_inicio, $data_fim);
            return $dados;

    }
//////////////////////FIM GRAFICOS CLIENTES///////////////////////////////


/////////////////////TOTAL DE VENDA//////////////////////////////////

public function vendasGrafico(){
    $totalVendas=json_decode( $this->totalFacturas("AKZ", "2021-01-01", "2022-01-01"));
    $totalVendas->total= number_format($totalVendas->total,2);
        return view('vendas.vendasGraficos',compact("totalVendas"));

}
public function vendasTotal($moeda, $data_inicio, $data_fim){
    $totalVendas= json_decode(  $this->totalFacturas($moeda, $data_inicio, $data_fim));
    $totalVendas->total= number_format($totalVendas->total,2);
    return json_encode(["totalVendas"=>$totalVendas]);

}
 
////////////////////FIM GRAFICOS DE VENDA/////////////////////////////

    
/////////////////////////////////GRAFICOS ARTIGOS/////////////////////////////////

public function artigoGraficosView(){  

    $dados=  $this->topVendaArtigo('AKZ', '2020-01-01', '2022-01-01');
        return view('vendas.artigosVendidosGraficos',compact("dados"));

}


public function artigoGraficos($moeda, $data_inicio, $data_fim){
   
    $dados= $this->topVendaArtigo($moeda, $data_inicio, $data_fim);


        return $dados;

}
//////////////////////FIM GRAFICOS ARTIGOS///////////////////////////////









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
            where TipoDoc='FA'
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
    Ultima Modificação: 28/04/2022
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
            order by total desc;");
            
            if(empty($facturas)){
                return json_encode(array(['artigo' => "Nenhum Artigo Vendido",'quantidade'=>-1,'total' => -1]));
            }

            $resultado = array();
            $linha = array();

            //Busca das Notas de Credito

            $notas_credito = json_decode($this->topNotasCredito($moeda, $data_inicio, $data_fim));


            foreach ($facturas as $factura) {
                $linha['artigo'] = $factura->artigo;
                $linha['quantidade'] = $factura->qtd;
                $linha['total'] = $factura->total;
                array_push($resultado,$linha);
            }
            return json_encode($this->ajusteVendasNotasCredito($resultado,$notas_credito));
        
        }catch(Exception $e){
            return json_encode(array(['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]));
        }
    }




 /*Função topVendaArtigo Retorna os Artigos mais comprados com quantidades de compra e total em dinheiro das mesmas Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 28/04/2022
    Ultima Modificação: 28/04/2022
    */ 
    public function topNotasCredito($moeda, $data_inicio, $data_fim){
        try{
            $facturas = DB::connection('sqlsrv')->select("select A.Descricao as artigo, sum(LD.Quantidade) as qtd, sum((LD.PrecUnit * LD.Quantidade)) as total 
            from LinhasDoc LD, Artigo A, CabecDoc FA 
            where A.Artigo = LD.Artigo 
            and FA.Id = LD.IdCabecDoc 
            and FA.TipoDoc = 'NC'
            and FA.Moeda='".$moeda."' 
            and FA.DataGravacao >='".$data_inicio."' 
            and FA.DataGravacao <'".$data_fim."' 
            group by (A.Descricao) 
            order by total desc;");
            
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


/*Função ajusteVendasNotasCredito debita as notas de credito ao valor total das facturas Emitidas no ERP Primavera
    Parametros ($notas_credito - Indica as notas de credito);
    $facturas indica as facturas
    
    Criado: Ricardo Neves
    Data Criação: 28/04/2022
    Ultima Modificação: 28/04/2022
    */ 
    public function ajusteVendasNotasCredito($facturas,$notas_credito){

        for ($i=0; $i < count($facturas); $i++) { 
            for ($j=0; $j < count($notas_credito); $j++) { 
                if(strcmp($facturas[$i]["artigo"], $notas_credito[$j]->artigo) == 0){
                    $facturas[$i]["total"]-=$notas_credito[$j]->total;
                    $facturas[$i]["quantidade"] += ($notas_credito[$j]->quantidade);
                    break;
                }
            }
        }
        return $facturas;
    }

    
    public function totalPorData($documento, $moeda, $data_inicio, $data_fim,$cliente){
        try{
            $totais = DB::connection('sqlsrv')->select("select sum(PrecoLiquido) as total, Data as dt
            from LinhasDoc 
            where IdCabecDoc in 
                (select Id from CabecDoc 
                    where Moeda = '".$moeda."' 
                        and TipoDoc = '".$documento."'
                        ".(($cliente != NULL)? " and Nome like '%".$cliente."%' " : "")."
                ) 
                and Artigo <> 'NULL' 
                and Data >= '".$data_inicio."'
                and Data <= '".$data_fim."'
                group by Data
            ");
             return $totais;

        }catch(Exception $e){
            return ['mensagem' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
    }

    public function demandaMeses($datas){
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('Africa/Luanda');

        $qtd_mes = array (1 => 0 ,2 => 0,3 => 0,4 =>0 ,5 => 0,6 => 0 ,7 =>0,8 =>0,9 =>0,10 =>0,11 =>0,12 =>0);   //Array com os dias em PT com a quantidade em 0    
        foreach ($datas as $data=>$value) {
            
            $mes = (int) strftime('%m', strtotime($value->dt)); //a função strtotime com base uma data busca os meses em PT porque mudamos o local com setlocale
            $qtd_mes[$mes] += floatval($value->total); //então sempre que encontrar um dia soma na sua posisão apenas   
        }
        return $qtd_mes;
    }

    public function ajusteDemanda($faturas, $notas_credito){
        for ($i=1; $i <= 12; $i++) { 
            $faturas[$i] += $notas_credito[$i];
        }
        return $faturas;
    }

    public function distribuicaoMensal($moeda, $data_inicio, $data_fim){
        $total_notas_credito = $this->totalPorData('NC', $moeda, $data_inicio, $data_fim, NULL);
        $total_faturas = $this->totalPorData('FA', $moeda, $data_inicio, $data_fim, NULL);

        $faturas = $this->demandaMeses($total_faturas); // demanda por mes de facturas
        $notas_credito = $this->demandaMeses($total_notas_credito); // demanda por mes Notas de credito
       
        return json_encode($this->ajusteDemanda($faturas, $notas_credito));
    }


    public function distribuicaoMensalCliente($moeda, $data_inicio, $data_fim,$cliente){
        $total_notas_credito = $this->totalPorData('NC', $moeda, $data_inicio, $data_fim,$cliente);
        $total_faturas = $this->totalPorData('FA', $moeda, $data_inicio, $data_fim,$cliente);
        
        $faturas = $this->demandaMeses($total_faturas); // demanda por mes de facturas
        $notas_credito = $this->demandaMeses($total_notas_credito); // demanda por mes Notas de credito
       
        return json_encode($this->ajusteDemanda($faturas, $notas_credito));
    }
}

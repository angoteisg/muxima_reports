<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class VendasController extends Controller
{

    /*Função qtdNotasCredito() Retorna Quantidade de Facturas Emitidas no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function qtdNotasCredito($moeda, $data_inicio, $data_fim){
        $NotasCreditoController = new NotasCreditoController;
        return $NotasCreditoController->qtdNotasCredito($moeda, $data_inicio, $data_fim);
    }

    /*Função qtdFacturas() Retorna Quantidade de Notas de Credito Emitidas no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function qtdFacturas($moeda, $data_inicio, $data_fim){
        $FacturaController = new FacturaController;
        return $FacturaController->qtdFacturas($moeda, $data_inicio, $data_fim);
    }

    /*Função totalVendas Retorna o total em Dinheiro das vendas Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 09/05/2022
    */

    public function totalVendas($moeda, $data_inicio, $data_fim){
        try{
            $facturas = new FacturaController;
            $notas_credito = new NotasCreditoController;

            $total_faturas = $facturas->totalFacturas($moeda, $data_inicio, $data_fim);
            $total_notas_credito = $notas_credito->totalNotasCredito($moeda, $data_inicio, $data_fim);
             
            return response()->json(["total" => ($total_faturas + $total_notas_credito ?? 0)]);
        }catch(Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }

/////////////////////////////////GRAFICOS CLIENTES/////////////////////////////////

    public function clientesGraficosView(){
    
        $dados=  $this->topVendaCliente("AKZ", "2021-01-01", now()->format('Y-m-d'));
   
            return view('vendas.vendasClientesGraficos',compact("dados"));

    }

    public function clientesListasView(){
    
        $dado= json_decode( $this->topVendaCliente("AKZ", "2010-01-01", now()->format('Y-m-d')));
   //return $dados;
            return view('vendas.vendasClientesLista',compact("dado"));

    }

    public function clientesListasFiltro($moeda, $data_inicio, $data_fim){
    
        $dados= $this->clientesGraficos($moeda,$data_inicio,$data_fim);
        return $dados;
    }
    public function clientesGraficos($moeda, $data_inicio, $data_fim){
    
        $dados=  $this->topVendaCliente($moeda, $data_inicio, $data_fim);
            return $dados;

    }
//////////////////////FIM GRAFICOS CLIENTES///////////////////////////////


/////////////////////TOTAL DE VENDA//////////////////////////////////

public function vendasGrafico(){
    $totalVendas=json_decode( $this->totalVendas("AKZ", "2021-01-01", "2022-01-01"));
    $totalVendas->total= number_format($totalVendas->total,2);
        return view('vendas.vendasGraficos',compact("totalVendas"));

}
public function vendasTotal($moeda, $data_inicio, $data_fim){
    $totalVendas= json_decode(  $this->totalVendas($moeda, $data_inicio, $data_fim));
    $totalVendas->total= number_format($totalVendas->total,2);
    return json_encode(["totalVendas"=>$totalVendas]);

}
 
////////////////////FIM GRAFICOS DE VENDA/////////////////////////////

    
/////////////////////////////////GRAFICOS ARTIGOS/////////////////////////////////

public function artigoGraficosView(){  

    $dados=  $this->topVendaArtigo('AKZ', '2010-01-01', now()->format('Y-m-d'));
        return view('vendas.artigosVendidosGraficos',compact("dados"));

}

public function artigoListasView(){  

    $dado=  json_decode($this->topVendaArtigo('AKZ', '2020-01-01', now()->format('Y-m-d')));
        return view('vendas.artigosVendidosLista',compact("dado"));

}


public function artigoListasImprimir($moeda=null, $data_inicio=null, $data_fim=null){  

    if($moeda){
            $dado=  json_decode($this->topVendaArtigo($moeda, $data_inicio, $data_fim));
    }else{
        $dado=  json_decode($this->topVendaArtigo('AKZ', '2000-01-01', now()->format('Y-m-d')));
    }

        return view('impressao.artigosVendidos',compact("dado"));

}


public function artigoGraficos($moeda, $data_inicio, $data_fim){
   
    $dados= $this->topVendaArtigo($moeda, $data_inicio, $data_fim);


        return $dados;

}
//////////////////////FIM GRAFICOS ARTIGOS///////////////////////////////


    public function orderTotal($arr){
        $size = count($arr)-1;
        for ($i=0; $i<$size; $i++) {
            for ($j=0; $j<$size-$i; $j++) {
                $k = $j+1;
                if ($arr[$k]->total > $arr[$j]->total) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
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
            $facturas = new FacturaController;
            $notas_credito = new NotasCreditoController;

            $top_facturas = $facturas->topFacturaCliente($moeda, $data_inicio, $data_fim);
            $top_notas_credito = $notas_credito->topNotasCreditoCliente($moeda, $data_inicio, $data_fim);

            for ($i=0; $i < count($top_facturas); $i++) { 
                for ($j=0; $j < count($top_notas_credito); $j++) { 
                    if(strcmp($top_facturas[$i]->cliente, $top_notas_credito[$j]->cliente) == 0){
                        $top_facturas[$i]->total = (((float) $top_facturas[$i]->total) + ((float) $top_notas_credito[$j]->total));
                        break;
                    }
                    $top_facturas[$i]->total = (float) $top_facturas[$i]->total;
                }   
            }

            return response()->json($this->orderTotal($top_facturas));
        }catch(Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }


    /*Função topVendaArtigo Retorna os Artigos mais comprados com quantidades de compra e total em dinheiro das mesmas Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 09/05/2022
    */ 
    public function topVendaArtigo($moeda, $data_inicio, $data_fim){
        try{
            $factura = new FacturaController;
            $notas_credito = new NotasCreditoController;

            $top_artigo_factura = $factura->topFacturaArtigo($moeda, $data_inicio, $data_fim);
            $top_artigo_notas_credito = $notas_credito->topNotasCreditoArtigo($moeda, $data_inicio, $data_fim);

            for ($i=0; $i < count($top_artigo_factura); $i++) { 
                for ($j=0; $j < count($top_artigo_notas_credito); $j++) { 
                    if(strcmp($top_artigo_factura[$i]->artigo, $top_artigo_notas_credito[$j]->artigo) == 0){
                        $top_artigo_factura[$i]->total = (((float) $top_artigo_factura[$i]->total) + ((float) $top_artigo_notas_credito[$j]->total));
                        $top_artigo_factura[$i]->qtd = (((int) $top_artigo_factura[$i]->qtd) + ((int) $top_artigo_notas_credito[$j]->qtd));
                        break;
                    }
                    $top_artigo_factura[$i]->total = (float) $top_artigo_factura[$i]->total;
                    $top_artigo_factura[$i]->qtd = (int) $top_artigo_factura[$i]->qtd;
                }   
            }
            return response()->json($top_artigo_factura);
        }catch(Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }
    
    

    public function demandaMeses($datas){
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
        try{
            $factura = new FacturaController;
            $notas_credito = new NotasCreditoController;
    
            $total_faturas = $factura->demandaMesFactura($moeda, $data_inicio, $data_fim);
            $total_notas_credito = $notas_credito->demandaMesNotasCredito($moeda, $data_inicio, $data_fim);
    
            $faturas = $this->demandaMeses($total_faturas); // demanda por mes de facturas
            $notas_credito = $this->demandaMeses($total_notas_credito); // demanda por mes Notas de credito
           
            return response()->json($this->ajusteDemanda($faturas, $notas_credito));
        }catch (Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
        
    }


    public function distribuicaoMensalCliente($moeda, $data_inicio, $data_fim,$cliente){
        try{
            $factura = new FacturaController;
            $notas_credito = new NotasCreditoController;
    
            $total_faturas = $factura->demandaMesClienteFactura($moeda, $data_inicio, $data_fim,$cliente);
            $total_notas_credito = $notas_credito->demandaMesClienteNotasCredito($moeda, $data_inicio, $data_fim,$cliente);
    
            $faturas = $this->demandaMeses($total_faturas); // demanda por mes de facturas
            $notas_credito = $this->demandaMeses($total_notas_credito); // demanda por mes Notas de credito
           
            return response()->json($this->ajusteDemanda($faturas, $notas_credito));
        }catch (Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
    }

    public function totalFacturas($moeda, $data_inicio, $data_fim){
        try{
            $facturas = new FacturaController;
            $total_faturas = $facturas->totalFacturas($moeda, $data_inicio, $data_fim);
            return response()->json(["total"=>$total_faturas]);
        }catch (Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
        
        $notas_credito = new NotasCreditoController;

        $total_notas_credito = $notas_credito->totalNotasCredito($moeda, $data_inicio, $data_fim);
    }

    public function totalNotasCredito($moeda, $data_inicio, $data_fim){
        try{
            $notas_credito = new NotasCreditoController;
            $total_notas_credito = $notas_credito->totalNotasCredito($moeda, $data_inicio, $data_fim);
            return response()->json(["total"=>$total_notas_credito]);
        }catch (Exception $e){
            return response()->json(['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e]);
        }
        

    }
}

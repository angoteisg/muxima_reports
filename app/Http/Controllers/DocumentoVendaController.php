<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Exception;

class DocumentoVendaController extends Controller
{

    protected $documento;

    /*Função qtdDocumento() Retorna Quantidade de Facturas Emitidas no ERP Primavera
    Criado: Ricardo Neves
    Data Criação: 09/05/2022
    Ultima Modificação: 09/05/2022
    */
    public function qtdDocumento($moeda, $data_inicio, $data_fim){
        $documentos = DB::connection('sqlsrv')->select("select COUNT(*) as quantidade from CabecDoc 
            where TipoDoc = '".$this->documento."'
                and Moeda='".$moeda."' 
                and Data >='".$data_inicio."' 
                and Data <'".$data_fim."';");
        return response()->json(["quantidade" => $documentos[0]->quantidade ?? 0]);
    }


    /*Função totalDcumento Retorna o total em Dinheiro de um Documento Especifico Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 09/05/2022
    */
    public function totalDocumento($moeda, $data_inicio, $data_fim){   
        try{
            $documentos = DB::connection('sqlsrv')->select("select sum(TotalIliquido) as total from LinhasDoc where IdCabecDoc 
                in(
                    Select Id from CabecDoc where 
                    TipoDoc = '".$this->documento."'
                    and Moeda='".$moeda."' 
                    and Data >='".$data_inicio."' 
                    and Data <'".$data_fim."'
                );");
            return ($documentos[0]->total) ?? 0;
        }catch(Exception $e){
            return ["Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
    }



    /*Função topClienteDocumento Retorna o top com o nome e o somatorio do valor de compras em Dinheiro dos clientes Emitidas no ERP Primavera
    Parametros ($moeda - Indica a Moeda Na qual queremos ver o Total;
    $data_inicio e $data_fim indicam respectivamente o inicio e o fim do intervalo em Datas)
    Formato da data = 2022-04-18 - ano-mes-dia
    
    Criado: Ricardo Neves
    Data Criação: 18/04/2022
    Ultima Modificação: 18/04/2022
    */
    public function topClienteDocumento($moeda, $data_inicio, $data_fim){
        try{
            $documentos = DB::connection('sqlsrv')->select("select DOC.NomeFac as cliente, sum(LD.TotalIliquido) as total from LinhasDoc LD, CabecDoc DOC where 
                LD.IdCabecDoc = DOC.Id
                and DOC.TipoDoc='".$this->documento."'
                and DOC.Moeda = '".$moeda."' 
                and DOC.Data >= '".$data_inicio."' 
                and DOC.Data <= '".$data_fim."' 
            group by (DOC.NomeFac) order by total desc");
            
            return $documentos;
        }catch(Exception $e){
            return ['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
    }

    public function topDocumentoArtigo($moeda, $data_inicio, $data_fim){
        try{
            $documentos = DB::connection('sqlsrv')->select("select A.Descricao as artigo, sum(LD.Quantidade) as qtd, sum(TotalIliquido) as total 
            from LinhasDoc LD, Artigo A, CabecDoc FA 
                where A.Artigo = LD.Artigo 
                    and FA.Id = LD.IdCabecDoc 
                    and FA.TipoDoc = '".$this->documento."'
                    and FA.Moeda='".$moeda."' 
                    and FA.DataGravacao >='".$data_inicio."' 
                    and FA.DataGravacao <'".$data_fim."' 
                group by (A.Descricao) 
            order by total desc;");
            return $documentos;
        }catch (Exception $e){
            return ["Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
    }

    
    public function totalPorData($moeda, $data_inicio, $data_fim,$cliente){
        try{
            $documentos = DB::connection('sqlsrv')->select("select sum(PrecoLiquido) as total, Data as dt
            from LinhasDoc 
            where IdCabecDoc in 
                (select Id from CabecDoc 
                    where Moeda = '".$moeda."' 
                        and TipoDoc = '".$this->documento."'
                        ".(($cliente != NULL)? " and Nome like '%".$cliente."%' " : "")."
                ) 
                and Artigo <> 'NULL' 
                and Data >= '".$data_inicio."'
                and Data <= '".$data_fim."'
                group by Data
            ");
            return $documentos;

        }catch(Exception $e){
            return ['msg' => "Conexão Não Estabelecidade com a Base de Dados",'Erros'=>$e];
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotasCreditoController extends DocumentoVendaController
{
    function __construct(){
        $this->documento = 'NC';
    }

    public function qtdNotasCredito($moeda, $data_inicio, $data_fim){
        return parent::qtdDocumento($moeda, $data_inicio, $data_fim);
    }

    public function totalNotasCredito($moeda, $data_inicio, $data_fim){
        return parent::totalDocumento($moeda, $data_inicio, $data_fim);
    }

    public function topNotasCreditoCliente($moeda, $data_inicio, $data_fim){
        return parent::topClienteDocumento($moeda, $data_inicio, $data_fim);
    }

    public function topNotasCreditoArtigo($moeda, $data_inicio, $data_fim){
        return parent::topDocumentoArtigo($moeda, $data_inicio, $data_fim);
    }

    public function demandaMesNotasCredito($moeda, $data_inicio, $data_fim){
        return parent::totalPorData($moeda, $data_inicio, $data_fim,null);
    }

    public function demandaMesClienteNotasCredito($moeda, $data_inicio, $data_fim,$cliente){
        return parent::totalPorData($moeda, $data_inicio, $data_fim,$cliente);
    }
}

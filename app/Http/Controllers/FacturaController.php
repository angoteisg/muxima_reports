<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacturaController extends DocumentoVendaController
{

    function __construct(){
        $this->documento = 'FA';
    }

    public function qtdFacturas($moeda, $data_inicio, $data_fim){
        return parent::qtdDocumento($moeda, $data_inicio, $data_fim);
    }

    public function totalFacturas($moeda, $data_inicio, $data_fim){
        return parent::totalDocumento($moeda, $data_inicio, $data_fim);
    }

    public function topFacturaCliente($moeda, $data_inicio, $data_fim){
        return parent::topClienteDocumento($moeda, $data_inicio, $data_fim);
    }

    public function topFacturaArtigo($moeda, $data_inicio, $data_fim){
        return parent::topDocumentoArtigo($moeda, $data_inicio, $data_fim);
    }

    public function demandaMesFactura($moeda, $data_inicio, $data_fim){
        return parent::totalPorData($moeda, $data_inicio, $data_fim,null);
    }

    public function demandaMesClienteFactura($moeda, $data_inicio, $data_fim,$cliente){
        return parent::totalPorData($moeda, $data_inicio, $data_fim,$cliente);
    }
}

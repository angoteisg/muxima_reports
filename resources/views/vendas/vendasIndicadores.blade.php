@extends('layouts.app')
@section('content')

  
  <!-- right col -->
  <input type="hidden" name="" id="funcao" value=3>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Indicadores de Vendas
        <small>Geral</small>
       
      </h1>
      <ol class="breadcrumb">
        <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-primary btn-sm" id="gerarPDF" ><i class="fa fa-fw fa-print"></i></a>
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-fw fa-filter"></i>      </a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
     
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Vendas</a></li>
        <li class="active"> <a href="{{ route('artigos.vendasIndicadores') }}"> Vendas <small class="label pull-right" style="color:magenta;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Geral</font></font></small> </a></li>
 
      </ol>
    </section>

  

     
    <section class="content">
      <div class="row">
          <div class="col-lg-3 col-xs-6" >
            <!-- small box -->
            <div class="small-box bg-aqua fontes" >
              <div class="inner"> 
              
                  <h3 style="width:100%" id="totalVendas">{{ $totalVendas->total }}</h3>
    
                  <p>Vendas</p>
               
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6 fontes">
            <!-- small box -->
            <div class="small-box bg-green ">
              <div class="inner">
                <h3  id="totalNotasCredito">{{ $totalNotasCredito->quantidade }}</h3>
  
                <p>Notas de Crédito (qtd)</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{ $totalVendas->total }}</h3>
  
                <p>Outro</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>65</h3>
  
                <p>Outro</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
  <section>
        
    {{--<div class=" box box-default " style="width:49%; float: right;"  >
      <div class="box-header with-border"   >
         
           <br>
           <ol  style="float: right"> 
             <span class="label  bg-green"> <b> Filtros</b>       </span>  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
           <select name="moeda" id="moeda" onchange="filtro()">
             <option disabled">Moeda</option>
             <option selected value="AKZ">Kwanza</option>
             <option value="EUR">Euro</option>
             <option value="USD">Dolar</option>
           </select>
           <label for="data_inicio" > Inicio   </label>
        <input type="date" value="2021-01-01" id="data_inicio"  onchange="filtro()">
     
       
       <label for="data_fim" >Fim</label>
         <input type="date" value="2022-01-01" id="data_fim" onchange="filtro()">
       </ol>
     </div>
     
     </div>--}}
     <br>
     <br>
     <br>
     <br>
     <br>
     <p>  <h1 style="color: red"><center><p>OUTROS GRÁFICOS DE OUTROS INDICADORES</p></center></h1>
  </p>
    {{--<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->--}}





    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Filtro</h4>
          </div>
          <div class="modal-body">
                    <ol class="form-inline"  style="margin:0 auto" width="auto"> 
                  <label for="moeda">Moeda:</label>
                    <select class="form-control" name="moeda" id="moeda" >
                    
                      <option selected value="AKZ">Kwanza</option>
                      <option value="EUR">Euro</option>
                      <option value="USD">Dolar</option>
                    </select>
                    <label for="data_inicio">Inicio:</label>
                <input type="date" class="form-control" value="2021-01-01" id="data_inicio"  >
              
                
                <label for="data_fim">Fim:</label>
                  <input type="date" class="form-control" value="2022-01-01" id="data_fim" >
                </ol>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="filtro()">Submeter</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

  @endsection
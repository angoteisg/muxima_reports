@extends('layouts.app')
@section('content')

  
  <!-- right col -->
  <input type="hidden" name="" id="funcao" value=2>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Artigos mais Vendidos
        <small>Top 5</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Vendas</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosVendidosGraficos') }}"> Artigos mais Vendidos <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Top 5</font></font></small> </a></li>
 
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
     
      <div class="row">
        <div class="col-md-6">
         {{--<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafico de Area</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart" id="areaCharts">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>--}}
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico de Pizza</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" id="pieCharts">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
         {{-- <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico de Linha</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart" id="lineCharts">
                <canvas id="lineChart" style="height:250px" ></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->--}}

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico de Barra</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart" id="barCharts">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->


          </div>

              
    <div class=" box box-default "  >
      <div class="box-header with-border"   >
         
           <br>
           <ol  style="float: right" width="auto"> 
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
         <input type="date" value="2022-01-01" id="data_fim" onchange="filtro()">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
         <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-primary btn-sm" id="gerarPDF" >Gerar PDF</a>
 
       </ol>
     </div>
     
     </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  @endsection
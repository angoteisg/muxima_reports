@extends('layouts.app')


@section('content')
<input type="hidden" name="" id="funcao" value=2>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Página Inicial
      
     
    </h1>
    <ol class="breadcrumb">
      <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Página Inicial</a></li>
     
    </ol>
  </section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $totalVendas->quantidade }}</h3>

              <p>Vendas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('artigos.artigosVendidosGraficos') }}" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $totalArtigos->quantidade }}<sup style="font-size: 20px"></sup></h3>

              <p>Artigos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('artigos.artigosDisponiveisGraficos') }}" class="small-box-footer">Ver mais <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>

              <p>Fornecedores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a  class="small-box-footer"> <i class="fa fa-bullseye"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $clientes }}</h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('artigos.clientesGraficos') }}" class="small-box-footer">Ver mais... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
<section>
{{-- <center><h1>BEMVINDOAuth::user()->name}}</h1></center>--}}
</section>
<div class="row">
  <div class="col-md-12">
    <div class="box box-success ">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-fw  fa-money"></i> Dashboard</h3>

        <div class="box-tools pull-right">
{{--
         <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-default"><i class="fa fa-fw fa-file-pdf-o"> </i>PDF</a>
        --}}
        
               
                
               
                
               
         
        </div>
        <br>
        <p></p>
      </div>
     
      <!-- /.box-body -->


    </div>
  </div>
</div>
<section class="content" >
     
  <div class="row" >

    <!-- /.col (LEFT) -->
    <div class="col-md-6">
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

    </div>
    <div class="col-md-6">


      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfico de Barra</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
   
          
      
      
          <div class="box-body" id="pieCharts">
            <canvas id="pieChart" style="height:300px"></canvas>
          </div>
   
        <!-- /.box-body -->


      </div>
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
   



     {{-- <div class="box box-danger" styzzzz>
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
      </div>--}}

          

      <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
  </div>
  <!-- /.row -->

</section>
@endSection
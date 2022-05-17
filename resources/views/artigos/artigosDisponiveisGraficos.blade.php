@extends('layouts.app')
@section('content')

@php
$artigos= json_decode($dados);
$n=0;
@endphp
  <!-- right col -->
<input type="hidden" id="funcao" value=5>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Artigos Disponiveis
        <small>Top 5</small>
 
      </h1>
      <ol class="breadcrumb">

        <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-primary btn-sm" id="gerarPDF" ><i class="fa fa-fw fa-print"></i></a>
        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
       
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Artigos</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosDisponiveisGraficos') }}"> Artigos Disponiveis <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Top 5</font></font></small> </a></li>
 
      </ol>
    </section>
 
    <!-- Main content -->
    <br>
  
    <br><br>
  
     <!-- Main content -->
     <section class="content" >
     
      <div class="row" >
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
         
          <!-- /.box -->

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Artigos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Descrição</th>
                  <th>Stock</th>
             
                </tr>
                </thead>
                <tbody>
                  @foreach($artigos as $artigo)
                <tr>
                  <td>{{ $n=$n+1 }}</td>
                  <td>{{ $artigo->descricao }}</td>
                  <td>{{ number_format($artigo->stock) }} </td>
                </tr>
                @endforeach
                </tbody>
               
              </table>
            </div>
          </div>

       
        </div>
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
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Filtro</h4>
        </div>
        <div class="modal-body">
                  <ol  style="margin:0 auto" width="auto"> 
                
                  <select name="moeda" id="moeda" >
                    <option disabled">Moeda</option>
                    <option selected value="AKZ">Kwanza</option>
                    <option value="EUR">Euro</option>
                    <option value="USD">Dolar</option>
                  </select>
                  <label for="data_inicio" > Inicio   </label>
              <input type="date" value="2021-01-01" id="data_inicio"  >
            
              
              <label for="data_fim" >Fim</label>
                <input type="date" value="2022-01-01" id="data_fim" >
              </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="filtro()">Submeter</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.content -->

  </div>

  @endsection
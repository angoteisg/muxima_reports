@extends('layouts.app')
@section('content')

@php
  $artigos= json_decode($dados);
  $n=0;
@endphp
  
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
        <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-primary btn-sm" id="gerarPDF" ><i class="fa fa-fw fa-print"></i></a>
 
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-fw fa-filter"></i>      </a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Vendas</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosVendidosGraficos') }}"> Artigos mais Vendidos <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Top 5</font></font></small> </a></li>
 
      </ol>
    </section>

    <br>
    <br>
    <br>
    
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
               {{-- <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Quantidade</th>
                  <th>Total</th>
                
                </tr>
                </thead>
                <tbody>
                  @foreach($artigos as $dado)
                <tr>
                 
                    
               
                  <td>{{ $n=$n+1 }}</td>
                  <td>{{ $dado->artigo }} </td>
                  <th>{{ $dado->qtd }}</th>
                  <td>{{ number_format($dado->total,2) }}</td>
             
                </tr>
                @endforeach
                </tbody>--}}
               
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
              <br><br><br><br>
              <div class="box-header with-border">
                <h3 class="box-title">Gráfico de Pizza</h3>
              </div>
              <div class="box-body" id="pieCharts">
                <canvas id="pieChart" style="height:300px"></canvas>
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
  @endsection
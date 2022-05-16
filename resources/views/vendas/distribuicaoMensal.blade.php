@extends('layouts.app')
@section('content')

@php
  $meses= json_decode($dados);
  $n=0;
  $mes= [1=>"Janeiro",2=>"Fevereiro",3=>"Março",4=>"Abril",5=>"Maio",6=>"Junho",7=>"Julho",8=>"Agosto",9=>"Setembro",10=>"Outubro",11=>"Novembro",12=>"Dezembro"];
@endphp
  
  <!-- right col -->
  <input type="hidden" name="" id="funcao" value=6>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Distribuição Mensal
        <small>Vendas</small>
      </h1>
      <ol class="breadcrumb">
        <a href="{{ route('artigos.artigosVendidosListasImprimir',['AKZ','2021-01-01','2022-01-01']) }}" class="btn btn-primary btn-sm" id="gerarPDF" ><i class="fa fa-fw fa-print"></i></a>
 
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-fw fa-filter"></i>      </a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Vendas</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosVendidosGraficos') }}"> Distribuição Mensal <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Meses</font></font></small> </a></li>
 
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
                <thead>
                <tr>
                  <th>#</th>
                  <th>Meses</th>
           
                  <th>Total</th>
                
                </tr>
                </thead>
                <tbody id="corpo">
                  @foreach($meses as $meses)
                    
           
                <tr>
                 
                    
               
                  <td>{{ $n=$n+1 }}</td>
                  <td>{{ $mes[$n] }}</td>
                  <td>{{ number_format($meses,2)}} </td>
                 
             
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
              <input type="date" class="form-control"  id="data_inicio"  >
            
              
              <label for="data_fim">Fim:</label>
                <input type="date" class="form-control"  id="data_fim" >

                <label for="ano">Ano:</label>
                <select name="ano" class="form-control" id="ano">
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2022">2022</option>

                </select>
               
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
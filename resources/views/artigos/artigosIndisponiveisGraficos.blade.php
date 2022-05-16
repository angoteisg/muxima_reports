@extends('layouts.app')
@section('content')

  
  <!-- right col -->
  <input type="hidden" id="funcao" value=6>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Artigos Indisponiveis
        <small>Top 5</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Artigos</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosIndisponiveisGraficos') }}"> Artigos Indisponiveis <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Top 5</font></font></small> </a></li>
 
      </ol>
    </section>
 <br>
    <!-- Main content -->
    <div class="col-md-12">
      <div class="box box-success">
           
            <div class="box-body">
             Neste gráfico apresentamos o top 5 dos artigos disponiveis.
      
             <a href="" class="btn btn-primary" style="float: right">Imprimir</a> 
             <br>
             <br>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
        

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico de Donut</h3>

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
    <!-- /.content -->
  </div>

  @endsection
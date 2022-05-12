@extends('layouts.app')
@section('content')
@php
  $n= 0;
@endphp
  
  <!-- right col -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de Clientes 
        <small>Vendas</small>
      </h1>
      <ol class="breadcrumb">
       
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Vendas</a></li>
        <li class="active"> <a href="{{ route('vendas.vendasLista') }}"> Lista de Clientes <small class="label pull-right" style="color: green;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lista</font></font></small> </a></li>
 
      </ol>
    </section>

   <!-- Main content -->
   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        
                 

        <div class="box">
          <div class="box-header">   
          <a href="{{ route('artigos.artigosVendidosListasImprimir')}}" class="btn btn-primary" style="float: right">Imprimir</a> 
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Total</th>
              
              </tr>
              </thead>
              <tbody>
                @foreach($dado as $dado)
              <tr>
               
                  
             
                <td>{{ $n=$n+1 }}</td>
                <td>{{ $dado->artigo }} </td>
                <th>{{ $dado->quantidade }}</th>
                <td>{{ number_format($dado->total,2) }}</td>
           
              </tr>
              @endforeach
              </tbody>
             
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
  </div>

  @endsection
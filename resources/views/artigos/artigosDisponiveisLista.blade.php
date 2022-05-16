@extends('layouts.app')
@section('content')
@php
  $n=0;
@endphp
  
  <!-- right col -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Artigos Disponiveis
        <small>Lista</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-dashboard"></i>  Página Inicial</a></li>
        <li><a href="#">Artigos</a></li>
        <li class="active"> <a href="{{ route('artigos.artigosDisponiveisLista') }}"> Artigos Disponiveis <small class="label pull-right" style="color: orange;"> <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lista</font></font></small> </a></li>
 
      </ol>
    </section>

   <!-- Main content -->
   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        
                 

        <div class="box">
          <div class="box-header">
            <a href="" class="btn btn-primary" style="float: right">Imprimir</a> 
          </div>
          <!-- /.box-header -->
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
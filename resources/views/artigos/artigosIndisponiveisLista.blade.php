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
        Lista de Artigos Disponiveis
        <small>Artigos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

   <!-- Main content -->
   <section class="content">
    <div class="row">
      <div class="col-xs-12">
        
                 

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
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
                <td>{{ number_format($artigo->stock,0) }} </td>
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
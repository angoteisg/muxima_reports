@extends('pdf.include.layout_vertical',['titulo'=>"Vendas à Clientes"])


@section('titulo')
    Muxima - Resports
@endsection

@section('content')

    <h2  style="text-align: center; margin-top: 50px;  margin-bottom: 50px; "><u>Vendas à Clientes</u></h2>
    <p> <b>Moeda:</b> {{ $moeda }}&nbsp;  <b>Inicio:</b> {{ $data_inicio }} &nbsp; <b>Fim:</b> {{ $data_fim }}</p>
    <table class="principal">
        <tr class="cabeca">
            <td  style="text-align: left; position: sticky;" width="20">Nº</td>
            <td width="" style="text-align: left;">Nome</td>
     
            <td style="text-align: left;" width="">Total</td>
        </tr>

        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $cliente->cliente }}</td>
                <td style="text-align: left;">{{ number_format($cliente->total,2) }}</td>
            </tr>
        @endforeach 
    </table>

@endsection

@section('footer')
@endsection
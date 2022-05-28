@extends('pdf.include.layout_vertical',['titulo'=>"Distribuição Mensal/ $cliente"])


@section('titulo')
    Muxima - Resports
@endsection

@section('content')


    <h2  style="text-align: center; margin-top: 50px;  margin-bottom: 50px; "><u>Distribuição Mensal</u></h2>
    <p> <b>Moeda:</b> {{ $moeda }}&nbsp;  <b>Inicio:</b> {{ $data_inicio }} &nbsp; <b>Fim:</b> {{ $data_fim }}</p>
    <p><b>Cliente:</b> {{ $cliente }}</p>
    <table class="principal">
        <tr class="cabeca">
            <td  style="text-align: left; position: sticky;" width="20">Nº</td>
            <td width="" style="text-align: left;">Mes</td>
            <td style="text-align: left;" width="">Total</td>
        </tr>

        @foreach($distribuicao as $distribuicao)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $mes[$loop->iteration] }}</td>
                
                <td style="text-align: left;">{{number_format($distribuicao,2) }}</td>
            </tr>
        @endforeach 
    </table>

@endsection

@section('footer')
@endsection
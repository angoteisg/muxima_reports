@extends('pdf.include.layout_vertical',['titulo'=>"Artigos Disponiveis"])


@section('titulo')
    Muxima - Resports
@endsection

@section('content')

    <h2  style="text-align: center; margin-top: 50px;  margin-bottom: 50px; "><u>Artigos Disponiveis</u></h2>

    <table class="principal">
        <tr class="cabeca">
            <td  style="text-align: left; position: sticky;" width="20">Nº</td>
            <td width="" style="text-align: left;">Artigo</td>
            <td style="text-align: left;" width="">Stock</td>
        </tr>

        @foreach($artigos as $artigo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $artigo->descricao }}</td>
                <td style="text-align: left;">{{ number_format($artigo->stock) }}</td>
            </tr>
        @endforeach 
    </table>

@endsection

@section('footer')
@endsection
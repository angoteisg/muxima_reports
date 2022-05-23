@extends('pdf.include.layout_vertical')


@section('titulo')
    Muxima - Resports
@endsection

@section('content')

    <h2  style="text-align: center; margin-top: 50px;  margin-bottom: 50px; "><u>Artigos Indisponivel</u></h2>

    <table class="principal">
        <tr class="cabeca">
            <td  style="text-align: center; position: sticky;" width="20">Nº</td>
            <td width="150" style="text-align: left;">Artigo</td>
            <td style="text-align: left;" width="70">Stock</td>
        </tr>

        @foreach($artigos as $artigo)
            <tr>
              
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $artigo->descricao }}</td>
                <td style="text-align: left;">{{ $artigo->stock }}</td>
            </tr>
        @endforeach 
    </table>

@endsection

@section('footer')
@endsection
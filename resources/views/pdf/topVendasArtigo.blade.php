@extends('pdf.include.layout_vertical')


@section('titulo')
    Muxima - Resports
@endsection

@section('content')

    <h2  style="text-align: center; margin-top: 50px;  margin-bottom: 50px; "><u>Top Vendas Artigo</u></h2>

    <table class="principal">
        <tr class="cabeca">
            <td  style="text-align: left; position: sticky;" width="20">Nº</td>
            <td width="" style="text-align: left;">Artigo</td>
            <td style="text-align: left;" width="">Quantidade</td>
            <td style="text-align: left;" width="">Total</td>
        </tr>

        @foreach($artigosMaisComprados as $artigo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $artigo->artigo }}</td>
                <td style="text-align: left;">{{ $artigo->qtd }}</td>
                <td style="text-align: left;">{{ $artigo->total }}</td>
            </tr>
        @endforeach 
    </table>

@endsection

@section('footer')
@endsection
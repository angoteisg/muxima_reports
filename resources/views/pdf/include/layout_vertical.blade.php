<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Relatório</title>
		<link rel="icon" href="{{ asset('storage/imagem/iconRel.png')}}">
		<style type="text/css">
			
			html, body {
                 height: 100%;
           	}
		
			footer {
				width: 100%;
                position: fixed;
                bottom: 0;
                left: 0;
			}
	
			td {
				border: 2px solid black; 
				padding: 5px;/*5px*/
			}
			.principal {
				text-align: center;
				border-collapse: collapse;
				width: 100%;/*1500px*/
				border: 0px;
				page-break-inside: auto;
			}
			.cabeca {
				background-color: #c5c5c5;;
				color: black;
				}
			body {
				font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
			}
			body {
				background: url("imagens/marca_dagua02.png");
				background-repeat: no-repeat; 
				background-position: 50% 60%;
				background-size: 400px;
			}
			
			
		</style>
		@yield('css_style')
	</head>
 
	<body>
		<div style="margin-top: -20px; ">
			<img src="{{public_path("/imagens/banner_report03.png")}}" width="700" height="120">
		</div>
		<br>
		@yield('content')


		<script type="text/php">
			if ( isset($pdf) ) {
		
				$font = $fontMetrics->get_font("helvetica", "bold");
       
        		$pdf->page_text(490, 775, "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, 10,  array(0,0,0)); 
			} 
		</script>

		
		
		@yield('footer') 
		<footer>

			<hr>
			<div style="float: left; font-family: Arial Narrow, sans-serif  ">|<small> Muxima - Reports</small> </div>
					@php
					$nome = explode(" ", Auth::user()->name);
					$cont = count($nome); 
					$nome = $cont==1 ? $nome[0] : $nome[0]." ".$nome[$cont-1];
				@endphp
			<div style="margin-left:  300px; font-family: Arial Narrow, sans-serif "><small>  Utilizador : {{$nome}} ,  &nbsp; {{date('d-m-Y')}} - Processado por compudador </small></div>
		</footer>
	</body>
</html> 
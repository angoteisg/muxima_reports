<script>
 
   @empty($labels) 
      var descricao = ["Não foram encontrados dados para serem exibidos"]
      var quantidade= "[0]"
    @else
      var descricao = {!! $labels !!}
      var quantidade= {!! $data !!}
   @endempty
   var areaChartData = {
      labels  : descricao,
      datasets: [
        {
          label               : 'Artigos',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : quantidade
        },
       
      ]
    }

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      // This will get the first returned node in the jQuery collection.
      var areaChart       = new Chart(areaChartCanvas)

   // var cores = ['#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc','#d2d6de','#000080','#00BFFF','#4682B4','#008080','#00FF7F','#2E8B57']
    function grafico() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
  
      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
  
  
      
  
      var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale               : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - Whether the line is curved between points
        bezierCurve             : true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot                : false,
        //Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive              : true
      }
  
      //Create the line chart
      areaChart.Line(areaChartData, areaChartOptions)
  
      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
      var lineChart                = new Chart(lineChartCanvas)
      var lineChartOptions         = areaChartOptions
      lineChartOptions.datasetFill = false
      lineChart.Line(areaChartData, lineChartOptions)
  
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieChart       = new Chart(pieChartCanvas)
      var PieData=[]
      for(let i=0; i<descricao.length;i++){
        var cor = Math.floor(Math.random()*16777215).toString(16);
            PieData.push( 
              {
                value    : quantidade[i],
                color    : '#'+cor,
                highlight: '#'+cor,
                label    : descricao[i]
              }
              );
    }
      var pieOptions     = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps       : 100,
        //String - Animation easing effect
        animationEasing      : 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive           : true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio  : true,
        //String - A legend template
        legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions)
  
      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
      var barChart                         = new Chart(barChartCanvas)
      var barChartData                     = areaChartData
      barChartData.datasets[0].fillColor   = '#00a65a'
    barChartData.datasets[0].strokeColor = '#00a65a'
    barChartData.datasets[0].pointColor  = '#00a65a'
      var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
      }
  
      barChartOptions.datasetFill = true
      barChart.Bar(barChartData, barChartOptions)
    }
$(document).ready(function(){

  grafico();
})
    function filtro(){

      var inicio = $("#data_inicio").val()
      var fim = $("#data_fim").val()
      var moeda = $("#moeda").val()
      var funcao = $("#funcao").val()
//console.log(inicio+"/"+fim+"/"+moeda)
      if(funcao==1){
        var caminho= "{{ route('vendas.clientesGraficos',["moeda","inicio","fim"]) }}";
      }else if(funcao==2){
        var caminho= "{{ route('vendas.artigoGraficos',["moeda","inicio","fim"]) }}";
      }else{

      }
      
     // caminho = caminho.replace('funcao',funcao);
      caminho = caminho.replace('moeda',moeda);
      caminho = caminho.replace('inicio',inicio);
      caminho = caminho.replace('fim',fim);
      $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
                     $.ajax({
                         
                   method:"GET",
                   enctype: 'multipart/form-data',
                   url: caminho,
                   data:{
                   moeda:moeda, 
                   data_inicio:inicio, 
                   data_fim:fim, 
                   },
                   headers:{
                   'Accept':'application/json',
                   'Content-Type':'application/json'
                   },
                   success:function(data){
                    valor= JSON.parse(data)
                       console.log(valor)
                      
                       if(valor.labels.length==0){
                        areaChartData.labels= ["nada"]
                       areaChartData.datasets.data= [0]
                     
                       }else{
                        areaChartData.labels= data.labels
                       areaChartData.datasets.data= data.data
                       }
                      grafico();
                      console.log(areaChartData.labels)
                          
       
                   }
      
  
         })
    }
  </script>
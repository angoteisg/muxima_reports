<script>

var lineChart
var barChart   
var pieChart 
var areaChart
var lineChartCanvas  


function grafico(descricao,quantidade){
    var cor=[]
    for(let i=0; i<descricao.length;i++){
         cor.push('#'+Math.floor(Math.random()*16777215).toString(16));
           
            
    }

//console.log(cor)
    var dados= {
    type: 'doughnut',
    data: {
        labels: descricao,
        datasets: [{
            label: '# of Votes',
            data: quantidade,
            backgroundColor: cor,
            borderColor: cor,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }}
 
const ctx = document.getElementById('barChart').getContext('2d');
//var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      // This will get the first returned node in the jQuery collection.
     // dados.type='area'
    // const areaChart       = new Chart(areaChartCanvas,dados)

      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      dados.type='pie'
      pieChart       = new Chart(pieChartCanvas,dados)


 

     var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
     dados.type='bar'
      barChart                         = new Chart(barChartCanvas,dados)




//const myChart = new Chart(ctx, dados);

//myChart.clear()


////////////////////////////Line Chart///////////////////////////////
const data = {
  labels: descricao,
  datasets: [
    {
      label: 'Dataset',
      data:quantidade ,
      borderColor: cor[0],
      backgroundColor: cor[0],
      pointStyle: 'circle',
      pointRadius: 7,
      pointHoverRadius: 10
    }
  ]
};
const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
      }
    }
  }
};


 lineChartCanvas          = document.getElementById('lineChart').getContext('2d')
    

 lineChart                = new Chart(lineChartCanvas,config)





//////////////////Area chart////////////////////////////////////////

}
   





$(document).ready(function(){ 
  
  @isset($dados)
 var dados= {!! $dados !!}

 var desc =[]
 var num = []
var descricao
var quantidade


 for(let i=0; i<dados.length;i++){
   

   if($("#funcao").val()==4){
    total.push(dados[i].total)
    desc.push(dados[i].cliente.substr(0,10))

   }
   if($("#funcao").val()==5){
    desc.push(dados[i].descricao.substr(0,10))
    num.push(dados[i].stock)
   }

   if($("#funcao").val()==1){
    desc.push(dados[i].cliente.substr(0,10))
    num.push(dados[i].total)
   }

   if($("#funcao").val()==2){
    desc.push(dados[i].artigo.substr(0,20))
    num.push(dados[i].quantidade)
   }
   
 }


   @empty($dados) 
       descricao = ["Não foram encontrados dados para serem exibidos"]
       quantidade= [0]
    @else
   
      descricao = desc.slice(0,5)
     quantidade= num.slice(0,5)
   @endempty
   @endisset
   if($("#funcao").val()==4){
    descricao = desc.slice(0,-5)
     quantidade= qtd.slice(0,-5)
   }


 // var funcao = $("#funcao").val()


      grafico(descricao,quantidade);
  

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
      }else if(funcao==3){
        var caminho= "{{ route('vendas',["moeda","inicio","fim"]) }}";
      }
      console.log(fim)
      console.log(inicio)
      console.log(moeda)
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
                    var valor= JSON.parse(data)
                     //  console.log(valor)
                    var desc=[]
                    var total=[]
                    var num = []
                    var funcao = $("#funcao").val()
                      if(Object.keys(data).length==0){
                        areaChartData.labels= ["Não Foi encontrado nenhum dado para este periodo"]
                        areaChartData.datasets.data= [0]
                      }

                      console.log(valor)

                
                      for(let i=0; i<valor.length;i++){
                        
                      //  console.log(valor[i]."artigo")
                              if(funcao==4){
                                total.push(valor[i].total)
                                desc.push(valor[i].cliente.substr(0,10))


                              }
                              if(funcao==5){
                                desc.push(valor[i].descricao.substr(0,10))
                                num.push(valor[i].stock)
                              }

                              if(funcao==1){
                                desc.push(valor[i].cliente.substr(0,10))
                                num.push(valor[i].total)
                              }

                              if(funcao==2){
                              
                                desc.push(valor[i].artigo.substr(0,10))
                                num.push(valor[i].quantidade)
                              }
                              
                      }
                    
                     
                           


                   /*   if(funcao!=3){
                      
                            
                                areaChartData.labels= data.labels
                              areaChartData.datasets.data= data.data
                              
                      }*/
                      
                      
                      if(funcao==3){

                        $('#totalVendas').empty()
                          $('#totalVendas').append(valor.totalVendas.total)

                      }else{
                        
                       lineChart.destroy()
                      $("#lineChart").remove()
                       $("#lineCharts").html(`<canvas id="lineChart" style="height:250px" ></canvas>`)
                      // lineChart.render()
                       barChart.destroy() 
                       $("#barChart").remove()
                       $("#barCharts").html(`<canvas id="barChart" style="height:250px" ></canvas>`)
                       pieChart.destroy()
                       $("#pieChart").remove()
                       $("#pieCharts").html(`<canvas id="pieChart" style="height:250px" ></canvas>`) 
                      grafico(desc.slice(0,5),num.slice(0,5));

                      }
                    
                      
                      
                    //  console.log(areaChartData.labels)
                          
       
                   }
      
  
         })


        }
















  </script>
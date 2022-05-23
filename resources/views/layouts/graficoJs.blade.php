<script>

var lineChart
var barChart   
var pieChart 
var areaChart
var lineChartCanvas  

var mes= ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"]
var n=0
var me= {"1":"Janeiro","2":"Fevereiro","3":"Março","4":"Abril","5":"Maio","6":"Junho","7":"Julho","8":"Agosto","9":"Setembro","10":"Outubro","11":"Novembro","12":"Dezembro"}
var colunaDistribuicaoMensal =[
  { title: '#' },
  { title: 'Meses' },
  { title: 'Total' }]

var colunasArtigosVendidos= [   
  {title:'#'},
  {title:'Nome'},
  {title:'Quantidade'},
  {title:'Total'}]

  var colunasClientesGrafico= [   
  {title:'#'},
  {title:'Nome',"render": function(data, type, row, meta){
            if(type === 'display'){
                data = `<a style="text-decoration: none;" onclick="distribuicao('`+ data +`' )"> `+ data +` </a>`;
            }

            return data;
         }},
  {title:'Total em Compras'}]

  var colunasArtigos= [    
  {title:'#'},
  {title:'Descrição'},
  {title:'Stock'}
]


var dataSet = [];
var tabela




function estruturaDataTable(coluna){
  var estrutura ={columns:coluna,
   
              lengthMenu: [
                      [5,10, 25, 50, -1],
                      [5,10, 25, 50, 'Todos'],
                  ],
                 'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registos",
        "sZeroRecords":   "Nenhum resultado encontrado",
        "sEmptyTable":    "Nenhum dado disponivel nesta",
        "sInfo":          "Registo de _START_ à _END_ de um total de _TOTAL_ registos",
        "sInfoEmpty":     "Registo de 0 à 0 de um total de 0 registos",
        "sInfoFiltered":  "(filtrado de um total de _MAX_ registos)",
        "sInfoPostFix":   "",
        "sSearch":        "Procure:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Carregando...",
        "searchPlaceholder": "",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Seguinte",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar a coluna de maneira ascendente",
            "sSortDescending": ": Activar para ordenar a coluna de maneira descendente"
        }
    } 
      
              } 

                return estrutura
}





         if($("#funcao").val()==4){
  
        //  tabela=  $('#example1').DataTable(estruturaDataTable(colunaDistribuicaoMensal));
   }
   if($("#funcao").val()==5){
    tabela=  $('#example1').DataTable(estruturaDataTable(colunasArtigos));
 
   }

   if($("#funcao").val()==1){
    tabela=  $('#example1').DataTable(estruturaDataTable(colunasClientesGrafico));
   }

   if($("#funcao").val()==2){
  
    tabela=  $('#example1').DataTable(estruturaDataTable(colunasArtigosVendidos));
   }

   if($("#funcao").val()==6){
    tabela=  $('#example1').DataTable(estruturaDataTable(colunaDistribuicaoMensal));

          
    }




function constroiDataSet(dados,funcao){

  var dataSet = []

    if(funcao==1){
          for( j in dados){
        n=n+1
              dataSet.push([n,dados[j].cliente,new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'AKZ' }).format(dados[j].total)])



          }
  }
  
  
  if(funcao==2){
    for( j in dados){
        n=n+1
              dataSet.push([n,dados[j].artigo,dados[j].qtd,new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'AKZ' }).format(dados[j].total)])



          }
  }
  if(funcao==5){
    for( j in dados){
        n=n+1
              dataSet.push([n,dados[j].descricao,new Intl.NumberFormat().format(dados[j].stock)])



          
          }
  }

  if(funcao==6){
    for( j in dados){
        n=n+1
              dataSet.push([n,me[j],new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'AKZ' }).format(dados[j])])



          }
  }

  return  dataSet
}










         


function cortarNome(nome){

  ajuda= nome.split(" ")
  abreviado = ajuda[0]+" "
  
  for(let i=1; i<ajuda.length;i++){
    abreviado= abreviado+ajuda[i].substr(0,1).toUpperCase()
  }

return abreviado

}

function grafico(descricao,quantidade){

    var cor=["#5059d7","#f39b01","#2bc3c8","#36a611","#c5daf2","#8c766e","#513309","#359533","#489848","#fa4bb0","#6e39a1","#af927d","#160719","#66ad5f","#96dc0","#caf1e0","#fe6459","#47aca8","#ca63f2","#d90401","#ca8a48","#4029e","#2fcef9","#51d938","#379890","#aea4fe","#66fa9b","#d6659","#f99132","#64b390","#fbae77","#4d64ab","#21f983","#d08dda","#66b6e2","#7bc66d","#bb084","#7109e7","#66ed49","#69316","#d8bca2","#d67ea1","#19c368","#4247ae","#48df09","#e3ccfa","#2b7fd0","#c312b9","#12234d","#7b338e","#25c0c8","#67d6f0","#aba81f","#a9b39","#e7fcd5","#34c431","#52982a","#8f4f03","#34ba6f","#9d9ec1","#4298f1","#61627b","#2388e7","#4272cb","#80e67e","#e33d9","#14110d","#773d36","#b882f6","#3060cd","#ad7c7b","#6bdd1d","#b64f3a","#e2700d","#32e4e","#321431","#201b16","#6c951e","#6cf76b","#2d2048","#e9caca","#d7685b","#e50234","#c3b4d1","#27da3d","#312205","#862b16","#5647df","#d9fb99","#145093","#608d2a","#7239f3","#2aa95e","#78ba5b","#f0423a","#e023e","#f3b469","#46517","#b2249","#dce748","#175a3f","#6a396e","#c62d30","#afcc8d","#94e369","#41cbe0","#131945","#dbef1c","#8f699b","#76a695","#5a29f4","#e18de0","#17366f","#ff6d6b","#6b2c32","#38b4c5","#742833","#c583fa","#201e41","#1c16c7","#83312c","#4c7af5","#79ff5e","#6baeee","#bd27e2","#4b23d","#1df2c9","#c7e55b","#8b16be","#c7c5fa","#59c773","#80834b","#fe5d81","#d69892","#de5df1","#1a82b4","#73293e","#1116f2","#742295","#8bb375","#5a3f3c","#9451d3","#77a714","#de8979","#2ad6f","#164547","#56a14e","#a06fcd","#33e4cb","#32ada1","#85e11a","#b7e32d","#e5d3e","#6e03df","#a5a552","#7f1aa4","#626f69","#b1277e","#40b8b6","#77a0fa","#8442e4","#9dfd6c","#eea980","#a37cc2","#643e8b","#ba5d10","#ed5627","#a1b5b9","#e0e4c4","#981c95","#e1ea68","#b55dd0","#b26b0b","#4c1688","#bedfb7","#97347c","#4b3a48","#cebb77","#4518e3","#c9dbe7","#d490c1","#7b49ec","#bad11f","#b9b318","#203526","#8132e1","#c796b2","#7dbff3","#c3bce8","#346786","#9abd52","#476ab1","#7427eb","#376ae9","#799d45","#328faa","#8806f8","#921785","#445c4","#801c1d","#2068bd","#12c0c3","#b8ba74","#257016","#5ab471","#d240a6","#7ea543","#7983","#a3cd19","#7061bb","#17461f","#3b295e","#f9aba2","#89da8e","#ded72a","#ce0f58","#1c6173","#4764f4","#d8fc64","#999d1d","#f77896","#7dc169","#6ac30f","#92de32","#cc9e93","#e4c04e","#d65057","#df5728","#ce9b4a","#54fbfa","#abfce9","#defb63","#4f9b60","#8dab99","#dc3b7","#358b05","#ab95bc","#44fee1","#261cbf","#fbfd6c","#837d1c","#e44676","#76d04","#2da09f","#41e5d0","#66bc5d","#6016f2","#48920c","#ced2b6","#db7fff","#4397a2","#c9a17d","#fe2d2f","#fce66","#ffb621","#1233ce","#919bb6","#d77073","#b72cdb","#d93660","#67e4ad","#a5539b","#a53f9a","#eb1548","#57bcd5","#dbadf","#cb8056","#efc17","#98b4ac","#65281d","#1475cd","#f7d258","#175bd1","#b02e6d","#85cab3","#c19c95","#bec231","#c426dc","#eea0e","#d9ea0f","#91874f","#ba4ba3","#257757","#1ed33c","#28ada","#45500e","#15b4bc","#ac0b39","#cf2b7c","#78daef","#48b9a7","#c643f5","#d47d75","#d4aa60","#713d4a","#cb4648","#fec075","#698c58","#a835d7","#acd756","#5155d2","#49fd41","#b47732","#7f08b","#ab6bbf","#80fab","#b49229","#3b057c","#e9b973","#3a6be1","#5e805a","#e7204e","#8f469b","#d734f8","#fefb1a","#bde562","#f9cec2","#390ac8","#d26dd9","#ed7d66","#4bce4d","#e5af99","#e661f5","#481cb4","#d20666","#cb01ab","#c91c08","#a7796","#e34fef","#2b04ed","#17d46f","#a1e7ec","#bb3a2d","#a0e254","#935fa","#18de7d","#b00566","#f73553","#c949e","#8a820e","#b569f1","#245bd2","#cda971","#e3737f","#f4f8a4","#539838","#31e538","#f0c392","#472f84","#dcf7e1","#ce58f5","#81e76","#5b1ff4","#a0f70f","#5ce654","#a030b4","#eee025","#fd53aa","#d45ebe","#545ae4","#f6ae7f","#9a158d","#5ed310","#183695","#d9f1de","#78e514","#c2f9c8","#801f75","#b7126d","#1cba04","#1bb211","#4a47d0","#18bebc","#a5a91d","#d6e426","#ce576c","#bccfec","#953695","#99026e","#315b7a","#203a5","#35ea2f","#1af532","#231be1","#89a6d3","#b1abfb","#cd487f","#652881","#aaff75","#83d720","#446c40","#13299","#4ca6cd","#536d6","#675725","#aae1e0","#d78ce7","#12550a","#5b9414","#6161d3","#a84b1e","#860f12","#7361a8","#65f098","#6520f0","#f0f748","#c3d643","#1c62f0","#54ba1c","#7ef6e3","#8e35ca","#d68bd","#d40ea9","#7530ec","#daf09c","#ebcbf5","#94d260","#ab5ebc","#b76990","#451c34","#ea4efb","#99adb1","#39266e","#5eb3d9","#18b2de","#b91831","#f762c7","#d9a130","#f4cde4","#6fe59e","#bba3d","#d5c8e2","#31a687","#1b30e3","#cb44f4","#c3631b","#a3e4d8","#6cb53d","#18ffe7","#62a795","#f7cd80","#9410b9","#e9c202","#2c26d8","#68d4e6","#130aa6","#436a8a","#2e3cef","#59f66f","#f38fd4","#e9bf9b","#ce5540","#93b6f4","#e9debe","#a4787d","#a0764f","#6ef44a","#66f12e","#3d7e94","#4cbc7f","#6962f1","#17838c","#3b3bca","#f506a0","#ebaa23","#20b432","#69d008","#21b238","#63f963","#fc9d28","#32e1eb","#e53b1f","#d20a5d","#c4aba9","#46398","#3e0ba3","#7f4efc","#219f3a","#bb55db","#d4aaaf","#9fcc03","#d2db2e","#5ed651","#5ec3d1","#4dc0ec","#c53f86","#6df19d","#e74479","#e27fa5","#529e60","#b021ad","#607cf2","#48f99a","#4dec34","#e8c614","#e39fad","#193e9e","#e4499b","#975918","#1a5f7a","#e5ed07","#7bcbf","#210d8d","#6d8aa0","#fbd846","#b17991","#8a62e6","#d29d85","#f6582","#cefa17","#5ea998","#74474b","#300987","#3ffa5a","#74ee0a","#a03335","#93b239","#8fee90","#9506a0","#664524","#7084d0","#4dcf30","#e658ba","#630bbf","#11a331","#e7537c","#40e235","#ac6b35","#5a7e79","#689f82","#48cd26","#b8301e","#c9a107","#a884c3","#19c8d8","#7a55ef","#c0e418","#3531f4","#9ebb46","#d4beca","#dd7c8a","#96c31a","#5ae74f","#b9e3fa","#4790cf","#fc84f1","#8ce7eb","#9205b1","#388440","#946b97","#66d54b","#522cd0","#d1ce8a","#124aa9","#baf664","#c7ba68","#9ffe47","#792287","#ffdb2d","#480315","#ca66f4","#24d843","#60d606","#ac9511","#6c2852","#1dec49","#728a63","#ef53fe","#392dfd","#64f845","#c4cbac","#4f4ec5","#dedbbb","#a9b907","#5e1095","#35f3e8","#79cb0c","#ab67f1","#3271c3","#ed23bf","#1a1913","#3e09f5","#be8c2e","#705eab","#9dd3f4","#a87d17","#d0b046","#fe5a6e","#29dbeb","#84aff8","#ae1271","#766f04","#fee035","#e70ba3","#fdab42","#ea0852","#948284","#ab253f","#9bbd9e","#a3fd84","#40f6e8","#93aec2","#36a14d","#ce0bcc","#7a73c4","#b96e3d","#56ffe6","#448ff9","#a04396","#e103e5","#b99ea","#1f04f1","#c54170","#5ed1fc","#3a1ed3","#14fd8c","#dd5ce","#e7c0ad","#c7dd03","#bb24e","#8dd9cd","#61ce5f","#107385","#a00b57","#e54263","#8858e3","#d9756","#6ab967","#8777fd","#dac649","#b2c859","#44466c","#ff6efb","#17d693","#1139e1","#f88b1f","#153887","#481deb","#ece97a","#d99283","#d8a1e1","#236e06","#ab292d","#42c6e5","#1dbaa9","#1c4258","#4840f2","#97b066","#b029a0","#bb1772","#388010","#6a9227","#1b04b0","#b6ce70","#c8799c","#ae0bfe","#ff8356","#527a59","#f7c1f9","#d7cb62","#d51a0d","#d662e","#3882bd","#4a224","#44a370","#4cab1f","#7062ac","#db1e8e","#541f2f","#3aee6f","#c9f852","#aaabc4","#140c64","#cd71b2","#9915a1","#d50f46","#1f6520","#63ce1c","#1f812","#6de9e","#970444","#d9439","#984641","#ac4b9b","#d8e6bf","#27ddea","#3d5825","#868820","#a4992b","#186366","#639ffb","#ab7140","#beb568","#c8aa78","#e8dad2","#40e9e2","#51a845","#7b0efe","#1f6c5a","#1cb25a","#6a0a6e","#548c77","#2660ae","#97b43e","#facf95","#1647ea","#acc1f","#121cc6","#25be8a","#ea804a","#a6935","#b0edf5","#ec21d9","#d0ca90","#9c15ec","#45dac7","#75c392","#af356e","#26a787","#605667","#68233f","#6dbc28","#cc5936","#7bcc99","#51ac11","#11307a","#82573b","#b0339f","#df2098","#3efc66","#915556","#a1d6cf","#9a178e","#40c276","#3f8d09","#825d2d","#274d91","#179d49","#7ffa2a","#d59aa","#5647d9","#7b493d","#93a530","#f707a5","#c8e44","#79aae0","#270f8a","#f55e0","#cf1538","#e0b561","#bbaca4","#29de7e","#66ff5f","#da8814","#39edfa","#32817b","#862024","#91b7f5","#8f771a","#3faa7e","#6be5a9","#70c8f1","#2bd68e","#5563c","#25ae2f","#f68f14","#857b7","#8aaf27","#ca7d40","#734b7d","#4d451d","#6540f0","#24b44","#e5fc86","#d79b1","#ec551","#7b0ae8","#b11d34","#eb1ab5","#3aa4fc","#7f1df4","#cb9a06","#7d6cdf","#3b3878","#308dec","#153476","#cbac0b","#318551","#7ca18a","#b67875","#c825dd","#127398","#2f1a6d","#8c774e","#42bf","#e86285","#999088","#cb5eae","#da4236","#b4f940","#8452cb","#145c2a","#1a01b8","#60496","#7ed4e0","#a67cfd","#449a18","#f981ef","#349bea","#abcd10","#bfda2f","#e5deae","#76dfbf","#a091df","#3a3f4f","#8730ef","#ba21f7","#537e86","#94f89","#f197c0","#100bdd","#a2d30d","#c434e4","#923703","#454c8f","#f51c33","#32c336","#116329","#b99676","#a024c5","#4bef64","#34eff8","#2ad748","#aced3c","#b21737","#308776","#dec64d","#703906","#d6b7ce","#aa8ad3","#9e3757","#eee7e6","#f52130","#92422","#a412e2","#c6ef5","#92c401","#30a78b","#d8655e","#eebfbf","#abc670","#2a08e0","#db9307","#7d18fe","#d356f0","#329005","#7289c2","#7a6205","#e17b68","#245583","#55c6fc","#aef5ed","#32945","#5b437d","#8bcb5f","#c39361","#dee8b0","#b2616a","#845f59","#ca58ad","#df9cf0","#ff3dac","#74cc06","#45f679","#fd025a","#93ebcd","#13c6b0","#28fb65","#517562","#b256b2","#7ce22a","#a54c42","#c60f7d","#23c33a","#18cc89","#acfb88","#c4f20a","#a39f7e","#c2310a","#680b6d","#7ce8ed","#c90896","#ec31c3","#44e728","#eb7951","#ca80f9","#e487b6","#1afedc","#752b7e","#477074","#e33848","#a73c25","#30438","#9315d1","#a4e2bf","#542358","#bc3b8d","#3707f3","#a89093","#554ac1","#9a77fc","#1cf7e3","#ec05","#fce560","#6b535a","#391899","#b506c7","#ebe2e7","#b1eb53","#a569d1","#1f0873","#852479","#33aca5","#2398ed","#2afd88","#22c388","#ed2918","#376875","#eed653","#d8e44d","#e0828e","#487768","#d24e6c","#2d8121","#ccf5fb","#cbb693","#65cc26","#d32f38","#ca6e6c","#c82fc4","#7b936","#573ba8","#3b56ba","#8d4b35","#2f3da1","#ce58a4","#761eae","#d0cb","#3beece","#317051","#92dafa","#883cf9","#4ea53e","#e80ad7","#51b345","#ed2637","#a4dfdf","#8ac7a8","#929f5a","#f01929","#b80d1e","#c20016","#ea6784","#f8f64e","#7184e","#9a51ec","#94f015","#63d43c","#70bf3c","#eedd1d","#804409","#ce7dfa","#9907c3","#432b77","#471c26","#9db2c4","#d5da9f","#ef7268","#de3bd0","#640ff2","#165d8f","#f6a1e0","#dcf4f1","#6c24ca","#e78977","#2a09ff","#189507","#bffd46","#3be8b0","#2cc76f","#25dc7c","#733186","#dc07a6","#9a8235","#11a484","#66f845","#12f746","#a8405b","#1e2855","#b3f1d7"]
 









  /*  for(let i=0; i<1000;i++){
         cor.push('"#'+Math.floor(Math.random()*16777215).toString(16)+'"');
           
            
    }*/

//console.log(cor)
    var dados= {
    type: 'doughnut',
    data: {
        labels: descricao,
        datasets: [{
            label: 'Artigos',
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

  




      var pie= {
    type: 'pie',
    data: {
        labels: descricao,
        datasets: [{
            label: 'Artigos',
            data: quantidade,
            backgroundColor: cor,
            borderColor: cor,
            borderWidth: 1
         
        }]
    },
    options: {
      aspectRatio:1,
            maintainAspectRatio:false,
            weight:3,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }}

    if(typeof $('#pieChart').val() !='undefined'){
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
   
            pieChart       = new Chart(pieChartCanvas,pie)
}
     



 if(typeof $('#barChart')!='undefined'){
 var barChartCanvas                   = $('#barChart').get(0).getContext('2d')

     dados.type='bar'
      barChart                         = new Chart(barChartCanvas,dados)
 }
    




//const myChart = new Chart(ctx, dados);

//myChart.clear()


////////////////////////////Line Chart///////////////////////////////
const data = {
  labels: descricao,
  datasets: [
    {
      label: 'Artigos',
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


if(typeof $("#lineChart").val() !='undefined'){

 lineChartCanvas          = document.getElementById('lineChart').getContext('2d')
lineChart                = new Chart(lineChartCanvas,config)
}





//////////////////Area chart////////////////////////////////////////

}
   





$(document).ready(function(){ 

  if (navigator.userAgent.indexOf('Chrome') != -1) {
    $('input[type=date]').on('click', function(event) {
        event.preventDefault();
    });
}

  @isset($dados)

 var dado=  {!! $dados !!}

 var dados=dado

 var desc =[]
 var num = []
var descricao
var quantidade

var j=0


 tabela.rows.add(constroiDataSet(dados,$("#funcao").val()))
  tabela.draw()


 

/*for( j in da){

  if($("#funcao").val()==6){
     
       
     }
  
}
  */ 
 
    
 
   
    
  
  

 for(let i=0; i<dados.length;i++){
   

   if($("#funcao").val()==4){
    total.push(dados[i].total)
   
    desc.push(cortarNome(dados[i].cliente))

   }
   if($("#funcao").val()==5){
   
    desc.push(cortarNome(dados[i].descricao))
    num.push(dados[i].stock)
    if(i==4){break}
   }

   if($("#funcao").val()==1){
    desc.push(cortarNome(dados[i].cliente))
    num.push(dados[i].total)
   }

   if($("#funcao").val()==2){
  
    desc.push(cortarNome(dados[i].artigo))  
    num.push(dados[i].qtd)
   }

   if($("#funcao").val()==6){
     
     num.push(dados[i])
     n=n+1  
    }
   
 }

 ///////////////////////////////////////////////////////CRIAÇÃO DAS TABELAS////////////////////////////////


     


    

    
///////////////////////////////////////////////////////FIM CRIAÇÃO DAS TABELAS////////////////////////////////
 




   @empty($dados) 
       descricao = ["Não foram encontrados dados para serem exibidos"]
       quantidade= [0]
    @else
 
      descricao = desc.slice(0,5)
     quantidade= num.slice(0,5)

///alimentado a istribução mensal
     if($("#funcao").val()==6){
     
     descricao=mes
     quantidade=Object.values(dados)

    }
     
   @endempty
   @endisset
 

 // var funcao = $("#funcao").val()


      grafico(descricao,quantidade);
  

})
    function filtro(){
      var gerarPDF = $("#gerarPDF").val()
      var inicio = $("#data_inicio").val()
      var fim = $("#data_fim").val()
      var moeda = $("#moeda").val()
      var funcao = $("#funcao").val()
      var ano
    
//console.log(inicio+"/"+fim+"/"+moeda)
      if(funcao==1){
        var caminho= "{{ route('vendas.clientesGraficos',["moeda","inicio","fim"]) }}";
      }else if(funcao==2){
        var caminho= "{{ route('vendas.artigoGraficos',["moeda","inicio","fim"]) }}";
      }else if(funcao==3){
        var caminho= "{{ route('vendas',["moeda","inicio","fim"]) }}";
      }else if(funcao==6){
        var caminho= "{{ route('vendas.distribuicaoMensalGrafico',["moeda","inicio","fim"]) }}";

        if(!inicio){
            ano= $("#ano").val()
          inicio = ano+'-01-01'
          fim= ano+'-12-31'
        }
       

      }
       var href = "{{ route('artigos.clientesListasFiltro',["moeda","inicio","fim"]) }}"
      

      console.log(fim)
      console.log(inicio)
      console.log(moeda)
     // caminho = caminho.replace('funcao',funcao);
      caminho = caminho.replace('moeda',moeda);
      caminho = caminho.replace('inicio',inicio);
      caminho = caminho.replace('fim',fim);

      href = href.replace('moeda',moeda);
      href = href.replace('inicio',inicio);
      href = href.replace('fim',fim);
      $("#gerarPDF").attr("href",href)
 

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
                    var descri
                    var quant
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
                                desc.push(cortarNome(valor[i].cliente))


                              }
                              if(funcao==5){
                                desc.push(cortarNome(valor[i].descricao))
                                num.push(valor[i].stock)
                              }

                              if(funcao==1){
                                desc.push(cortarNome(valor[i].cliente))
                                num.push(valor[i].total)
                              }

                              if(funcao==2){
                              
                                desc.push(cortarNome(valor[i].artigo))
                                num.push(valor[i].qtd)
                              }
                             
                          
                              
                      }
                          


                    
                     
                 

                      if(funcao==3){

                        $('#totalVendas').empty()
                          $('#totalVendas').append(valor.totalVendas.total)
                        $('#totalNotasCredito').empty()
                        $('#totalNotasCredito').append(valor.totalNotasCredito.quantidade)

                      }else{
                        n=0
                          j=0
                        
                            tabela.clear().rows.add(constroiDataSet(valor,funcao)).draw();
                          
                        
                        
                        if(lineChart){
                                  lineChart.destroy()
                      $("#lineChart").remove()
                       $("#lineCharts").html(`<canvas id="lineChart" style="height:250px" ></canvas>`)
                        }
               
                      // lineChart.render()
                      if(barChart){
                        barChart.destroy() 
                       $("#barChart").remove()
                       $("#barCharts").html(`<canvas id="barChart" style="height:250px" ></canvas>`)
                      }
                       if(pieChart){
                          pieChart.destroy()
                       $("#pieChart").remove()
                       $("#pieCharts").html(`<canvas id="pieChart" style="height:250px" ></canvas>`) 
                       }
                      
                       descri= desc.slice(0,5)
                       quant=num.slice(0,5)

                       if(funcao==6){
              
                        descri=mes
                        quant=Object.values(valor)

                      
                    
                        }
                       
                      grafico(descri,quant);

                      }
                    
                      
                      
                    //  console.log(areaChartData.labels)
                          
       
                   }
      
  
         })


        }

        function distribuicao(cliente){


   
      var inicio = $("#data_inicio").val()
      var fim = $("#data_fim").val()
      var moeda = $("#moeda").val()
      var funcao = $("#funcao").val()
      var ano
    
//console.log(inicio+"/"+fim+"/"+moeda)
      
        var caminho= "{{ route('vendas.distribuicaoMensalClienteGrafico',["moeda","inicio","fim","cliente"]) }}";

        if(!inicio){
            ano= $("#ano").val()
          inicio = ano+'-01-01'
          fim= ano+'-12-31'
        }
       

      
      
      

      console.log(fim)
      console.log(inicio)
      console.log(moeda)
     // caminho = caminho.replace('funcao',funcao);
      caminho = caminho.replace('moeda',moeda);
      caminho = caminho.replace('inicio',inicio);
      caminho = caminho.replace('fim',fim);
      caminho = caminho.replace('cliente',cliente);

   
 

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
                   cliente:cliente
                   },
                   headers:{
                   'Accept':'application/json',
                   'Content-Type':'application/json'
                   },
                   success:function(data){
                    var valor= JSON.parse(data)
                     //  console.log(valor)
                    var descri
                    var quant
                    var desc=[]
                    var total=[]
                    var num = []
                    var funcao = $("#funcao").val()

                    if(funcao!=3){
                      
                    }
                      if(Object.keys(data).length==0){
                        areaChartData.labels= ["Não Foi encontrado nenhum dado para este periodo"]
                        areaChartData.datasets.data= [0]
                      }

                      console.log(valor)                               
                        if(lineChart){
                                  lineChart.destroy()
                      $("#lineChart").remove()
                       $("#lineCharts").html(`<canvas id="lineChart" style="height:250px" ></canvas>`)
                        }
               
                      // lineChart.render()
                      if(barChart){
                        barChart.destroy() 
                       $("#barChart").remove()
                       $("#barCharts").html(`<canvas id="barChart" style="height:250px" ></canvas>`)
                      }
                       if(pieChart){
                          pieChart.destroy()
                       $("#pieChart").remove()
                       $("#pieCharts").html(`<canvas id="pieChart" style="height:250px" ></canvas>`) 
                       }
                      
                       
              
                        descri=mes
                        quant=Object.values(valor)

                      
                    
                        
                       
                      grafico(descri,quant);

                      
                    
                      
                      
                    //  console.log(areaChartData.labels)
                          
       
                   }
      
  
         })


      

        }




/*

        function myFunction(x) {   if($("#funcao").val()==3){
  if (x.matches) { // If media query matches
 

    
    $("#moeda").css("width","40px")
   
  }
}
}

var x = window.matchMedia("(max-width: 1302px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction)
*/







  </script>
<script>
    $(function () {
      $('#example1').DataTable({
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
      })
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        
      })

      $('#example2').DataTable({
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
        "searchPlaceholder": "viagem, navio, agência",
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
      })
    })
  </script>  
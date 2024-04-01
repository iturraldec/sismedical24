/* GRAFICO PARA CITAS POR SUCURSALES ANUAL*/
function showGraphBarSucursales(){
    {
      $.post("data.php?ProcesosxSucursales=si",
      function (data)
      {
          console.log(data);
          var id = [];
          var name = [];
          var compras = [];
          var cotizacion = [];
          var ventas = [];
          var myColors=[];

          for (var i in data) {
              id.push(data[i].codsucursal);
              name.push(data[i].nomsucursal);
              compras.push(data[i].sumatendidas);
              cotizacion.push(data[i].sumcanceladas);
              ventas.push(data[i].sumvencidas);
          }

          var data = {
            labels : name,
            datasets : [
            {
                fillColor : "#6b9dfa",
                strokeColor : "#6b9dfa",
                highlightFill: "#1864f2",
                highlightStroke: "#6b9dfa",
                data : compras,
                label : 'Atendidas'
            },
            {
                fillColor : "rgba(226, 160, 63, 0.5)",
                strokeColor : "rgba(226, 160, 63, 0.75)",
                highlightFill : "rgba(226, 160, 63, 1)",
                highlightStroke : "#fff",
                data : cotizacion,
                label : 'Canceladas'
            },
            {
                fillColor : "rgba(255, 87, 51, 0.5)",
                strokeColor : "rgba(255, 87, 51, 0.75)",
                highlightFill : "rgba(255, 87, 51, 1)",
                highlightStroke : "#fff",
                data : ventas,
                label : 'Vencidas'
            }
            ]
          } 

        var ctx = document.getElementById("barChart").getContext("2d");
        var barChart = new Chart(ctx).Bar(data, {
         responsive : true,
         animation: true,
         barValueSpacing : 5,
         barDatasetSpacing : 1,
         tooltipFillColor: "rgba(0,0,0,0.8)",                
         multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
       });
        legend(document.getElementById("barLegend"), data, barChart, "<%=label%>");
    });
  }
}


/*############ GRAFICO DE PACIENTES EN SEXO #############*/
function showGraphBarSexo()
{
    {
      $.post("data.php?CitasSexo=si",
          function (data)
          {
              console.log(data);
              var m = [];
              var f = [];

              for (var i in data) {
                  m.push(data[i].masculino);
                  f.push(data[i].femenino);
              }

              var data = {
                labels : ["Sexo en Pacientes"],
                datasets : [
                {
                    fillColor : "#6b9dfa",
                    strokeColor : "#6b9dfa",
                    highlightFill: "#1864f2",
                    highlightStroke: "#6b9dfa",
                    data : [m],
                    label : 'Masculinos'
                },
                {
                    fillColor : "rgba(255, 87, 51, 0.5)",
                    strokeColor : "rgba(255, 87, 51, 0.75)",
                    highlightFill : "rgba(255, 87, 51, 1)",
                    highlightStroke : "#fff",
                    data : [f],
                    label : 'Femeninos'
                }
              ]
              } 

          var ctx = document.getElementById("barChart3").getContext("2d");
          var barChart = new Chart(ctx).Bar(data, {
               responsive : true,
               animation: true,
               barValueSpacing : 5,
               barDatasetSpacing : 1,
               tooltipFillColor: "rgba(0,0,0,0.8)",                
               multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
           });
          legend(document.getElementById("barLegend3"), data, barChart, "<%=label%> ");
      });
  }
}


/*############ GRAFICO DE CITAS EN GINECOLOGIA #############*/
function showGraphDoughnut()
{
    {
      $.post("data.php?CitasGinecologia=si",
          function (data)
          {
              console.log(data);
              var cauterizacion = [];
              var colposcopia = [];
              var ecografia = [];

              for (var i in data) {
                  cauterizacion.push(data[i].cauterizacion);
                  colposcopia.push(data[i].colposcopia);
                  ecografia.push(data[i].ecografia);
              }

              var data = [
              {
                value: cauterizacion,
                color: "#5ae85a",
                highlight: "#42a642",
                label: "Criocauterizacion"
              },
              {
                value: colposcopia,
                color:"#0b82e7",
                highlight: "#0c62ab",
                label: "Colposcopias"
              },
              {
                value: ecografia,
                color: "#e3e860",
                highlight: "#a9ad47",
                label: "Ecografias"
              }
              ];

          var ctx = document.getElementById("pieChart").getContext("2d");

          var pieChart = new Chart(ctx).Doughnut(data, {
              responsive : true,
              animation: true,
              barValueSpacing : 5,
              barDatasetSpacing : 1,
              tooltipFillColor: "rgba(0,0,0,0.8)",                
              multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
          });
          legend(document.getElementById("pieLegend"), data, pieChart, "<%=label%>: <%=value%> ");
      });
  }
}


/*############ GRAFICO DE CITAS EN RADIOLOGIA #############*/
function showGraphBar()
{
    {
      $.post("data.php?CitasRadiologia=si",
          function (data)
          {
              console.log(data);
              var mas = [];
              var menos = [];

              for (var i in data) {
                  mas.push(data[i].si);
                  menos.push(data[i].no);
              }

              var data = {
                labels : ["Consultas en Radiologia"],
                datasets : [
                {
                    fillColor : "rgba(95, 169, 156, 0.5)",
                    strokeColor : "rgba(95, 169, 156, 0.75)",
                    highlightFill : "rgba(95, 169, 156, 1)",
                    highlightStroke : "#fff",
                    data : [mas],
                    label : 'Con Lectura Rx'
                },
                {
                    fillColor : "rgba(59, 63, 92, 0.5)",
                    strokeColor : "rgba(59, 63, 92, 0.75)",
                    highlightFill : "rgba(59, 63, 92, 1)",
                    highlightStroke : "#fff",
                    data : [menos],
                    label : 'Sin Lectura Rx'
                }
              ]
              } 

          var ctx = document.getElementById("barChart2").getContext("2d");
          var barChart = new Chart(ctx).Bar(data, {
               responsive : true,
               animation: true,
               barValueSpacing : 5,
               barDatasetSpacing : 1,
               tooltipFillColor: "rgba(0,0,0,0.8)",                
               multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
           });
          legend(document.getElementById("barLegend2"), data, barChart, "<%=label%> ");
      });
  }
}
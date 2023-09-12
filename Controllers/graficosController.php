<?php
class graficosController
{

    public function construir_grafico_linea($nombreId,$cf,$rc){


        $cadena="
        <script>
            Highcharts.chart('$nombreId', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Comparativo entre Registro y Cuota'
                },
                subtitle: {
                    text: 'Nombre Grafico'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Monto en C$'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Cuota Fija',
                    data: [".$cf."]
                }, {
                    name: 'Registro Contable',
                    data: [".$rc."]
                }]
            });
            </script>";
        
        
        
        return $cadena;
        
        }


public static function constuir_grafico_barras($contenedor,$titulo,$categorias,$valores,$ejex,$ejey)
{
    $series="";
    $leyendas="";
   
    for($i=0;$i<count($categorias);$i++)
    {
        $series.="{
            name: '".$categorias[$i]."', 
            data: [".$valores[$i]."] 
        },";
        if($i==0)
        $leyendas.="'$categorias[$i]'";
        else
        $leyendas.=",'$categorias[$i]'";

    }

echo "
    <script>

Highcharts.chart('$contenedor', {
    chart: {
        type: 'column'
    },
    title: {
        text: '$titulo'
    },
    xAxis: {
        categories: ['$ejex',$leyendas] 
    },
    yAxis: {
        title: {
            text: '$ejey' 
        }
    },
    series: [$series]
});
</script>
    ";




}

public static function grafico_pastel($contenedor,$titulo,$categorias,$valores)
{
    $series="";
   
   
    for($i=0;$i<count($categorias);$i++)
    {
        $series.="{
            name: '".$categorias[$i]."', 
            y: ".$valores[$i]."
        },";
       
    }
    echo "<script>
    Highcharts.chart('$contenedor', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '$titulo'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/> <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>:<br><b>Amount:{point.y:.2f}</b><br/> {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'amount',
            colorByPoint: true,
            data: [ $series ] }]   }); </script>

            ";
}

public static function grafico_barras($contenedor,$titulo,$tabla,$ejey)
{
   echo" <script>
  
      Highcharts.chart('".$contenedor."', {
          data: {
              table: '".$tabla."'
          },
          chart: {
              type: 'column'
          },
          title: {
              text: '$titulo'
          },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: '$ejey'
              }
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.series.name + '</b><br/> ' +
                      this.point.y ;
              }
          }
      });
      
         </script>";
}






}
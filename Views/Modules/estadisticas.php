<?php
echo '<script>
// EVITAR REENVIO DE DATOS.
    if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>';
$fechaActual = new DateTime();
if (isset($_POST['rdate'])) {
   $fechainicio = $_POST['rdate'];
   $fechafin = $_POST['rdate2'];
} else if (isset($_POST['finicio'])) {
   $fechainicio = $_POST['finicio'];
   $fechafin = $_POST['ffin'];
} else {
   $fechainicio = new DateTime($fechaActual->format('Y-m-01'));
   $fechainicio = $fechainicio->format('Y-m-d');
   $fechafin = new DateTime($fechaActual->format('Y-m-t'));
   $fechafin = $fechafin->format('Y-m-d');
}


$inicio = new DateTime($fechainicio);
    $fin = new DateTime($fechafin);
    $fin->modify('+1 day');

    if ($inicio <= $fin) {
        $lista_dias='';
        $interval = new DateInterval('P1D'); 
        $period = new DatePeriod($inicio, $interval, $fin);
        $ctours="";
        $ctravel="";
        $camenities="";

        $reservas = new DatosReservasC();
        $datosE = $reservas->ctrCargarEstadisticas("$fechainicio,$fechafin",$_SESSION['HOTEL']);


        foreach ($datosE as $item) {
   
            if($item->origen=='Concierge')
            {
                $diasTours=explode(",",$item->dias) ;
                $totalesTours=explode(",",$item->totales);
            }
            if($item->origen=='Travel')
            {
                $diasTravel=explode(",",$item->dias);
                $totalesTravel=explode(",",$item->totales);
            }
            if($item->origen=='Amenities')
            {
                $diasAmenities=explode(",",$item->dias);
                $totalesAmenities=explode(",",$item->totales);
            }
            
    }
        $datosc=[];
        $datost=[];
        $datosa=[];
        foreach ($period as $fecha) {
            $ddia=intval($fecha->format('d'));
            $datosc[$ddia]=0;
            $datost[$ddia]=0;
            $datosa[$ddia]=0;
            $lista_dias.= "'".$fecha->format('d') . "',"; 
        }


        
             for ($i = 0; $i < count($diasTours); $i++) {

                $datosc[intval($diasTours[$i])]=$totalesTours[$i];

            }    
          
            
            
            for ($i = 0; $i < count($diasTravel); $i++) {
                $datost[intval($diasTravel[$i])]=$totalesTravel[$i];
              }  

              
              for ($i = 0; $i < count($diasAmenities); $i++) {
                $datosa[intval($diasAmenities[$i])]=$totalesAmenities[$i];
              }  


              foreach($datosc as $item){
                $ctours.=$item.",";
              }

              foreach($datost as $item){
                $ctravel.=$item.",";
              }

              foreach($datosa as $item){
                $camenities.=$item.",";
              }

              
              
              
          
           


    }



$cadena="
<script>
    Highcharts.chart('USO_KIOSKO', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Comparativo entre Servicios'
        },
        subtitle: {
            text: 'Alcaldía de Ocotal'
        },
        xAxis: {
            categories: [$lista_dias]
        },
        yAxis: {
            title: {
                text: 'Cantidad de Visitas'
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
            name: 'Tours',
            data: [".$ctours."]
        }, {
            name: 'Travel',
            data: [".$ctravel."]
        }, {
            name: 'Amenities',
            data: [".$camenities."]
        }]
    });
    </script>";
?>
<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">
         <div class="col-md-12">
            <div class="page_title">
               <div id="accordion">
                  <div class="card green_bg text-center">
                     <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                           <h1 class="text-white my-3"><i class="fa fa-calendar"> DATE RANGE SEARCH <span><b><i><?= $fechainicio ?></i></b> / <b><i><?= $fechafin ?></i></b></span> </i></h1>
                        </a>
                     </div>
                     <div id="collapseOne" class="collapse hide" data-parent="#accordion">
                        <div class="card-body">
                           <form class="booking-form" method="POST">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <input value="<?= $fechainicio ?>" class="form-control" id="rdate" name="rdate" type="date" required>
                                       <span class="form-label">Check In</span>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <input value="<?= $fechafin ?>" class="form-control"  id="rdate2" name="rdate2" type="date" required>
                                       <span class="form-label">Check out</span>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-btn">
                                       <button class="main_bt" type="submit">GO!</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">

         <!-- MOSTAR DATOS EN TABLA -->

         <div class="col-md-12">
            <div class="row column1 social_media_section">

<div style="width: 100%;" id="USO_KIOSKO"></div>
<?= $cadena ?>


               
            </div>
            
         </div>
      </div>
   </div>


</div>


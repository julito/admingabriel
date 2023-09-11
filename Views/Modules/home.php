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
} else {
   $fechainicio = new DateTime($fechaActual->format('Y-m-01'));
   $fechainicio = $fechainicio->format('Y-m-d');
   $fechafin = new DateTime($fechaActual->format('Y-m-t'));
   $fechafin = $fechafin->format('Y-m-d');
}

$rango1 = intval(strtotime($fechainicio));
$rango2 = intval(strtotime($fechafin));


$reservas = new DatosReservasC();
$datos = $reservas->ctrCargarReservas();
$tablareresevas = '';

$totalmontos = 0;
$totalreservaspagadas = 0;
$totalporcentajes = 0;
$totalporcentajesacumulados = 0;


$contreservas = 0;
$montos1 = 0;
$porcentaje1 = 0;
$porcentajeacumulado = 0;
$reservaspendientes = 0;
$reservaspagadas = 0;

foreach ($datos as $item) {
   $fechar = intval(strtotime(substr($item->hecho, 0, 10)));
   if (!($fechar >= $rango1 && $fechar <= $rango2))
      continue;
   $tablareresevas .= '<tr>
      <td><i class="flaticon-download text-danger"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->reservaciones_name . '</td>
      <td>' . $item->reservaciones_monto . '</td>
      <td>' . $item->reservaciones_detalle . '</td>
      </tr>';

   $contreservas++;

   $montos1 += floatval($item->reservaciones_monto);
   $porcentaje1 += floatval($item->reservaciones_monto) * 0.10;
   if ($item->estado == 0) {
      $porcentajeacumulado += floatval($item->reservaciones_monto) * 0.10;
      $reservaspendientes++;
   } else
      $reservaspagadas += floatval($item->reservaciones_monto) * 0.10;
}

$datos2 = $reservas->ctrCargarReservasTravel();
$tablatravel = "";
$conttransporte = 0;
$montos2 = 0;
$porcentaje2 = 0;
$porcentajeacumulado2 = 0;
$reservaspendientes2 = 0;
$reservaspagadas2 = 0;
foreach ($datos2 as $item) {
   $fechar = intval(strtotime(substr($item->hecho, 0, 10)));
   if (!($fechar >= $rango1 && $fechar <= $rango2))
      continue;
   $tablatravel .= '<tr>
      <td><i class="flaticon-download text-danger"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->servicio . '</td>
      <td>' . $item->origen . '</td>
      <td>' . $item->destino . '</td>
      <td>' . $item->personas . '</td>
      <td>' . $item->total . '</td>
      </tr>';
   $conttransporte++;
   $montos2 += floatval($item->total);
   $porcentaje2 += floatval($item->total) * 0.10;
   if ($item->estado == 0) {
      $porcentajeacumulado2 += floatval($item->total) * 0.10;
      $reservaspendientes2++;
   } else
      $reservaspagadas2 += floatval($item->reservaciones_monto) * 0.10;
}

$reservas = new DatosReservasC();
$datos = $reservas->ctrCargarReservasAmenities();
$tablaamenities = '';
$contamenities = 0;
$montos3 = 0;
$porcentaje3 = 0;
$porcentajeacumulado3 = 0;
$reservaspendientes3 = 0;
$reservaspagadas3 = 0;
foreach ($datos as $item) {
   $fechar = intval(strtotime(substr($item->hecho, 0, 10)));
   if (!($fechar >= $rango1 && $fechar <= $rango2))
      continue;
   $tablaamenities .= '<tr>
      <td><i class="flaticon-download text-danger"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->reservaciones_name . '</td>
      <td>' . $item->reservaciones_monto . '</td>
      <td>' . $item->reservaciones_detalle . '</td>
      </tr>';

   $contamenities++;
   $montos3 += floatval($item->reservaciones_monto);
   $porcentaje3 += floatval($item->reservaciones_monto) * 0.10;
   if ($item->estado == 0) {
      $porcentajeacumulado3 += floatval($item->reservaciones_monto) * 0.10;
      $reservaspendientes3++;
   } else
      $reservaspagadas3 += floatval($item->reservaciones_monto) * 0.10;
}

$totalmontos = $montos1 + $montos2 + $montos3;
$totalreservaspagadas = $reservaspagadas + $reservaspagadas2 + $reservaspagadas3;
$totalporcentajes = $porcentaje1 + $porcentaje2 + $porcentaje3;
$totalporcentajesacumulados = $porcentajeacumulado + $porcentajeacumulado2 + $porcentajeacumulado3;


$inicio = new DateTime($fechainicio);
$fin = new DateTime($fechafin);
$fin->modify('+1 day');

if ($inicio <= $fin) {
   $lista_dias = '';
   $interval = new DateInterval('P1D');
   $period = new DatePeriod($inicio, $interval, $fin);
   $ctours = "";
   $ctravel = "";
   $camenities = "";

   $reservas = new DatosReservasC();
   $datosE = $reservas->ctrCargarEstadisticas("$fechainicio,$fechafin", $_SESSION['HOTEL']);


   foreach ($datosE as $item) {

      if ($item->origen == 'Concierge') {
         $diasTours = explode(",", $item->dias);
         $totalesTours = explode(",", $item->totales);
      }
      if ($item->origen == 'Travel') {
         $diasTravel = explode(",", $item->dias);
         $totalesTravel = explode(",", $item->totales);
      }
      if ($item->origen == 'Amenities') {
         $diasAmenities = explode(",", $item->dias);
         $totalesAmenities = explode(",", $item->totales);
      }

   }
   $datosc = [];
   $datost = [];
   $datosa = [];
   foreach ($period as $fecha) {
      $ddia = intval($fecha->format('d'));
      $datosc[$ddia] = 0;
      $datost[$ddia] = 0;
      $datosa[$ddia] = 0;
      $lista_dias .= "'" . $fecha->format('d') . "',";
   }



   for ($i = 0; $i < count($diasTours); $i++) {
      $datosc[intval($diasTours[$i])] = $totalesTours[$i];
   }

   for ($i = 0; $i < count($diasTravel); $i++) {
      $datost[intval($diasTravel[$i])] = $totalesTravel[$i];
   }

   for ($i = 0; $i < count($diasAmenities); $i++) {
      $datosa[intval($diasAmenities[$i])] = $totalesAmenities[$i];
   }

   foreach ($datosc as $item) {
      $ctours .= $item . ",";
   }

   foreach ($datost as $item) {
      $ctravel .= $item . ",";
   }

   foreach ($datosa as $item) {
      $camenities .= $item . ",";
   }
}

$cadena = "
<script>
    Highcharts.chart('USO_KIOSKO', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Comparativo entre Servicios'
        },
        subtitle: {
            text: 'Hotels'
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
            data: [" . $ctours . "]
        }, {
            name: 'Travel',
            data: [" . $ctravel . "]
        }, {
            name: 'Amenities',
            data: [" . $camenities . "]
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
                           <h1 class="text-white my-3"><i class="fa fa-calendar"> DATE RANGE SEARCH <span><b><i>
                                          <?= $fechainicio ?>
                                       </i></b> / <b><i>
                                          <?= $fechafin ?>
                                       </i></b></span> </i></h1>
                        </a>
                     </div>
                     <div id="collapseOne" class="collapse hide" data-parent="#accordion">
                        <div class="card-body">
                           <form class="booking-form" method="POST">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <input value="<?= $fechainicio ?>" class="form-control" id="rdate" name="rdate"
                                          type="date" required>
                                       <span class="form-label">Check In</span>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <input value="<?= $fechafin ?>" class="form-control" id="rdate2" name="rdate2"
                                          type="date" required>
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

   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column1">

            <!-- MOSTAR DATOS EN TABLA -->

            <div class="col-md-12">
               <div class="row column1 social_media_section">

                  <div style="width: 100%;" id="USO_KIOSKO"></div>
                  <?= $cadena ?>



               </div>

            </div>
         </div>
      </div>


   </div><br>
   <!--
   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column1">
            <div class="col-md-6 col-lg-4">
               <div class="full counter_section margin_bottom_30 yellow_bg">
                  <div class="couter_icon">
                     <div>
                        <i class="fa fa-user"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">250.50</p>
                        <p class="head_couter">Tours</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="full counter_section margin_bottom_30 blue1_bg">
                  <div class="couter_icon">
                     <div>
                        <i class="fa fa-clock-o"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">123.50</p>
                        <p class="head_couter">Travels</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-4">
               <div class="full counter_section margin_bottom_30 green_bg">
                  <div class="couter_icon">
                     <div>
                        <i class="fa fa-cloud-download"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">1,805</p>
                        <p class="head_couter">Amenities</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>-->

   <div class="col-md-12">
      <div class="row column1 social_media_section">
         <div class="col-md-6 col-lg-3">
            <div class="full socile_icons fb margin_bottom_30">
               <div class="social_icon">
                  <i class="fa fa-money"></i>
               </div>
               <div class="social_cont">
                  <ul>
                     <li>
                        <span><strong>Total General</strong></span>
                     </li>
                     <li>
                        <span><strong>$
                              <?= $totalmontos ?>
                           </strong></span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="full socile_icons tw margin_bottom_30">
               <div class="social_icon">
                  <i class="fa fa-sort-amount-desc"></i>
               </div>
               <div class="social_cont">
                  <ul>
                     <li>
                        <span><strong>Total Hotel %</strong></span>
                     </li>
                     <li>
                        <span><strong>$
                              <?= $totalporcentajes ?>
                           </strong></span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="full socile_icons linked margin_bottom_30">
               <div class="social_icon">
                  <i class="fa fa-check"></i>
               </div>
               <div class="social_cont">
                  <ul>
                     <li>
                        <span><strong>Total Paid</strong></span>
                     </li>
                     <li>
                        <span><strong>$
                              <?= $totalreservaspagadas ?>
                           </strong></span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="full socile_icons google_p margin_bottom_30">
               <div class="social_icon">
                  <i class="fa fa-line-chart"></i>
               </div>
               <div class="social_cont">
                  <ul>
                     <li>
                        <span><strong>Total Balance</strong></span>
                     </li>
                     <li>
                        <span><strong>$
                              <?= $totalporcentajesacumulados ?>
                           </strong></span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>

   </div>

   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column1">
            <div class="col-lg-6">
               <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Bar Chart</h2>
                     </div>
                  </div>
                  <div class="map_section padding_infor_info">

                     <canvas id="bar_chart"></canvas>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Pie Chart</h2>
                     </div>
                  </div>
                  <div class="map_section padding_infor_info">
                     <canvas id="pie_chart"></canvas>
                  </div>
               </div>
            </div>
         </div>



      </div>
   </div>
   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column1">
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>SERVICES</h2>
                     </div>
                  </div>
                  <div class="full price_table padding_infor_info">
                     <div class="row">
                        <!-- column price -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                           <div class="table_price full">
                              <div class="inner_table_price">
                                 <div class="price_table_head blue1_bg">
                                    <h2>TOURS</h2>
                                 </div>
                                 <div class="price_table_inner">
                                    <div class="cont_table_price_blog">
                                       <p class="blue1_color"><span class="price_no">
                                             <?= $contreservas ?>
                                          </span></p>
                                    </div>
                                    <div class="cont_table_price">
                                       <div class="table-responsive">
                                          <table class="table">
                                             <tbody>
                                                <tr>
                                                   <th style="width:50%">Total Amount:</th>
                                                   <td>$
                                                      <?= $montos1 ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th>Hotel Porcentage (10%)</th>
                                                   <td>$
                                                      <?= $porcentaje1 ?>
                                                   </td>
                                                </tr>


                                                <tr>
                                                   <th>Paid:</th>
                                                   <td>$
                                                      <?= $reservaspagadas ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th>Profit Balance:</th>
                                                   <td>$
                                                      <?= $porcentajeacumulado ?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <th>Pending Collections:</th>
                                                   <td>
                                                      <?= $reservaspendientes ?> Reservations
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="price_table_bottom">
                                    <?php if (sessionController::ValidateUser('admin')) { ?>
                                       <form action="tourinfo" class="center" method="POST">

                                          <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                          <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                          <input type="submit" class="main_bt" value="View Details">
                                       </form>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end column price -->
                        <!-- column price -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                           <div class="table_price full">
                              <div class="inner_table_price">
                                 <div class="price_table_head green_bg">
                                    <h2>TRAVELS</h2>
                                 </div>
                                 <div class="price_table_inner">
                                    <div class="cont_table_price_blog">
                                       <p class="green_color"><span class="price_no">
                                             <?= $conttransporte ?>
                                          </span></p>
                                    </div>
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Amount:</th>
                                                <td>$
                                                   <?= $montos2 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$
                                                   <?= $porcentaje2 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$
                                                   <?= $reservaspagadas2 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$
                                                   <?= $porcentajeacumulado2 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td>
                                                   <?= $reservaspendientes2 ?> Reservations
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="price_table_bottom">
                                    <?php if (sessionController::ValidateUser('admin')) { ?>
                                       <form action="travelinfo" class="center" method="POST">

                                          <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                          <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                          <input type="submit" class="main_bt" value="View Details">
                                       </form>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end column price -->
                        <!-- column price -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                           <div class="table_price full">
                              <div class="inner_table_price">
                                 <div class="price_table_head red_bg">
                                    <h2>AMENENITIES</h2>
                                 </div>
                                 <div class="price_table_inner">
                                    <div class="cont_table_price_blog">
                                       <p class="red_color"><span class="price_no">
                                             <?= $contamenities ?>
                                          </span></p>
                                    </div>
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Balance:</th>
                                                <td>$
                                                   <?= $montos3 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$
                                                   <?= $porcentaje3 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$
                                                   <?= $reservaspagadas3 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$
                                                   <?= $porcentajeacumulado3 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td>
                                                   <?= $contamenities ?> Reservations
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="price_table_bottom">
                                    <?php if (sessionController::ValidateUser('admin')) { ?>
                                       <form action="amenitiesinfo" class="center" method="POST">

                                          <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                          <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                          <input type="submit" class="main_bt" value="View Details">
                                       </form>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end column price -->
                        <!-- column price -->

                        <!-- end column price -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end row -->
      </div>
      <!-- footer -->
      <div class="container-fluid">
         <div class="footer">
            <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
         </div>
      </div>
   </div>


   <script>
      $(document).ready(() => {
         new DataTable('.table1', {
            responsive: {
               details: {
                  display: DataTable.Responsive.display.modal({
                     header: function (row) {
                        var data = row.data();
                        return 'Details for ' + data[2];
                     }
                  }),
                  renderer: DataTable.Responsive.renderer.tableAll({
                     tableClass: 'table1'
                  })
               }
            }
         });




         <?php

         echo '

   const config = {
    type: "bar",
    data: {
      labels: ["Tours", "Travel", "Amenities"],
      datasets: [{
        labels: ["Total:' . $contreservas . '","Total: ' . $conttransporte . '","Total: ' . $contamenities . '"],
        data: [' . $contreservas . ', ' . $conttransporte . ', ' . $contamenities . '],
        backgroundColor: ["rgba(33, 150, 243, 1)","rgba(30, 208, 133, 1)","rgba(233, 30, 99, 1)"],
      }]
    },
    options: {
      responsive: true,
      legend: false
    }
  };
 new Chart(document.getElementById("bar_chart").getContext("2d"), config);
';
         ?>

         <?php
         echo '
const config2 = {
   type: "pie",
   data: {
     datasets: [{
       data: ["' . $montos1 . '", "' . $montos2 . '", "' . $montos3 . '"],
       backgroundColor: ["rgba(33, 150, 243, 1)","rgba(30, 208, 133, 1)","rgba(233, 30, 99, 1)"],
     }],
     labels: ["Tours ","Travels ","Amenities "]
   },
   options: {
     legend: {
      display: true,
      position: "top",

      labels: {
          fontColor: "#71748d",
          fontFamily: "Circular Std Book",
          fontSize: 14,
      }
  },
   }
 };
 new Chart(document.getElementById("pie_chart").getContext("2d"), config2);
';
         ?>
      })
   </script>
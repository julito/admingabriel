<?php
error_reporting(0);

fechasController::getFechas($rango1,$rango2,$fechainicio,$fechafin);
$estado[0]='Pendiente';
$estado[1]='Pagado';
$estado[2]='Cancelado';

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
   if ($item->estado == 2)
   continue;
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
   if ($estado[$item->estado] == 0) {
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
   if ($item->estado == 2)
   continue;
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
   $porcentaje2 += floatval($item->total) * 0.20;
   if ($estado[$item->estado] == 0) {
      $porcentajeacumulado2 += floatval($item->total) * 0.20;
      $reservaspendientes2++;
   } else
      $reservaspagadas2 += floatval($item->reservaciones_monto) * 0.20;
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
if($datos)
foreach ($datos as $item) {
   if ($item->estado == 2)
   continue;
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
   $porcentaje3 += floatval($item->reservaciones_monto) * 0.20;
   if ($estado[$item->estado] == 0) {
      $porcentajeacumulado3 += floatval($item->reservaciones_monto) * 0.20;
      $reservaspendientes3++;
   } else
      $reservaspagadas3 += floatval($item->reservaciones_monto) * 0.20;
}


$reservasCanceladas = new DatosReservasC();
$canceled = $reservasCanceladas->ctrContarReservasCanceladas();
$contarCanceled = 0;
$tableCanceled = '';
foreach($canceled as $item){
$tableCanceled.='<tr>
<td>' . $item->estado . '</td>
</tr>';

}
$contarCanceled++;
 //fin reservas canceladas

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

if($datosE)
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
$namehotel=sessionController::get('HOTEL');
$cadena = "
<script>
    Highcharts.chart('USO_KIOSKO', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Comparison between Services'
        },
        subtitle: {
            text: '$namehotel'
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
            name: 'Transportation',
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



   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column1">

            <!-- MOSTAR DATOS EN TABLA -->

            <div class="col-md-6">
               <div class="row column1 social_media_section">

                  <div style="width: 100%;" id="datos_cantidad"></div>
                 <table class="hidden" id='tabla_conteo'>
                    <tbody>
                     <tr>
                        <th></th>
                        <th>TOURS</th>
                        <th>TRANSPORTATION</th>
                        <th>AMENITIES</th>
                     </tr>
                     <tr>
                        <td>Servicios</td>
                        <td><?= $contreservas ?></td>
                        <td><?= $conttransporte ?></td>
                        <td><?= $contamenities ?></td>
                     </tr>
                    </tbody> 
                  </table>
                 
                  <?php
                  $series=['Tours','Transportation','Amenities'];
                  $data=[$montos1 , $montos2, $montos3 ];
                  graficosController::grafico_barras("datos_cantidad","Data corresponding to the date range","tabla_conteo","Cantidades");
                  
                 
                  ?>
                  


               </div>

            </div>


            <div class="col-md-6">
               <div class="row column1 social_media_section">

                  <div style="width: 100%;" id="datos_montos"></div>
              
                 
                  <?php
                  $series=['Tours','Transportation','Amenities'];
                  $data=[$montos1 , $montos2, $montos3 ];
                  graficosController::grafico_pastel("datos_montos","Accumulated Amounts",$series,$data);
                  
                 
                  ?>
                  


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
                                    <h2>TRANSPORTATION</h2>
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
                                                <th>Hotel Porcentage (20%)</th>
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
                                                <th>Hotel Porcentage (20%)</th>
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
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                           <div class="table_price full">
                              <div class="inner_table_price">
                                 <div class="price_table_head green_bg">
                                    <h2>CANCELED</h2>
                                 </div>
                                 <div class="price_table_inner">
                                    <div class="cont_table_price_blog">
                                       <p class="green_color"><span class="price_no">
                                             <?= $contarCanceled ?>
                                          </span></p>
                                    </div>
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Amount:</th>
                                                <td>$
                                                   <?= 0 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (20%)</th>
                                                <td>$
                                                   <?= 0 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$
                                                   <?= 0 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$
                                                   <?= 0 ?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td>
                                                   <?= 0 ?> Reservations
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <div class="price_table_bottom">
                                    <?php if (sessionController::ValidateUser('admin')) { ?>
                                       <form action="canceled" class="center" method="POST">

                                          <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                          <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                          <input type="submit" class="main_bt" value="View Details">
                                       </form>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
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
            <p>Copyright © 2023 Designed by ConciergeHotline. All rights reserved.</p>
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



      })
   </script>



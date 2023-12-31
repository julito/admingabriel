<?php
fechasController::getFechas($rango1,$rango2,$fechainicio,$fechafin);

$reservas = new DatosReservasC();
$datos = $reservas->ctrCargarReservas();
$tablareresevas = '';
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
   if ($item->estado == 2) {    
      $tablareresevas .= '<tr">
      <td class="bg-danger"><i class="flaticon-download text-white"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->reservaciones_name . '</td>
      <td>' . $item->reservaciones_monto . '</td>
      <td>' . $item->reservaciones_detalle . '</td>
      <td>Cancelado</td>
          </tr>';
   }


   $contreservas++;

   $montos1 += floatval($item->reservaciones_monto);
   $porcentaje1 += floatval($item->reservaciones_monto) * 0.10;
   if ($item->estado == 2) {
      $porcentajeacumulado += floatval($item->reservaciones_monto) * 0.10;
      $reservaspendientes++;
   } else
      $reservaspagadas += floatval($item->reservaciones_monto) * 0.10;
}
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
                                       <input value="<?= $fechafin ?>" class="form-control" id="rdate2" name="rdate2" type="date" required>
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
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>TOURS RESERVATIONS CANCELED</h2><br>
                  </div>
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table class="table table-striped table-bordered nowrap table1" style="width:100%">
                        <thead>
                           <tr class="">
                              <th>View</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Tour</th>
                              <th>Amount</th>
                              <th>Details</th>
                              <th>State</th>
                             
                           </tr>
                        </thead>
                        <tbody>
                           <?= $tablareresevas ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="price_table_bottom">
                     <div class="center"><a class="main_bt" id="makereservasconcierge">Make Payment</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


</div>

<script>
   $(document).ready(() => {
      new DataTable('.table1', {
         responsive: {
            details: {
               display: DataTable.Responsive.display.modal({
                  header: function(row) {
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

<?php 
 $fechaActual = new DateTime();
if(isset($_POST['rdate']))
{
   $fechainicio=$_POST['rdate'];
   $fechafin=$_POST['rdate2'];
}
else
{
   $fechainicio=new DateTime($fechaActual->format('Y-m-01'));
   $fechainicio=$fechainicio->format('Y-m-d');
   $fechafin=new DateTime($fechaActual->format('Y-m-t'));
   $fechafin=$fechafin->format('Y-m-d');
}

$rango1=intval(strtotime($fechainicio));
$rango2=intval(strtotime($fechafin)); 
   

   $reservas = new DatosReservasC();
   $datos = $reservas->ctrCargarReservas();
   $tablareresevas='';
   $contreservas=0;
   $montos1=0;
   $porcentaje1=0;
   $porcentajeacumulado=0;
   $reservaspendientes=0;
   $reservaspagadas=0;

   foreach ($datos as $item) {
      $fechar=intval(strtotime(substr($item->hecho, 0, 10)));
      if(!($fechar>=$rango1 && $fechar<=$rango2) )
      continue;
      $tablareresevas.= '<tr>
      <td><i class="flaticon-download text-danger"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->reservaciones_name . '</td>
      <td>' . $item->reservaciones_monto . '</td>
      <td>' . $item->reservaciones_detalle . '</td>
      </tr>';

      $contreservas++;
      
      $montos1+= floatval($item->reservaciones_monto) ;
      $porcentaje1+=floatval($item->reservaciones_monto)*0.10;
      if($item->estado==0)
      {
         $porcentajeacumulado+=floatval($item->reservaciones_monto)*0.10;
         $reservaspendientes++;
      }
      else
      $reservaspagadas+=floatval($item->reservaciones_monto)*0.10;
   }

   $datos2 = $reservas->ctrCargarReservasTravel();
   $tablatravel="";
   $conttransporte=0;
   $montos2=0;
   $porcentaje2=0;
   $porcentajeacumulado2=0;
   $reservaspendientes2=0;
   $reservaspagadas2=0;
   foreach ($datos2 as $item) {
      $fechar=intval(strtotime(substr($item->hecho, 0, 10)));
      if(!($fechar>=$rango1 && $fechar<=$rango2) )
      continue;
      $tablatravel.= '<tr>
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
      $montos2+=floatval($item->total);
      $porcentaje2+=floatval($item->total)*0.10;
      if($item->estado==0){
         $porcentajeacumulado2+=floatval($item->total)*0.10;
         $reservaspendientes2++;
      }
      else
      $reservaspagadas2+=floatval($item->reservaciones_monto)*0.10;
   }

   $reservas = new DatosReservasC();
   $datos = $reservas->ctrCargarReservasAmenities();
   $tablaamenities='';
   $contamenities=0;
   $montos3=0;
   $porcentaje3=0;
   $porcentajeacumulado3=0;
   $reservaspendientes3=0;
   $reservaspagadas3=0;
   foreach ($datos as $item) {
      $fechar=intval(strtotime(substr($item->hecho, 0, 10)));
      if(!($fechar>=$rango1 && $fechar<=$rango2) )
      continue;
      $tablaamenities.= '<tr>
      <td><i class="flaticon-download text-danger"></i></td>
      <td>' . substr($item->hecho, 0, 10) . '</td>
      <td>' . $item->nombre . '</td>
      <td>' . $item->reservaciones_name . '</td>
      <td>' . $item->reservaciones_monto . '</td>
      <td>' . $item->reservaciones_detalle . '</td>
      </tr>';
      
   $contamenities++;
   $montos3+=floatval($item->reservaciones_monto);
      $porcentaje3+=floatval($item->reservaciones_monto)*0.10;
      if($item->estado==0){
         $porcentajeacumulado3+=floatval($item->reservaciones_monto)*0.10;
         $reservaspendientes3++;
      }
      else
      $reservaspagadas3+=floatval($item->reservaciones_monto)*0.10;

   }
?>

<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">
         <div class="col-md-12">
            <div class="page_title">
               <h1>DATE RANGE SEARCH</h1>
                     <!--<form class="" method="POST">
                        <div class="form-row align-items-center">
                           <div class="col-sm-3 my-1">
                              <input value="<?= $fechainicio ?>" type="date" class="form-control" id="rdate" name="rdate" required>
                           </div>
                        <div class="col-sm-3 my-1">
                        <div class="input-group">
                              <input  value="<?= $fechafin ?>" type="date" class="form-control" id="rdate2" name="rdate2">
                        </div>
                        </div>   
                        <div class="col-auto my-1">
                           <button type="submit" class="btn btn-primary">GO!</button>
                        </div>
                        </div>
                        
                     </form>-->
						<form class="booking-form" method="POST">
							<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input value="<?= $fechainicio ?>" class="form-control" type="date" required>
									<span class="form-label">Check In</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input value="<?= $fechafin ?>" class="form-control" type="date" required>
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
               <!-- -->
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
                                                   <p class="blue1_color"><span class="price_no"><?= $contreservas ?></span></p>
                                                </div>
                                                <div class="cont_table_price">
                                                   <div class="table-responsive">
                                       <table class="table">
                                       <tbody>
                                             <tr>
                                                <th style="width:50%">Total Amount:</th>
                                                <td>$ <?=$montos1?></td>
                                             </tr>
                                             <tr>
                                             <th>Hotel Porcentage (10%)</th>
                                                <td>$ <?=$porcentaje1?></td>
                                             </tr>

                                             
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$ <?=$reservaspagadas?></td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ <?=$porcentajeacumulado?></td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td><?=$reservaspendientes?> Reservations</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                                </div>
                                             </div>
                                             <div class="price_table_bottom">
                                                <form action="tourinfo" class="center" method="POST">
                                                 
                                                   <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                                   <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                                   <input type="submit" class="main_bt" value="View Details"> 
                                                </form>
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
                                                   <p class="green_color"><span class="price_no"><?= $conttransporte ?></span></p>
                                                </div>
                                                <div class="table-responsive">
                                       <table class="table">
                                       <tbody>
                                             <tr>
                                                <th style="width:50%">Total Amount:</th>
                                                <td>$ <?=$montos2?></td>
                                             </tr>
                                             <tr>
                                             <th>Hotel Porcentage (10%)</th>
                                                <td>$ <?=$porcentaje2?></td>
                                             </tr>
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$ <?=$reservaspagadas2?></td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ <?=$porcentajeacumulado2?></td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td><?=$reservaspendientes2?> Reservations</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                             </div>
                                             <div class="price_table_bottom">
                                                <?php if(sessionController::ValidateUser('admin')){?>
                                                <form action="travelinfo" class="center" method="POST">
                                                 
                                                   <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                                   <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                                   <input type="submit" class="main_bt" value="View Details"> 
                                                </form>
                                                <?php }?>
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
                                                   <p class="red_color"><span class="price_no"><?= $contamenities ?></span></p>
                                                </div>
                                                <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Balance:</th>
                                                <td>$ <?=$montos3?></td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$ <?=$porcentaje3?></td>
                                             </tr>
                                             <tr>
                                                <th>Paid:</th>
                                                <td>$ <?=$reservaspagadas3?></td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ <?=$porcentajeacumulado3?></td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td><?=$contamenities?> Reservations</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                             </div>
                                             <div class="price_table_bottom">
                                                <form action="tourinfo" class="center" method="POST">
                                                 
                                                   <input value="<?= $fechainicio ?>" type="hidden" name="finicio" id="finicio">
                                                   <input value="<?= $fechafin ?>" type="hidden" name="ffin" id="ffin">
                                                   <input type="submit" class="main_bt" value="View Details"> 
                                                </form>
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
$(document).ready(()=>{



   new DataTable('.table1', {
    responsive: {
        details: {
            display: DataTable.Responsive.display.modal({
                header: function (row) {
                    var data = row.data();
                    return 'Details for ' + data[2] ;
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



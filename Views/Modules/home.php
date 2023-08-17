
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
   $ganancia1=0;
   $reservaspendientes=0;

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
         $porcentajeacumulado+=$porcentaje1;
         $reservaspendientes++;

      }
      
      

     
   }

   $datos2 = $reservas->ctrCargarReservasTravel();
   $tablatravel="";
   $conttransporte=0;
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
   }

   $reservas = new DatosReservasC();
   $datos = $reservas->ctrCargarReservasAmenities();
   $tablaamenities='';
   $contamenities=0;
   $resrvas = new DatosReservasC();
   $datos = $reservas->ctrCargarReservasMontos();
   $tbres='';
   $montos=0;
   $porcentaje=0;
   $ganancia=0;
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

      /* $tbres.='<tr>
      <td>' . $item->reservaciones_monto. '</td>
      </tr>'; */
      $montos+=$item->reservaciones_monto;
      $porcentaje+=$item->reservaciones_monto*0.10;
      $ganancia=$montos-$porcentaje;
   $contamenities++;
   }
  
 
   
  /*  foreach($datos as $item){
      $fechar=intval(strtotime(substr($item->hecho, 0, 10)));
      if(!($fechar>=$rango1 && $fechar<=$rango2) )
      continue;
      $tbres.='<tr>
      <td>' . $item->reservaciones_monto. '</td>
      </tr>';
      $montos+=$item->reservaciones_monto+$reservaciones_monto;
      $porcentaje+=$item->reservaciones_monto*0.10;
      $ganancia=$montos-$porcentaje;
   } */
?>

<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">
         <div class="col-md-12">
            <div class="page_title">
               <h1>DATE RANGE SEARCH</h1>
                     <form class="" method="POST">
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
                        
                     </form>
            </div>
         </div>
      </div>

      <div class="row column1">
         <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
               <div class="couter_icon">
                  <div>
                     <i class="fa fa-users yellow_color"></i>
                  </div>
               </div>
               <div class="counter_no">
                  <div>
                     <p class="total_no"><?= $contreservas ?></p>
                     <p class="head_couter">TOURS RESERVATIONS</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
               <div class="couter_icon">
                  <div>
                     <i class="fa fa-bus blue1_color"></i>
                  </div>
               </div>
               <div class="counter_no">
                  <div>
                     <p class="total_no"><?= $conttransporte ?></p>
                     <p class="head_couter">TRANSPORT RESERVATIONS</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-4">
            <div class="full counter_section margin_bottom_30">
               <div class="couter_icon">
                  <div>
                     <i class="fa fa-bed purple_color"></i>
                  </div>
               </div>
               <div class="counter_no">
                  <div>
                     <p class="total_no"><?= $contamenities ?></p>
                     <p class="head_couter">AMENITIES RESERVATION </p>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
                        
                        <div class="col-md-4">
                           <div class="full white_shd">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>TOURS DETAILS</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <div class="price_table">
                                    <div class="table-responsive">
                                       <table class="table">
                                       <tbody>
                                             <tr>
                                                <th style="width:50%">Total Amount:</th>
                                                <td>$ <?=$montos1?></td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td><?=$reservaspendientes?> Reservations</td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$ <?=$porcentaje1?></td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ <?=$ganancia1?></td>
                                             </tr>
                                           
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="full white_shd">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>TRA DETAILS</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <div class="price_table">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Balance:</th>
                                                <td>$ </td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$ </td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ </td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td>$ </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="full white_shd">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>AMENITIES DETAILS</h2>
                                 </div>
                              </div>
                              <div class="full padding_infor_info">
                                 <div class="price_table">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                             <tr>
                                                <th style="width:50%">Total Balance:</th>
                                                <td>$ <?=$montos?></td>
                                             </tr>
                                             <tr>
                                                <th>Hotel Porcentage (10%)</th>
                                                <td>$ <?=$porcentaje?></td>
                                             </tr>
                                             <tr>
                                                <th>Profit Balance:</th>
                                                <td>$ <?=$ganancia?></td>
                                             </tr>
                                             <tr>
                                                <th>Pending Collections:</th>
                                                <td><?=$contestados?> Reservations</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

   </div>

</div>
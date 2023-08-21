
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
   $datos2 = $reservas->ctrCargarReservasTravel();
   $tablatravel="";
   $conttransporte=0;
   /*$montos2=0;
   $porcentaje2=0;
   $porcentajeacumulado2=0;
   $reservaspendientes2=0;
   $reservaspagadas2=0;*/
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
      /*$montos2+=floatval($item->total);
      $porcentaje2+=floatval($item->total)*0.10;
      if($item->estado==0){
         $porcentajeacumulado2+=floatval($item->total)*0.10;
         $reservaspendientes2++;
      }
      else
      $reservaspagadas2+=floatval($item->reservaciones_monto)*0.10;*/
   }
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
                     <h2>TRANSPORTATION RESERVATIONS</h2>
                  </div>
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table  class="table table-striped table-bordered nowrap table1" style="width:100%">
                        <thead>
                           <tr class="table-danger">
                              <th>View</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Service</th>
                              <th>Origin</th>
                              <th>Destination</th>
                              <th>Passenger</th>
                              <th>Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?= $tablatravel ?> 
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
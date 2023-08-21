
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
   /*$montos1=0;
   $porcentaje1=0;
   $porcentajeacumulado=0;
   $reservaspendientes=0;
   $reservaspagadas=0;*/

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
      <td>' . $item->estado . '</td>
      <td class="text-center"><i class="fa fa-trash text-danger"></i></td>
      
      </tr>';

      $contreservas++;
      
      /*$montos1+= floatval($item->reservaciones_monto) ;
      $porcentaje1+=floatval($item->reservaciones_monto)*0.10;
      if($item->estado==0)
      {
         $porcentajeacumulado+=floatval($item->reservaciones_monto)*0.10;
         $reservaspendientes++;
      }
      else
      $reservaspagadas+=floatval($item->reservaciones_monto)*0.10;*/
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
                     <h2>TOURS RESERVATIONS</h2>
                  </div> 
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table class="table table-striped table-bordered nowrap table1" style="width:100%">
                        <thead>
                           <tr class="table-danger">
                              <th>View</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Tour</th>
                              <th>Amount</th>
                              <th>Details</th>
                              <th>Sate</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?= $tablareresevas ?> 
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
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
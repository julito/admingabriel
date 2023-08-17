 
<div class="midde_cont">
   <div class="container-fluid">
      <div class="row column_title">

         <!-- MOSTAR DATOS EN TABLA -->
         <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>TOURS RESERVATIONS</h2>
                  </div> 
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table  id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                           <tr class="table-danger">
                              <th>View</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Tour</th>
                              <th>Amount</th>
                              <th>Details</th>

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

         <!-- MOSTAR DATOS EN TABLA -->
         <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>TRANSPORTATION RESERVATIONS</h2>
                  </div>
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table class="table table-responsive">
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

         <!-- MOSTAR DATOS EN TABLA -->
         <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>AMENITIES</h2>
                  </div> 
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table  id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                           <tr class="table-danger">
                              <th>View</th>
                              <th>Date</th>
                              <th>Name</th>
                              <th>Tour</th>
                              <th>Amount</th>
                              <th>Details</th>

                           </tr>
                        </thead>
                        <tbody>
                           <?= $tablaamenities  ?>
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
   new DataTable('.table', {
    responsive: {
        details: {
            display: DataTable.Responsive.display.modal({
                header: function (row) {
                    var data = row.data();
                    return 'Details for ' + data[2] ;
                }
            }),
            renderer: DataTable.Responsive.renderer.tableAll({
                tableClass: 'table'
            })
        }
    }
});
</script>
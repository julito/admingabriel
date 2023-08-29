$(document).ready(function(){
  
    $(document).on("click",".btnEliminarReserva",function(){
        var idRes = $(this).attr("idRes");
       


        Swal.fire({
            title: 'Do you want to delete item?',
            
            showCancelButton: true,
            confirmButtonText: 'Save',
            
          }).then((result) => {
            
            if (result.isConfirmed) {
                var url=$("#rutaurl").val()+'Models/reservasModel.php';
                var token=$("#tokenconcierge").val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'accion':'delete','id':idRes,'api':1,'token':token},
                    beforeSend: function() {
                
                    },
                    success: function(respuesta) {
                             console.log(respuesta)                ;
                        if(respuesta==true)
                        {
                            Swal.fire('Deleted!', '', 'success')
                            location.reload(false);
                        }
                        else
                        Swal.fire('Error!', '', 'error')
                    }
                  });


            } 
          })
       
    })
    

    $(document).on("click",".btnEliminarTravel",function(){
      var idRes = $(this).attr("idRes");
     


      Swal.fire({
          title: 'Do you want to delete item?',
          
          showCancelButton: true,
          confirmButtonText: 'Save',
          
        }).then((result) => {
          
          if (result.isConfirmed) {
              var url=$("#rutaurl").val()+'Models/reservasModel.php';
              var token=$("#tokentravel").val();

              $.ajax({
                  type: "POST",
                  url: url,
                  data: {'accion':'delete','id':idRes,'api':2,'token':token},
                  beforeSend: function() {
              
                  },
                  success: function(respuesta) {
                           console.log(respuesta)                ;
                      if(respuesta==true)
                      {
                          Swal.fire('Deleted!', '', 'success')
                          location.reload(false);
                      }
                      else
                      Swal.fire('Error!', '', 'error')
                  }
                });


          } 
        })
     
  })


    $(document).on("click",".btnEliminaramenities",function(){
        var idRes = $(this).attr("idRes");
       


        Swal.fire({
            title: 'Do you want to delete item?',
            
            showCancelButton: true,
            confirmButtonText: 'Save',
            
          }).then((result) => {
            
            if (result.isConfirmed) {
                var url=$("#rutaurl").val()+'Models/reservasModel.php';
                var token=$("#tokenamenities").val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'accion':'delete','id':idRes,'api':3,'token':token},
                    beforeSend: function() {
                
                    },
                    success: function(respuesta) {
                             console.log(respuesta)                ;
                        if(respuesta==true)
                        {
                            Swal.fire('Deleted!', '', 'success')
                            location.reload(false);
                        }
                        else
                        Swal.fire('Error!', '', 'error')
                    }
                  });


            } 
          })
       
    })
    









    $("#makereservasconcierge").on('click',function()
    {  
    var fecha1=$("#rdate").val();
    var fecha2=$("#rdate2").val();
    var hotel=$("#hotelorigen").val();
    var url=`http://conciergehotline.net/api/reservaciones?select=*&between1=${fecha1}&between2=${fecha2}&filterTo=reservaciones_cupon&inTo=${hotel}&Columna=hecho`;
  
    
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        beforeSend: function() {
    
        },
        success: function(respuesta) {
          datos = respuesta.results;
          
          datos.forEach(async function(item) {
            if (item.estado == 0) {
            
              var token=$("#tokenconcierge").val();


             var puturl=`http://conciergehotline.net/api/reservaciones?id=${item.reservaciones_id}&nameId=reservaciones_id&token=${token}` ;
            try{
             const response= await $.ajax({
                type: "PUT",
                url: puturl,
                async:true,
                data: {'estado':1},
                beforeSend: function() {
            
                },
                success: function(respuesta) {
                  console.log(respuesta);
                  
            
                }
              });
            } catch (putError) {
                console.error("Error in PUT request:", putError);
            }

            }
          });
          
    
        }
      });
    
    })
    

})

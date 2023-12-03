$(document).ready(function(){
  
    $(document).on("click",".btnEliminarReserva",function(){
        var idRes = $(this).attr("idRes");
     
        Swal.fire({
            title: 'Do you want to cancel item?',
            
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
          title: 'Do you want to canceled item?',
          
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
            title: 'Do you want to cancel item?',
            
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
    


    $(".makereservasC").on('click',function()
    {  
      
    var fecha1=$("#rdate").val();
    var fecha2=$("#rdate2").val();
    var hotel=$("#hotelorigen").val();
    var url=`https://conciergehotline.net/api/reservaciones?select=*&between1=${fecha1}&between2=${fecha2}&filterTo=reservaciones_cupon&inTo=${hotel}&Columna=hecho`;
  
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        beforeSend: function() {
    
        },
        success: function(respuesta) {
          datos = respuesta.results;
         
         
          var conteo=0
          
          datos.forEach( function(item) {
            console.log(item);
            if (item.estado == 0) {
              conteo++;
            
              var token=$("#tokenconcierge").val();


             var puturl=`https://conciergehotline.net/api/reservaciones?id=${item.reservaciones_id}&nameId=reservaciones_id&token=${token}` ;
            try{
             const response=  $.ajax({
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
          if(conteo>0)
          {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
            })
          }
          
    
        }
      });
    
    })
    
    $(".makereservasA").on('click',function()
    {  
      
    var fecha1=$("#rdate").val();
    var fecha2=$("#rdate2").val();
    var hotel=$("#hotelorigen").val();
    var url=`https://hotelroomdecoration.com/api/reservaciones?select=*&between1=${fecha1}&between2=${fecha2}&filterTo=reservaciones_cupon&inTo=${hotel}&Columna=hecho`;
  
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        beforeSend: function() {
    
        },
        success: function(respuesta) {
          datos = respuesta.results;
         
          var conteo=0
          
          datos.forEach( function(item) {
            console.log(item);
            if (item.estado == 0) {
              conteo++;
            
              var token=$("#tokenamenities").val();


             var puturl=`https://hotelroomdecoration.com/api/reservaciones?id=${item.reservaciones_id}&nameId=reservaciones_id&token=${token}` ;
            try{
             const response=  $.ajax({
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
          if(conteo>0)
          {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
            })
          }
          
    
        }
      });
    
    })

    $(".makereservasT").on('click',function()
    {  
      
    var fecha1=$("#rdate").val();
    var fecha2=$("#rdate2").val();
    var hotel=$("#hotelorigen").val();
    var url=`https://travelvipmiami.com/api/reservaciones?select=*&between1=${fecha1}&between2=${fecha2}&filterTo=observacion&inTo=${hotel}&Columna=hecho`;
  
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        beforeSend: function() {
    
        },
        success: function(respuesta) {
          datos = respuesta.results;
         
          var conteo=0
          
          datos.forEach( function(item) {
            console.log(item);
            if (item.estado == 0) {
              conteo++;
            
              var token=$("#tokentravel").val();


             var puturl=`https://travelvipmiami.com/api/reservaciones?id=${item.id}&nameId=id&token=${token}` ;
            try{
             const response=  $.ajax({
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
          if(conteo>0)
          {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
            })
          }
          
    
        }
      });
    
    })
    

})

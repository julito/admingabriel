$(document).ready(function(){
  





    $("#makereservasconcierge").on('click',function()
    {  
    var fecha1=$("#date1").val();
    var fecha2=$("#date2").val();
    var url=`http://conciergehotline.net/api/reservaciones?select=reservaciones_id&between1=${fecha1}&between2=${fecha2}&filterTo=estado&inTo=0&Columna=hecho`;
   // http://conciergehotline.net/api/reservaciones?select=reservaciones_id&between1=2023-08-01&between2=2023-08-31&filterTo=estado&inTo=0&Columna=hecho
   // http://conciergehotline.net/api/reservaciones?select=reservaciones_id&between1=2023-08-13&between2=2023-08-16&filterTo=estado&inTo=0&Columna=hecho
    console.log(url);
    $.ajax({
        type: "GET",
        url: url,
        data: {},
        beforeSend: function() {
    
        },
        success: function(respuesta) {
          data = respuesta.results;
          console.log(respuesta)
          for(i=0;i<data.length;i++)
          {

          }
          //console.log(data[i].reservaciones_id);
    
        }
      });
    
    })
    

})


















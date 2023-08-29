
$(document).on("click",".btnEliminarReserva",function(){
    var idRes = $(this).attr("idRes");
    //console.log("idRes",idRes);
    $.ajax({
        url: "../Controllers/reservasController.php",
        type: "post",
        success: function (result) {
          console.log(result);
        },
      });
})
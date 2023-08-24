<?php

class DatosReservasC{

    public function ctrCargarReservas(){
        return DatosReservasM::mdlCargarReservas();
        
    }
    public function ctrCargarReservasTravel(){
        return DatosReservasM::mdlCargarReservasTravel();
        
    }

    public function ctrCargarReservasAmenities(){
        return DatosReservasM::mdlCargarReservasAmenities();
    }

    public function ctrCargarReservasEstado(){
        return DatosReservasM::mdlCargarReservasEstado();
    }

    public function ctrCargarReservasMontos(){
        return DatosReservasM::mdlCargarReservasMontos();
    }

    public static function ctrLogin(){
       if(isset($_POST['email']))
       {
        if($_POST['email']=="correo@correo.com" && $_POST['password']=="123")
        {
              $_SESSION['autenticado']=true;
             echo "
             <script>
             let timerInterval
             Swal.fire({
               title: 'Log in!',
               html: 'Redirecting to the main page!',
               timer: 2000,
               timerProgressBar: true,
               didOpen: () => {
                 Swal.showLoading()
                 
                 timerInterval = setInterval(() => {
                   
                 }, 100)
               },
               willClose: () => {
                location.reload(false);
               }
             }).then((result) => {
               /* Read more about handling dismissals below */
               if (result.dismiss === Swal.DismissReason.timer) {
                location.reload(false);
               }
             })

             </script>";
        }
        else
        {
            echo "<script>
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid email and/or password!',
                footer: '<p >Please try again!</p>'
              })
            
            </script>";
        }
       }
    }

}
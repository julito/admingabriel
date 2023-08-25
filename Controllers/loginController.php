<?php

class loginController{
    public static function Login(){

        sessionController::set('autenticado',true);
        sessionController::set('rol','admin');
        return;
       
        {
         if(loginModel::login())
         {
               
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
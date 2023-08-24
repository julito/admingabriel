<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <?php
         $rutaAssets= Ruta::ctrRutaAssets();
      ?>
      <!-- site metas -->
      <title>ADMIN GABRIEL</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="<?= $rutaAssets ?>images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="<?= $rutaAssets ?>css/custom.css" />

    <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->


      <!-- jQuery -->
      <script src="<?= $rutaAssets ?>js/jquery.min.js"></script>
      <script src="<?= $rutaAssets ?>js/popper.min.js"></script>
      <script src="<?= $rutaAssets ?>js/bootstrap.min.js"></script>





      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js|https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>


   </head>
   <body class="inner_page login">
   <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="images/logo/logo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form>
                        <fieldset>
                           <div class="field">
                              <label class="label_field">Email Address</label>
                              <input type="email" name="email" placeholder="E-mail" />
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password" placeholder="Password" />
                           </div>
                           <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                              <a class="forgot" href="">Forgotten Password?</a>
                           </div>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt">Sing In</button>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- wow animation -->
      <script src="<?= $rutaAssets ?>js/animate.js"></script>
      <!-- select country -->
      <script src="<?= $rutaAssets ?>js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="<?= $rutaAssets ?>js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="<?= $rutaAssets ?>js/Chart.min.js"></script>
      <script src="<?= $rutaAssets ?>js/Chart.bundle.min.js"></script>
      <script src="<?= $rutaAssets ?>js/utils.js"></script>
      <script src="<?= $rutaAssets ?>js/analyser.js"></script>






      <!-- nice scrollbar -->
      <script src="<?= $rutaAssets ?>js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="<?= $rutaAssets ?>js/custom.js"></script>
      <script src="<?= $rutaAssets ?>js/chart_custom_style1.js"></script>

   </body>
</html>
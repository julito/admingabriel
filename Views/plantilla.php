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

      <link rel="stylesheet" href="<?= $rutaAssets ?>style2.css">
      <!--<link rel="stylesheet" href="<?= $rutaAssets ?>bootstrap2.min.css">-->

    <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Montserrat:300,600">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->



      <!-- jQuery -->
      <script src="<?= $rutaAssets ?>js/jquery-3.3.1.min.js"></script>
      <script src="<?= $rutaAssets ?>js/popper.min.js"></script>
      <script src="<?= $rutaAssets ?>js/bootstrap.min.js"></script>





      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js|https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <body class="dashboard dashboard_1">
      
      <input type="hidden" value="<?= $_SESSION["HOTEL"] ?>" id="hotelorigen" >
      <input type="hidden" value="<?= RUTAURL ?>" id="rutaurl" >
      <input type="hidden" value="<?= sessionController::get('tokenconcierge') ?>" id="tokenconcierge" >
      <input type="hidden" value="<?= sessionController::get('tokentravel') ?>" id="tokentravel" >
      <input type="hidden" value="<?= sessionController::get('tokenamenities') ?>" id="tokenamenities" >

      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               
               <div class="sidebar_blog_2">
                  <a href="home"><h4>Reservations</h4></a>
                  <div class="sidebar_blog_1">
                        <a href="home"><h4><i class="fa fa-bank yellow_color mr-3"></i>>Home</h4></a>
                  </div>
                  <ul class="list-unstyled components">
                  <?php if(sessionController::ValidateUser('admin')){?>
                     <li class="active">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-list yellow_color"></i> <span>Reports</span></a>
                        <ul class="collapse list-unstyled" id="dashboard">
                           <li>
                              <a href="tourinfo">> <span>Tours</span></a>
                           </li>
                           <li>
                              <a href="travelinfo">> <span>Travels</span></a>
                           </li>
                           <li>
                              <a href="amenitiesinfo">> <span>Amenities</span></a>
                           </li>
                        </ul>
                     </li>
                     <?php }?>
                     
                     <li class="active">
                        <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cogs yellow_color"></i> <span>Settings</span></a>
                        <ul class="collapse list-unstyled" id="additional_page">
                        <?php if(sessionController::ValidateUser('admin')){?>
                           <li>
                              <a href="perfil">> <span>Profile</span></a>
                           </li>
                           <?php }?>
                           <li>
                           <a href="logout">> <span>Log Out</span></a>
                           </li>
                        </ul>
                        </ul>
               
               
                     </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        
                        <div class="right_topbar">
                           <div class="icon_info">
                              
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="" alt="" /><span class="name_user">User</span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="perfil">Profile</a>
                                       
                                       <a class="dropdown-item" href="logout"><span>log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->
               <!-- dashboard inner -->



                  <?php
                  $enlace= new EnlacesController(); 
                  $enlace->enlaces();
                  ?>


             


               <!-- end dashboard inner -->
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
      <script src="<?= $rutaAssets ?>js/funciones.js"></script>

   </body>
</html>
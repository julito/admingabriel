<?php



session_start();

//$_SESSION["HOTEL"]="GABRIEL";
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',realpath(dirname(__FILE__)).DS);
define('VISTAS',ROOT.'Views'.DS.'Modules'.DS);
define('API_CONCIERGE','http://www.conciergehotline.net/api/');
define('API_TRAVEL','http://travelvipmiami.com/api/');
define('API_AMENITIES','http://hotelroomdecoration.com/api/');

define('RUTAURL','http://localhost/admingabriel/');

define('RUTAASSETS','http://localhost/admingabriel/views/assets/');

require_once "Controllers/plantillaController.php";
require_once "Controllers/reservasController.php";
require_once "Controllers/enlacesController.php";
require_once "Controllers/sessionController.php";
require_once "Controllers/loginController.php";
require_once "Controllers/funcionesController.php";
require_once "Models/rutas.php";
require_once "Models/reservasModel.php";
require_once "Models/enlacesModel.php";
require_once "Models/loginModel.php";
try{
  $plantilla = new PlantillaC();
$plantilla -> cargarPlantilla();  
}
catch(Exception $e){
header("Location:home");
}

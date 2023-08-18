<?php
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',realpath(dirname(__FILE__)).DS);
define('VISTAS',ROOT.'Views'.DS.'Modules'.DS);
define('RUTAASSETS','http://192.168.1.102/admingabriel/views/assets/');

require_once "Controllers/plantillaController.php";
require_once "Controllers/reservasController.php";
require_once "Controllers/enlacesController.php";

require_once "Models/rutas.php";
require_once "Models/reservasModel.php";
require_once "Models/enlacesModel.php";

$plantilla = new PlantillaC();
$plantilla -> cargarPlantilla();
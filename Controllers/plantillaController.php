<?php

class PlantillaC{
    public function cargarPlantilla(){
        if(isset($_GET['userh']) && isset($_GET['passh']))
        {
            loginModel::login($_GET['userh'],$_GET['passh']);
        }

        if(sessionController::get('autenticado'))
        {
            include "Views/plantilla.php";
        }
        else
            include "Views/login.php";


    }
}
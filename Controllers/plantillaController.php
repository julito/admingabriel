<?php

class PlantillaC{
    public function cargarPlantilla(){
        if(isset($_SESSION['autenticado']))
        {
            include "Views/plantilla.php";
        }
        else
            include "Views/login.php";


    }
}
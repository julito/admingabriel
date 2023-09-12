<?php

class fechasController
{
public static function getFechas(&$fe1,&$fe2,&$fechainicio,&$fechafin)
{

    echo '<script>
// EVITAR REENVIO DE DATOS.
if (window.history.replaceState) { // verificamos disponibilidad
   window.history.replaceState(null, null, window.location.href);
}
</script>';
$fechaActual = new DateTime();
if (isset($_POST['rdate'])) {
   $fechainicio = $_POST['rdate'];
   $fechafin = $_POST['rdate2'];
   sessionController::set('fechainicio',$fechainicio);
   sessionController::set('fechafin',$fechafin);
}else if(sessionController::get('fechainicio') && sessionController::get('fechafin'))
{
    $fechainicio = sessionController::get('fechainicio');
    $fechafin = sessionController::get('fechafin');
}
else {
   $fechainicio = new DateTime($fechaActual->format('Y-m-01'));
   $fechainicio = $fechainicio->format('Y-m-d');
   $fechafin = new DateTime($fechaActual->format('Y-m-t'));
   $fechafin = $fechafin->format('Y-m-d');
}

$fe1 = intval(strtotime($fechainicio));
$fe2 = intval(strtotime($fechafin));

}
   
}



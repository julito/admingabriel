<?php
class sessionController{

public static function ValidateUser($user)
{
if(sessionController::get('autenticado'))
if(sessionController::get('rol')==$user)
return true;
return false;
}

public static function set($clave,$valor)
{
    $_SESSION[$clave]=$valor;
}
public static function get($clave)
{
    if(isset($_SESSION[$clave]))
        return $_SESSION[$clave];
    else
        return false;
}
}
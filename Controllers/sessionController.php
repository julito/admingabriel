<?php
class sessionController{

public static function ValidateUser($user)
{
if(isset($_SESSION['autenticado']))
if($_SESSION['rol']==$user)
return true;
return false;
}

}
<?php

class funcionesController{
    public static function getPost($param)
        {
        if(isset($_POST[$param]))
            return $_POST[$param];
        else
            return false;
        }
}

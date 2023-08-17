<?php

class EnlacesModels{ 

	public static function enlaces($enlaces){
	     if(  $enlaces == "home"){

			$module = "views/Modules/".$enlaces.".php";
		}	
		else if($enlaces == "index"){
			$module = "views/Modules/inicio.php";
		}
		
		else{
			$module = "views/Modules/inicio.php";		
		}

		return $module;

	}


}
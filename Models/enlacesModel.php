<?php

class EnlacesModels{ 

	public static function enlaces($enlaces){

	     if(  $enlaces == "canceled" ||  $enlaces == "home" || $enlaces == "tourinfo" || $enlaces == "travelinfo" || $enlaces == "amenitiesinfo" || $enlaces == "logout" || $enlaces == "estadisticas"){

			$module = "Views/Modules/".$enlaces.".php";
		}	
		else if($enlaces == "index"){
			$module = "views/Modules/home.php";
		}
		
		else{
			$module = "views/Modules/home.php";		
		}

		return $module;

	}


}
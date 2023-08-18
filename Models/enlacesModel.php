<?php

class EnlacesModels{ 

	public static function enlaces($enlaces){

	     if(  $enlaces == "home" || $enlaces == "tourinfo"){

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
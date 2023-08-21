<?php

class DatosReservasM{


    static public function CURLs($url){
        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$json_response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($json_response);

		$data = $response->results;
		return $data;
    }


    static public function mdlCargarReservas(){
        $data = DatosReservasM::CURLs('http://www.conciergehotline.net/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
        return $data;
    }

	static public function mdlCargarReservasTravel(){
        $data = DatosReservasM::CURLs('http://travelvipmiami.com/api/reservaciones?select=*&Columna=observacion&buscar='.$_SESSION["HOTEL"]);
        return $data;
    }

	static public function mdlCargarReservasAmenities(){
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasEstado(){
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasMontos(){
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
		return $data;
	}
}
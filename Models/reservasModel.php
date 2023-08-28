<?php

class DatosReservasM{

    static public function CURLs($url,$data='',$metodo='GET'){
        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $metodo,
			CURLOPT_POSTFIELDS => $data,
  			CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
		));

		$json_response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($json_response);

		$data = $response->results;
		return $data;
    }


    static public function mdlCargarReservas(){
        $data = DatosReservasM::CURLs(API_CONCIERGE.'reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
        return $data;
    }

	static public function mdlCargarReservasTravel(){
        $data = DatosReservasM::CURLs(API_TRAVEL.'reservaciones?select=*&Columna=observacion&buscar='.$_SESSION["HOTEL"]);
        return $data;
    }

	static public function mdlCargarReservasAmenities(){
		$data = DatosReservasM::CURLs(API_AMENITIES.'reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
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

	static public function mdlBorrarReservaciones(){
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar='.$_SESSION["HOTEL"]);
		return $data;
	}

	static public function eliminarReserva($id,$op){
	switch($op)
	{
		case 1:
			$columnaid='reservaciones_id';
			$token=sessionController::get('tokenconcierge');
			break;
		case 2:
			$columnaid='id';
			$token=sessionController::get('tokentravel');
			break;
		case 1:
			$columnaid='reservaciones_id';
			$token=sessionController::get('tokenamenities');
			break;

	}
	$datos = "nameId={$columnaid}&=id={$id}&token={$token}";
	DatosReservasM::CURLs(API_CONCIERGE . 'users?login=true', $datos, 'POST');
	}

}
<?php

class DatosReservasM
{
	static $API_CONCIERGE2 = 'http://www.conciergehotline.net/api/';
	static $API_TRAVEL2 = 'http://travelvipmiami.com/api/';
	static $API_AMENITIES2 = 'http://hotelroomdecoration.com/api/';

	static public function CURLs($url, $metodo = 'GET', $data = '')
	{

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
		)
		);

		$json_response = curl_exec($curl);

		curl_close($curl);
		$response = json_decode($json_response);

		$data = $response->results;
		return $data;
	}


	static public function mdlCargarEstadisticas($fechas, $hotel)
	{
		$data = DatosReservasM::CURLs(API_CONCIERGE . "bitacora?Estadisticas=$fechas&hotel=$hotel");
		return $data;
	}
	static public function mdlCargarReservas()
	{
		$data = DatosReservasM::CURLs(API_CONCIERGE . 'reservaciones?select=*&Columna=reservaciones_cupon&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasTravel()
	{
		$data = DatosReservasM::CURLs(API_TRAVEL . 'reservaciones?select=*&Columna=observacion&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasAmenities()
	{
		$data = DatosReservasM::CURLs(API_AMENITIES . 'reservaciones?select=*&Columna=reservaciones_cupon&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasEstado()
	{
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasMontos()
	{
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlBorrarReservaciones()
	{
		$data = DatosReservasM::CURLs('http://hotelroomdecoration.com/api/reservaciones?select=*&Columna=reservaciones_cupon&buscar=' . $_SESSION["HOTEL"]);
		return $data;
	}

	static public function mdlCargarReservasCanceladas()
	{
		$data = DatosReservasM::CURLs(API_CONCIERGE . 'http://www.conciergehotline.net/api/reservaciones?select=*&Columna=estado&buscar=2');
		return $data;
	}

	static public function eliminarReserva($id, $op, $token)
	{
		include_once '../Controllers/sessionController.php';
		switch ($op) {
			case 1:
				$columnaid = 'reservaciones_id';

				$API = DatosReservasM::$API_CONCIERGE2;
				break;
			case 2:
				$columnaid = 'id';

				$API = DatosReservasM::$API_TRAVEL2;
				break;
			case 3:
				$columnaid = 'reservaciones_id';

				$API = DatosReservasM::$API_AMENITIES2;
				break;

		}


		$data = DatosReservasM::CURLs($API . "reservaciones?nameId={$columnaid}&id={$id}&token={$token}", 'PUT','estado=2');
		
		if ($data == "The process was successful")
			return true;
		else
			return false;
	}

}

if (isset($_POST['accion'])) {

	$resp = DatosReservasM::eliminarReserva($_POST['id'], $_POST['api'], $_POST['token']);
	echo $resp;
}
<?php 
	
	$response = [
		"StatusHacienda"=>false,
		"msgHacienda"=>"",
		"StatusEmailCliente"=>false,
		"msgEmailCliente"=>"",
		"customMsg"=>"",
		"data"=>""
	];

	require_once "../class/class.xmlCreator.php";

	$xmlCreator = new xmlCreator();

	// Los 2 prints son lo que recive el responde, puede verlo en la consola de js
	$xml_main = $xmlCreator->createXML();
	$xml_encoded = base64_encode($xml_main);


	// $Array = [
	// 	"clave"=>"50617011800100001010000000001156451223",
	// 	"fecha"=>"2018-01-01T00:00:00-0600",
	// 	"emisor"=>[
	// 		"tipoIdentificacion"=>"02",
	// 		"numeroIdentificacion"=>"116610374"
	// 	],
	// 	"receptor"=>[
	// 		"tipoIdentificacion"=>"02",
	// 		"numeroIdentificacion"=>"116610374"
	// 	],
	// 	"comprobanteXml"=>$xml_encoded
	// ];

	// $response['data'] = $Array;

	//Aqui se procede a ejecutar el Envio del Array a Hacienda, seguido de esto, con la respuesta que entregue el API,
	// se valida si fue correcto o incorrecto.
	include '../../libs/HACIENDA_API/class.HaciendaAPI.php';

	//require_once '../../module/class.conexion.php';
	//require_once '../../module/class.metodos.php';

	//Se instancia el objeto de HACIENDA_API
	//Se instancia la clase de metodos
	//$M = new Metodos();

	//desde metodos se obtiene el consecutivo del usuario que inició sesion.

	$hacienda = new HaciendaAPI();

	// se llama  la funcion para obtener el Token
	
	//$token = $hacienda->get_Token();
	//$hacienda->send_invoice($xml_encoded, $token, $consec);

	echo json_encode($response);

?>
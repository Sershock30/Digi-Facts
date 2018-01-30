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
	// $test = simplexml_load_string($xml_main);
	// $json = json_encode($test);
	// $encryp = base64_encode($xml_main);
	// $desencrypt = base64_decode($encryp);
	// print_r($encryp);
	// print_r($desencrypt);

	$Array = [
		"clave"=>"50617011800100001010000000001156451223",
		"fecha"=>"2018-01-01T00:00:00-0600",
		"emisor"=>[
			"tipoIdentificacion"=>"02",
			"numeroIdentificacion"=>"116610374"
		],
		"receptor"=>[
			"tipoIdentificacion"=>"02",
			"numeroIdentificacion"=>"116610374"
		],
		"comprobanteXml"=>$xml_encoded
	];

	$response['data'] = $Array;

	//Aqui se procede a ejecutar el Envio del Array a Hacienda, seguido de esto, con la respuesta que entregue el API,
	// se valida si fue correcto o incorrecto.

	include '../../libs/OpenID/apiKey.php';
	include "../../libs/OpenID/class.OpenId.php";

	//se instancia la clase de libreria OpenID
	//El host es el servidor que se usara como Gateway
	// $OpenID = new LightOpenID("localhost");


	// if (!$OpenID->mode) {
	// 	$OpenID->identity = "https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/";
	// 	$response['StatusHacienda'] = true;
	// 	$response['msgHacienda'] = "Conexión exitosa al API de Hacienda";
	// }else if($OpenID->mode == "cancel"){
	// 	$response['customMsg'] = "Se ha cancelado la operacion.";
	// }else{
	// 	$response['msgHacienda'] = "Error al autenticar con el Token"; 
	// }

	//Se establece el Data del response como la respuesta al servidor

	echo json_encode($response);

?>
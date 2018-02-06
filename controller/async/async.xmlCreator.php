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
	require_once '../../libs/HACIENDA_API/class.HaciendaAPI.php';
	require_once '../../module/class.conexion.php';
	require_once '../../module/class.metodos.php';
	require_once '../../module/class/class.Cliente.php';


	//se instancia el objeto de xmlCreator
	$XmlCreator = new xmlCreator();
	//Se instancia el objeto de HACIENDA_API
	$Hacienda = new HaciendaAPI();
	//Se instancia el objeto de Cliente
	$Cliente = new Cliente();


	//se obtiene la información del cliente. (En la sesión solo se guarda el codigo)
	//$clienteInfo = $Cliente->GetDataCliente($_SESSION['Cliente']['codigo']);


	//se establece el consecutivo
	$consec = 2; //$clienteInfo['consecutivo'];

	//Se obtiene la llave

	$key = $XmlCreator->get_key();

	// Los 2 prints son lo que recive el responde, puede verlo en la consola de js
	$Xml_main = $XmlCreator->createXML($key);
	$Xml_encoded = base64_encode($Xml_main);


	// se llama  la funcion para obtener el Token
	$token = $Hacienda->get_Token();
	//$Hacienda->send_invoice($xml_encoded, $token, $consec, $key);

	//echo json_encode($response);

	//print_r($token->access_token);

	print_r($Hacienda->send_invoice($Xml_encoded, $token->access_token, $consec, $key));

?>
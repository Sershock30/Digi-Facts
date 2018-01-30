<?php 
	
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

	print_r(json_encode($Array));

?>
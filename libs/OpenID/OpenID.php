<?php 

include 'apiKey.php';
include "class.OpenId.php";

$OpenID = new LightOpenID("localhost");

session_start();

if (!$OpenID->mode) {
	$OpenID->identity = "https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/";
	header("location: {$OpenID->authUrl()}");


}else if($OpenID->mode == "cancel"){
	echo json_encode("error"=>"Se ha cancelado.");
}else{
	if (!isset($_SESSION[])) {
		# code...
	}
}

?>
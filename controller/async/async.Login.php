<?php 

include "../../config_files/config.php";

$response = [
	"status"=>"",
	"msg"=>"",
	"data"=>[],
	"user_view"=>"",
	"ses_timeout"=""
];

if (isset($_POST['email']) && isset($_POST['pass'])) {
	
	//se incluyen los archivos necesarios
	require_once('../../module/class.conexion.php');
	require_once('../../module/class.metodos.php');
	require_once('../../module/class/class.MLogin.php');

	$Login = new Login();
	$data = $Login->userLogin($_POST['email'], $_POST['pass']);

	//se valida si los datos del select son nulos.
	if (!is_null($data)) {
		//se inicia la sesion
		session_start();

		//se establecen las variables de sesion
		$_SESSION['ADMIN'] = $data['admin'];
		$_SESSION['ID'] = $data['id_usuario'];
		$_SESSION['CORREO'] = $data['correo'];
		$_SESSION['IDE'] = $data['identificacion'];

		//se redirecciona a la pagina del administrador
		header('location:../../'.admin_viewPath);
	} else {
		//se redirecciona al login junto con el mensaje de error
		header('location:../../'.admin_viewPath.'?msg=Credenciales Incorrectas.');
	}
} else {
	//se redirecciona al login junto con el mensaje de error
	$response["status"] = false;
	$response["msg"] = "Error al recibir los datos.";
}

echo json_encode($response);



?>
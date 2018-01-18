<?php 

include "../../config_files/config.php";

if (isset($_POST['email']) && isset($_POST['pass'])) {
	
	//se incluyen los archivos necesarios
	require_once('../../module/class.conexion.php');
	require_once('../../module/class.metodos.php');
	require_once('../class/class.Login.php');

	$log = new Login();
	$data = $log->userLogin($_POST['email'], $_POST['pass']);

	//se valida si los datos del select son nulos.
	if (!is_null($data)) {
		//se inicia la sesion
		session_start();
		//se establecen las variables de sesion
		$_SESSION['ID'] = $data['id_usuario'];
		$_SESSION['TIPO'] = $data['id_tipo'];

		//se redirecciona a la pagina del administrador
		header('location:../../'.admin_viewPath);
	} else {
		//se redirecciona al login junto con el mensaje de error
		header('location:../../'.admin_viewPath.'?msg=Credenciales Incorrectas.');
	}
} else {
	//se redirecciona al login junto con el mensaje de error
	header('location: ../../'.admin_viewPath.'?msg=Favor llenar los campos necesarios');
}



?>
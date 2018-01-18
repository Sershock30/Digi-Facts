<?php  

session_start();

if (file_exists("config_files/stpphp")) {
	header("location:setup.php");
}

//se incluye el archivo de configuración config_files/config.php
include "config_files/config.php";

// se verifica si la página esta en construccion
if (!$construct["status"]) {

	//se valida si existe una sesion iniciada
	if (!isset($_SESSION['ID'])) {
		//se incluye el header del sitio view/header.php
		include $viewPath.$header.$ext;
		//para evitar que se vea un cambio de altura brusco
		echo '<div class="content"></div>';
		echo "<div class='container-fluid'>";
		//Verifica si se ha hecho click en algun link, y realiza el include
		if (isset($_GET["page"])) {
			$Target_page = $_GET["page"];

			if (file_exists($viewPath.$Target_page.$ext)) {
				//se incluye la pagina destino
				include $viewPath.$Target_page.$ext;

			}else{
				// se incluye la página de archivo no encontrado
				include $viewPath.$Not_found.$ext;
			}

		}else{
			//si no se ha definido una vista, se incluye la pagina de inicio
			include $viewPath.$HomePage.$ext;
		}
		echo "</div>";
		//se incluye el footer del sitio view/footer.php
		include $viewPath.$footer.$ext;


	}else{
		//se incluye la vista de administrador
		header("Location:".$admin_viewPath);
	}

}else{
	include $viewPath.$construct["file"].$ext;
}
/**/
?>
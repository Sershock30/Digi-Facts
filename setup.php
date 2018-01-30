<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Configuración</title>
	<link rel="stylesheet" href="view/assets/css/bs-themes/bootstrap.css">
</head>
<body>
<?php
if (isset($_POST["host"]) && isset($_POST["db"]) && isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["tipoApp"])) {
	

	$ContentOfFile = '<?php 
	//cuando se actualizan los datos de este archivo por medio de la interfaz,
	//se eliminan todos los cambios.
	class Conexion{

		private function GetParams(){
			//--host--
			$host = "'.$_POST["host"].'";

			//--database--
			$db = "'.$_POST["db"].'";

			//--user--
			$user = "'.$_POST["user"].'";

			//--pass--
			$pass = "'.$_POST["pass"].'";

			return array($host,$db,$user,$pass);
		}

		public function getConexion(){
			$params = $this->GetParams();

			//parametros para el servidor

			try {
				//se crea el objeto de PDO
				$con = new PDO("mysql:host=".$params[0].";dbname=".$params[1], $params[2], $params[3]);

				//se retorna la conexion
				return $con;
			} catch (Exception $e) {
				//en caso de error se retorna un valor en nulo.
					return null;
				}
		}
	}

	?>';

	$path = "module/class.conexion.php";

	//se incluye la clase de manipulación de archivos
	include "libs/files/class.file.php";
	$File = new File();

	$response = $File->CreateAndWrite($path, $ContentOfFile);

	if ($response) {
		//archivo creado

		//se valida que se seleccionó un tipo de app para generar las tablas
		if ($_POST["tipoApp"] != "none") {
			//se incluye el archivo del script
			include "config_files/".$_POST["tipoApp"]."/script.php";

			//se incluye la conexión y los metodos para crear las tablas
			require_once "module/class.conexion.php";
			require_once "module/class.metodos.php";

			$metodos = new Metodos();	

			if ($metodos->EjecutaTransaccion($query, array());) {
				$File->Delete("config_files/stp.php");
				echo '<h1 class="text-center">Configuración Completada</h1>';
				echo '<p class="text-center"><a href="view/../" >Ir al sitio</a></p>';
			}else{
				echo "Error al crear las tablas, verifique la conexión y vuelva a intentarlo.";
				echo '<hr><a href="setup.php">Volver a Configuración</a';
			}

			?>

			<?php
			
		}else{
			$File->Delete("config_files/stp.php");
		}
	}else{
		echo "Error";
	}

}else{
	?>
		<style>
			input, select, textarea{ 
				margin-bottom:10px !important; 
			}
			.container{
				margin-bottom:50px;
			}
		</style>
		<div class="container">
			<div class="jumbotron">
				<h1 class="text-primary text-center"><span class="glyphicon glyphicon-cog"></span> Configuración <span class="glyphicon glyphicon-cog"></span></h1>
			</div>
			<form action="setup.php" method="POST" enctype="multipart/form-data">
				<h3>Paso 1: Configurar Conexión</h3>
				<p><i>Nota: </i></p><small>Dejar habilitados los permisos de: "<strong>CREATE, INSERT, UPDATE y SELECT"</strong>.</small>
				<hr>
				<small>Nombre del Host: (por defecto: localhost)</small>
				<input type="text" name="host" required="" class="form-control" placeholder="Host" value="localhost">
				<small>Nombre de la base de datos:</small>
				<input type="text" name="db" required="" class="form-control" placeholder="Base de datos">
				<small>Nombre de usuario para accesar la BD: (usuario por defecto para localhost: root)</small>
				<input type="text" name="user" required="" class="form-control" placeholder="Usuario">
				<small>Clave del usuario: (dejar vacío si no hay clave)</small>
				<input type="text" name="pass" class="form-control" placeholder="Clave">
				
				<br>
				<h3>Paso 2: Tipo de aplicación</h3>
				<hr>
				<small>Seleccione el tipo de aplicación:</small>
				<select class="form-control selectpicker" name="tipoApp" id="" required="">
					<option value="Factura">Factura Web</option>
					<option value="LoginBD">Solo Login</option>
					<option value="NoticiasBD">Noticias</option>
					<option value="EcommerceBD">Ecommerce</option>
					<option value="none">Blank</option>
				</select>
				<ol>
					<li>Factura Web: Crea las tablas para el sistema de factura web.</li>
					<li>Solo Login: Crea tablas para el sistema de Login, lo demas lo haces tu.</li>
					<li>Noticias: Crea tablas para un sistema de Noticias</li>
					<li>Ecommerce: Crea tablas para un sistema de productos y tienda en linea.</li>
					<li>Blank: Deja la base de datos intacta, para que la trabajes desde cero, pero genera el archivo de conexión para ahorrarte tiempo.</li>
				</ol>
				<br>
				<hr>
				<br>
				<p>Al hacer click, tener paciencia y esperar la redireccion automática.</p>
				<button class="btn btn-primary pull-right" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Configuración</button>
				<br>
				<br>
				<br>
				<hr>
			</form>
		</div>

	<?php


}	

?>
</body>
</html>
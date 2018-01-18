
	<?php 
	//cuando se actualizan los datos de este archivo por medio de la interfaz,
	//se eliminan todos los cambios.
	class Conexion{

		private function GetParams(){
			//--host--
			$host = "localhost";

			//--database--
			$db = "TestFramework";

			//--user--
			$user = "root";

			//--pass--
			$pass = "";

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

	?>
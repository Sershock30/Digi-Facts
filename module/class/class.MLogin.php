<?php 

class Login{

	private function getMetodos(){
		return new Metodos();
	} 

	public function Exists($User_username){
		//se instancia la clase metodos
		$Metodos = $this->getMetodos();

		//se limpia la variable
		$User_username = $Metodos->LimpiarVar($User_username);

		//se establece el Query
		$sql = "SELECT COUNT(*) AS CANT FROM Usuarios WHERE user_username = ?;";
		//se establece el arreglo de variables. TIENE QUE SER ARREGLO.
		$array = array($User_username);

		$rows = $Metodos->CargaArray($sql, $array);

		if ($rows[0]['CANT'] < 1) {
			return false;
		}else{
			return true;
		}
	}

	//funcion especifica para el login
	public function userLogin($user, $pass){
		//se instancia la clase metodos
		$Metodos = $this->getMetodos();

		//se limpian las variables recibidas
		$user = $Metodos->LimpiarVar($user);
		$pass = $Metodos->LimpiarVar($pass);

		$pass = hash("sha512", $pass);

		//se establece el SELECT 
		$sql = "SELECT id_usuario, id_tipo FROM usuario WHERE estado = 1 AND correo_usuario = ? AND clave_usuario = ? LIMIT 1";
		//se crea el arreglo
		$array = array($user, $pass);

		//se cargan las filas
		$rows = $Metodos->CargaArray($sql, $array);

		if (!is_null($rows[0])) {
			//se retorna la posicion 0 del arreglo
			return $rows[0];
		} else {
			return null;
		}
	}

}


?>
<?php 

class Login{

	private function getMetodos(){
		$met = new Metodos();
		return $met;
	} 

	//funcion especifica para el login
	public function userLogin($user, $pass){
		//se instancia la clase metodos
		$met = $this->getMetodos();

		//se limpian las variables recibidas
		$user = $met->LimpiarVar($user);
		$pass = $met->LimpiarVar($pass);

		$pass = hash("sha512", $pass);

		//se establece el SELECT 
		$sql = "SELECT id_usuario, id_tipo FROM usuario WHERE estado = 1 AND correo_usuario = ? AND clave_usuario = ? LIMIT 1";
		//se crea el arreglo
		$array = array($user, $pass);

		//se cargan las filas
		$rows = $met->CargaArray($sql, $array);

		if (!is_null($rows[0])) {
			//se retorna la posicion 0 del arreglo
			return $rows[0];
		} else {
			return null;
		}
	}

}


?>
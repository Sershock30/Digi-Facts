<?php 

class Metodos{
	//*************************************************************************************
	// funciones Genericos para los metodos.

	//subfuncion para cargar la conexion localmente.
	//para poder utilzar este metodo, es OBLIGATORIO tener
	//con include, require_once, etc .... el archivo de conexion.
	private function getCon(){

		//se instancia la clase
		$clasCon = new Conexion();

		$con = $clasCon->getConexion();

		if (is_null($con)) {
			return null;
		} else {
			return $con;
		}
		
		return $con;
	}

	//Salt para las claves
	public function getSalt(){
		return "KL37$!ZT";
	}

	//funcion generica para cargar una serie de datos
	public function CargaArray($sql, $array){
		//se instancia el arreglo y la conexion
		$rows = null;
		$con = $this->getCon();

		if (is_null($con)) {
			return null;
		}

		//se prepara y se ejecuta el query
		$stmt = $con->prepare($sql);
		$stmt->execute($array);

		//se cargan los datos obtenidos en un arreglo
		while ($row = $stmt->fetch()) {
			$rows[] = $row;
		}

		//se cierra la conexion
		$con = null;

		//se retorna el resultado
		return $rows;
	}

	//funcion para Insert/Update de una tabla
	public function EjecutaQuery($sql, $array){
		//se instancia la conexion
		$con = $this->getCon();

		if (is_null($con)) {
			return false;
		}

		//se prepara y se ejecuta el Insert/Update
		$stmt = $con->prepare($sql);
		$status = $stmt->execute($array);

		//se cierra la conexion
		$con = null;

		return $status;
	}

	public function EjecutaTransaccion($sql, $array){
		$response = "";

		//se obtiene la conexión
		$con = $this->getCon();

		//se valida que la conexión se obtuviera correctamente
		if (is_null($con)) {
			return false;
		}

		//se prepara la transacción
		$con->beginTransaction();

		//Se prepara el try
		try {
			
			//se ejecuta el execute
			$stmt = $con->prepare($sql);
			$stmt->execute($array);

			//si no hay errores, se realiza el commit
			$con->commit();
			//se retorna verdadero
			$response = true;

		} catch (Exception $e) {
			$con->rollBack();
			$response = false;
		}

		return $response;

	}


	//funcion generica para limpiar variables.
	public function LimpiarVar($var){
		$var = stripslashes($var);
		$var = stripcslashes($var);
		$var = strip_tags($var);

		return $var;
	}

	// fin de funciones Genericos para los metodos.
	//*************************************************************************************
}

?>
<?php 


class Cliente{


	private function getMetodos(){
      return new Metodos();
    }

    public function GetInfoCliente($cod_cliente){
      $M = $this->getMetodos();

      $sql = "SELECT consecutivo, tipo_identificacion, identificacion, correo, telefono 
              FROM Usr_Cliente 
              WHERE cod_cliente = ? 
              AND estado = 1 
              LIMIT 1;";
      $array = array($cod_cliente);

      $data = $M->CargaArray($sql, $array);

      return $data[0];
    }


    public function UpdateInfo($Nombre, $Apellidos, $Correo, $Tipo_identificacion, $Identificacion){

    }


    public function ExisteCliente($Correo, $Identificacion){
    	$M = $this->getMetodos();

    	$sql = "SELECT COUNT(*) AS C 
    			FROM Usr_Cliente WHERE
    			(correo = ? OR identificacion = ?) 
    			AND estado = 1
    			LIMIT 1";

    	$array = array($Correo, $Identificacion);

    	$data = $M->CargaArray($sql, $array);

    	if ($data[0]['C'] == 1) {
    		return true;
    	}else{
    		return false;
    	}

    }


    public function CheckEmail_Pass($Correo, $Pass){
    	$M = $this->getMetodos();

    	//se obtiene la "Salt" desde los metodos
    	$Salt = $M->getSalt();

    	//se encripta la clave para verificar, ademas de concatenar la "SALT" para otra capa deseguridad
    	$EncPass = hash("sha512", $Pass).$Salt;

    	$sql = "SELECT COUNT(*) AS C, cod_cliente 
    			FROM Usr_Cliente 
    			WHERE correo = ? 
    			AND clave = ? 
    			AND estado = 1
    			LIMIT 1";

    	$array = array($Correo, $EncPass);

    }

}



?>
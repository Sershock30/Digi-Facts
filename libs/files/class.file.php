<?php  

class File{

	//funcion para leer todas las lineas de un archivo
	public function ReadAllLines($filePath){
		// se establece la respuesta
		$response = [
			"error"=>false,
			"errorMSG"=>"",
			"texto"=>""
		];
		//se verifica que exista el archivo a leer
		if (file_exists($filePath)) {
			//abre el archivo
			$file = fopen($filePath, "r");
			//mientras no sea el final del archivo, ejecuta el while
			while(!feof($file)){
				//concatena en la variable de respuesta. cada linea del texto
				$response["texto"] .= "\n".fgets($file);
			}
		}else{
			// establece el error debido a que el archivo no existe
			$response["errorMSG"] = "El archivo no existe o no ha sido encontrado.";
			$response["error"] = true;
		}

		//retorna la respuesta
		return $response;
	}

	public function ReadSpecificSmall($file, $linea){
		$response = [
			"error"=>false,
			"errorMSG"=>"",
			"texto"=>""
		];

		if (file_exists($file)) {
			$lineas = file($file);
			$response['texto'] = $lines[$linea];
		}else{
			$response['error'] = true;
			$response['errorMSG'] = "El archivo no existe";
		}

		return $response;
	}

	public function CreateFile($filePath){
		if (file_exists($filePath)) {
			return false;
		}else{
			fopen($filePath, "x");
			if (file_exists($filePath)) {
				fclose($filePath);
				return true;
			}else{
				fclose($filePath);
				return false;
			}
		}
	}

	//crea y escribe información a un archivo, si el archivo ya existe
	//sobreescribe el contenido
	public function CreateAndWrite($filePath, $content){
		$file = fopen($filePath, "w+");
		fwrite($file, $content);
		fclose($file);

		if (file_exists($filePath)) {
			return true;
		}else{
			return false;
		}
	}

	public function Delete($file){
		if (file_exists($file)) {
			unlink($file);
			return true;
		}else{
			return false;
		}
	}

}


?>
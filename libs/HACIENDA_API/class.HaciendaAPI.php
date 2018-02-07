<?php 

class HaciendaAPI{


    public function get_Token(){
        $url = 'https://idp.comprobanteselectronicos.go.cr/auth/realms/rut-stag/protocol/openid-connect/token';//access token url
        $data = array('client_id' => 'api-stag',//Test: 'api-stag' Production: 'api-prod'
                      'client_secret' => '',//always empty
                      'grant_type' => 'password', //always 'password'
                      // Credenciales de prueba para certificado HAcienda.
                      'username' => 'cpf-01-1661-0374@stag.comprobanteselectronicos.go.cr', 
                      'password' => 'D@#WZTA]F:2&=^}28@!Z', 
                      'scope' =>'');//always empty
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo $result; }
        $token = json_decode($result); //get a token object
        return $token; //return a json object whith token and refresh token
    }


    //send invoice xml to Hacienda API
    public function send_invoice($xml, $token, $consec, $llave) {

        //aqui vamos a accesar a la BD y obtener el consecutivo del usuario
        $consecutive = $consec;

        //aqui vamos a generar la llave del documento
        $key = $llave; //key invoice number

        //aqui se cambia el invoice por el XML Generado por el class.xmlCreator.php
        $invoice = $xml;//create a xml string

        //Aqui se envía el Token obtenido de la funcion de get_Token
        $authToken = $token;//get OAuth2.0 token



        $datos = array(
          'clave' => "51111011600310112345600100010100000000011999999997",
          'fecha' => "2018-02-06T00:00:00-0600",
          'emisor' => array(
            'tipoIdentificacion' => "02",
            'numeroIdentificacion' => "116610374"
          ),
          'receptor' => array(
            'tipoIdentificacion' => "02",
            'numeroIdentificacion' => "116610374"
          ),
          'comprobanteXml' => $xml
        );

        $mensaje = json_encode($datos);

        $header = array(
          'Authorization: bearer '.$token,
          'Content-Type: application/json'
        );

        $curl = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion");
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
    
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
          return "Error";
        } else {
          //se le cambia el nombre a data para no tener errores con el response de AJAX
          return $data;
        }
    }

    //Función para validar el estado de un documento
    //requirede del Token y de la llave única generada para el documento.
    public function get_invoice_info($token, $llave){
        $header = array(
          'Authorization: bearer '.$token,
          'Content-Type: application/json'
        );

        $curl = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion/".$llave);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
          return "Error";
        } else {
          //se le cambia el nombre a data para no tener errores con el response de AJAX
          return $data;
        }

    }


    //variables a enviar para el offset y el limite
    // Offset INT = 0 DEFAULT
    // LIMIT INT = 50 DEFAULT
    // Emisor string MAX_LENGTH = 14 -> tipo identificacion + identificacion 
    // Ejemplo emisor ==  Tipo = 02 Identificacion = 116610374 -> 02116610374
    // Receptor string MAX_LENGTH = 14 -> tipo identificacion + identificacion 
    // Ejemplo receptor ==  Tipo = 02 Identificacion = 116610374 -> 02116610374
    public function get_invoice_list($token, $Offset = 0, $Limit = 50, $Emisor, $Receptor){

        $header = array(
          'Authorization: bearer '.$token,
          'Content-Type: application/json'
        );

        $curl = curl_init("https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/comprobantes/");
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);

        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
          return "Error";
        } else {
          //se le cambia el nombre a data para no tener errores con el response de AJAX
          return $data;
        }
    }

}
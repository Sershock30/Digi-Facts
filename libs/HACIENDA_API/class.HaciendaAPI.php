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


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.comprobanteselectronicos.go.cr/recepcion-sandbox/v1/recepcion",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n\t\"clave\": \"$key\","
            . "\n\t\"fecha\": \"2017-10-03T00:00:00-0600\","
            . "\n\t\"emisor\": {\n\t\t\"tipoIdentificacion\": \"02\",\n\t\t\"numeroIdentificacion\": \"116610374\"\n\t},"
            . "\n\t\"receptor\": {\n\t\t\"tipoIdentificacion\": \"02\",\n\t\t\"numeroIdentificacion\": \"116610374\"\n\t},"
            . "\n\t\"callbackUrl\": \"https://example.com/invoiceView\","
            . "\n\t\"comprobanteXml\": \"$invoice\"\n}",
          CURLOPT_COOKIE => "__cfduid=d73675273d6c68621736ad9329b7eff011507562303",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$authToken ,
            "content-type: application/json"
          ),
        ));
    
        $data = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          //echo "cURL Error #:" . $err;
          return "Error";
        } else {

          //se le cambia el nombre a data para no tener errores con el response de AJAX
          return json_decode($data);
        }
    }

}
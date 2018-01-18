<?php 


class Mail(){

	//función para el formulario de contacto, este correo se envia a la dirección designada de correo
	public function ContactMail(){

	}

	//esta función envía un correo escrito en el mail designer a todas las personas que se adjunte
	public function NewsLetter($arrDestino, $Subject, $message, $from){

		$to = "somebody@example.com, somebodyelse@example.com";

		$message = wordwrap($message,70);

		$MSG = "
		<html>
			<head>
				<title>".$Subject."</title>
			</head>
			<body>
				<h3>".$Subject."</h3>				
				<hr>
				<p>".$message."</p>
			</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From:'.$from."\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";

		$this->SendMail();
	}


	public function EmailConfirmation(){

		// the message
		$msg = "First line of text\nSecond line of text";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);

		// send email
		
	}

	private function SendMail(){
		mail("someone@example.com","My subject",$msg);
	}
}


?>
<?php 

include "../../config_files/config.php";

session_start();

if (!isset($_SESSION['ID'])) {
	?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<?php 

		$styles = $Styles;
		// ["bs"=>"default", ""=>"main"];

		while ($style = current($styles)) {
			if (key($styles) == "bootstrap") {
				echo "<!-- Estilos de Bootstrap -->";
				echo '<link rel="stylesheet" href="../assets/css/bs-themes/'.$style.'.css"> ';
			}else{
				echo "<!-- Estilos customizados -->";
				echo '<link rel="stylesheet" href="../assets/css/'.$style.'.css"> ';
			}
			next($styles);
		}

		?>
	</head>
	<body class="bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-12 col-md-offset-4" style="margin-top:150px; padding:16px; background: rgba(0,0,0, 0.3); border-radius:8px;">
					<h1 class="text-center">Admin Panel</h1>
					<?php 

						if (isset($_GET['msg'])) {
							echo '<div class="alert alert-danger alert-dismissable">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>Error.</strong> '.$_GET['msg'].'
							</div>';
						}
					
						if (isset($_GET['suc'])) {
							echo '<div class="alert alert-success alert-dismissable">
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							  <strong>¡Éxito!</strong> '.$_GET['suc'].'
							</div>';
						}
					
					?>
					<form action="../../controller/functions/login.php" method="POST">
						<div class="input-group" style="margin-bottom:10px;">
					    	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					    	<input id="email" type="email" class="form-control" name="email" placeholder="Correo:" required="">
					  	</div>
					  	<div class="input-group" style="margin-bottom:10px;">
					    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					    	<input id="password" type="password" class="form-control" name="pass" placeholder="Clave:" required="">
					  	</div>
						<div class="text-right">
							<button class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> INGRESAR</button>
						</div>
					</form>
					<hr>
					<div class="text-left">
						<a style="color:white;" href="../../">
							<span style="transform:rotateY(180deg);" class="glyphicon glyphicon-share-alt"> </span>
							Volver al sitio
						</a>
					</div>
				</div>
			</div>
			

		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
	</html>
	

	<?php
}else{
	
	include $admin_header.$ext;

	?><div class="container"><?php

	//contenido del panel
	if (isset($_GET['page'])) {
		$page = $_GET['page'].$ext;

		if (file_exists($page)) {
			include $page;
		}else{
			include $Not_found.$ext;
		}
	}else{
		include $admin_Panel.$ext;
	}

	?></div><?php
	include $admin_footer.$ext;

}	


?>

<!DOCTYPE html>
<html lang="<?php echo $Lang ?>">
<head>
	<meta charset="<?php echo $Charset ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo $Page_Title ?></title>
	<?php 

	$styles = $Styles;
	// ["bs"=>"default", ""=>"main"];

	while ($style = current($styles)) {
		if (key($styles) == "bootstrap") {
			echo "<!-- Estilos de Bootstrap -->";
			echo '<link rel="stylesheet" href="view/assets/css/bs-themes/'.$style.'.css"> ';
		}else{
			echo "<!-- Estilos customizados -->";
			echo '<link rel="stylesheet" href="view/assets/css/'.$style.'.css"> ';
		}
		next($styles);
	}

	?>
</head>
<section class="jumbotron" style="width:100%; position:fixed; top:50%; transform:translateY(-50%);">
	<center>
		<h1>
			<?php echo $Nombre_Compania ?>
		</h1>
		<h2 style="text-align: center;">
			SITIO EN CONSTRUCCIÓN
		</h2>
		<?php if ($construct["showInfo"]): ?>
			<div class="" style="text-align: center;">
			  <p class="">
			  	<a href="mail:<?php echo $info["email"] ?>">Correo: <?php echo $info["email"] ?></a>
			  	<span>  /  </span>
				<a href="#">Teléfono: <?php echo $info["phone"] ?> </a>
			  </p>
			</div>
			<p class="breadcrumb-item active" style="max-width:600px;"><?php echo $info["customMSG"] ?></p>
		<?php endif ?>
		<h3><?php echo $construct['Soon']; ?></h3>
	</center>
</section>

<?php include "../../controller/functions/PrintMenu.php"; ?>
<!DOCTYPE html>
<html lang="<?php echo $Lang ?>">
<head>
	<meta charset="<?php echo $Charset ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>AdminPanel::<?php if (isset($_GET["page"])){echo $_GET["page"];}else{echo "inicio";} ?></title>

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

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
<body>
	<nav id="navbar" class="navbar navbar-<?php echo $nav_style?> ">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>    
				</button>
				<?php echo '<a class="navbar-brand" href="?page='.$admin_Panel.'">Admin Panel V.3.11</a>';?>
			</div>
			<div class="collapse navbar-collapse navbar-<?php echo $position ?>" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php 
			
					//se imprime dinamicamente el menu desde el archivo de config	
					PrintMenu($admin_Nav_items);
			
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li style="background:#CF4D4D;">
						<a class="nav-item btn" style="color: white;" href="../../controller/functions/DoLogout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

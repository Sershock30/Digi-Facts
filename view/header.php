<?php include "controller/functions/PrintMenu.php"; ?>
<!DOCTYPE html>
<html lang="<?php echo $Lang ?>">
<head>
	<meta charset="<?php echo $Charset ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo $Page_Title;?>::<?php if (isset($_GET["page"])){echo $_GET["page"];}else{echo "inicio";} ?></title>

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

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
<body>
	<div class="container">
		<div class="row">
  			<div class="">
    	
    			<div class="col-xs-12 col-md-4 col-md-push-4 text-center">
			      	<a href="http://scmdeveloper.com/" target="_parent">SCM Developer</a>
    			</div>
    
			    <div class="col-xs-12 col-md-4 col-md-pull-4 text-center">
			      	<p>
						<span class="glyphicon glyphicon-earphone"> </span>
						<?php echo $info["phone"] ?>
					</p>
			    </div>    
    
			    <div class="col-xs-12 col-md-4 text-center">
			      	<p>
						<span class="glyphicon glyphicon-envelope"> </span>
						<?php echo $info["email"] ?>
					</p>
			    </div>
  			</div>
  		</div>
	</div>
	<nav id="navbar" class="navbar navbar-<?php echo $nav_style?>">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
				       <span class="icon-bar"></span>
				       <span class="icon-bar"></span>    
				</button>
				<?php echo '<a class="navbar-brand" href="?page='.$HomePage.'">'.$Nombre_Compania.'</a>';?>
			</div>
			<div class="collapse navbar-collapse navbar-<?php echo $position ?>" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php 
				
					//se imprime dinamicamente el menu desde el archivo de config	
					PrintMenu($Nav_items);
				
					?>
				</ul>
			</div>
		</div>
	</nav>
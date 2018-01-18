<footer>
				<hr>
				<center>
					<?php echo $Nombre_Compania ?> - 2017
				</center>
				<div class="text-right"><a href="../../controller/functions/DoLogout.php" style="padding-right:15px;">Cerrar Sesion</a></div>
				<hr>
		</footer>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
		<?php 

		$scripts = $Scripts;

		foreach ($scripts as $script) {
			echo "<script src='../assets/js/".$script.".js'></script>";
		}

		?>

	</body>
</html>
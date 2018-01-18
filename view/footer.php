
		<footer>
				<hr>
				<center>
					<?php echo $Nombre_Compania ?> - 2018
				</center>
				<?php if ($ShowLogin): ?>
					<div class="text-right">
						<small><a href="<?php echo $admin_viewPath ?>" style="padding-right:15px;">Admin Login</a></small>
					</div>
				<?php endif ?>
		</footer>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<?php 

		$scripts = $Scripts;

		foreach ($scripts as $script) {
			echo "<script src='view/assets/js/".$script.".js'></script>";
		}

		?>

	</body>
</html>
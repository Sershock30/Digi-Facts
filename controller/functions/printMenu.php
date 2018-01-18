<?php  


//funcion para imprimir a pantalla los elementos del nav
function PrintMenu($items, $level = 1){
	if (is_array($items)) {
		while ($item = current($items)) {

			//valida si la variable es un submenu
			if (is_array($item)) {
				//abre el submenu
				if ($level == 1) {
					echo '<li class="nav-item dropdown">
							<a tabindex="-1" class="nav-link dropdown-toggle" id="'.$level.'" data-toggle="dropdown" href="#">'.key($items).'<span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="'.$level.'">';
					echo "<li class='divider hidden-md hidden-lg'></li>";
					echo '<li class="dropdown-header"><i>'.key($items).'</i></li>';
				}else{
					echo '<li class="dropdown-submenu">
							<a tabindex="-1" class="menu_sub" href="#">'.key($items).'<span class="caret"></span></a>
						<ul class="dropdown-menu">';
					echo "<li class='divider hidden-md hidden-lg'></li>";
					echo '<li class="dropdown-header"><i>'.key($items).'</i></li>';
				}
							
				// se valida si el index es un array y se realiza el metodo denuevo
				//multiples submenus
				PrintMenu($item, $level+1);


				//se cierra el submenu
				echo "<li class='divider hidden-md hidden-lg'></li>";		
				echo '</ul></li>';
			}else{
				echo '<li class="nav-item"><a tabindex="-1" class="nav-link " href="?page='.$item.'">'.key($items).'</a></li>';
			}

			next($items);
		}
	}else{
		$item = current($items);
		echo '<li class="nav-item"><a class="nav-link text-primary" href="?page='.$item.'">'.key($items).'</a></li>';
	}
}

?>
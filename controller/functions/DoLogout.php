<?php 

//se inicia y se destruye la sesion
session_start();
session_destroy();

//se redirecciona a la pagina del login
header('location:../../view/admin/?suc=Sesion Finalizada');

?>
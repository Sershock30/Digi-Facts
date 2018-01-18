<?php 

//Para realizar cambios
//modificar unicamente el valor de la derecha

//Se define si el sitio esta en construcción
$construct = [
	"status" => false, 
	"showInfo" => false,
	"file" => "construccion",
	"Soon"=>"¡Lanzaremos próximamente!"
];

//información a desplegar el la pantalla de sitio en construcción
$info = [
	"email" => "info@scmdeveloper.com",
	"phone" => "8956-3064",
	"customMSG" => "Somos una cadena de distriaasdlkfasjdgasga a sdfahsdfha sdfasdh fkasdfkah"
];

//la extensión que deberán tener tus archivos de la vista
$ext = ".php";
//html
//xml
//etc

//Información del sitio (Titulo, nombre de compañia, lenguaje)
$Page_Title = "Digi Facts";
$Nombre_Compania= "Digi Facts";
$Lang = "es";
$Charset="U T F-8";


// *****************************************************************

/*estilos y librerías
se define en la llave del array el nombre del archivo css
en el caso de bootstap, se evalua el tema


//posicion del navbar 
/*
se aplica como la clase navbar-"valor"
por lo que si se desea manejar otro conjunto de clases, simplemente separar por 
un espacio
EJ:
"position"," pull-right text-primary"
la opcion anterior aplica la clase pull-right y el text-primary al navbar

opciones predefinidas
left,right
*/
//posicionamiento del main-navbar
$position = "left";

//color del navbar
// default, inverse
$nav_style = "default";

/************Lista de temas descargados***********

external -> cdn link
bootstrap
cerulean
cosmo
cyborg
darkly
flatly
journal
sandstone
slate
superhero
spacelab
lumen
paper
readable

Para descargar mas, añadir archivo a view/assets/css/bs/Nombredelarchivo.css
y cambiar la referencia del tema en el array abajo.
para referenciar un tema de Bootstrap, dejar en la llave bs y el tema en el indice
*/

$Styles = [
	"bootstrap" => "cosmo",
	"main" => "main"
];

// *****************************************************************

//items del nav Todos los nombres de archivos deben ser sin extensión
//el redireccionamiento se realiza directamente desde el index en el php

// para especificar otra carpeta simplemente agrega "..", "/" como necesites
//  E.J:
//   archivo en: view/carpeta1/subcarpeta1/nombrearchivo.php
// agregar en el array de esta forma -> "NombreButton" => "carpeta1/subcarpeta1/nombrearchivo"
 
$Nav_items = [
	//el primer item del nav_items es el homePage
	"Inicio" => "inicio",

	//los demas items, pueden variar en orden y cantidad.
	//para agregar submenus, solamente se agrega un array interno
	"Nueva Factura"=>"nueva",
	"Ver Mis Facturas"=>"listar_facturas"
];

//***************************
//define si se verá el boton de admin desde el sitio principal
$ShowLogin = false;

//nav para la vista de administrador
$admin_Nav_items = [
	//el primer item del nav_items es el homePage
	"Inicio" => "panel",

	//los demas items, pueden variar en orden y cantidad.
	//para agregar submenus, solamente se agrega un array interno
	"Opcion 1" => [
		"SubOpcion1" => [
			"SubOpcion1"=>"subop1",
			"SubOpcion2"=>[
				"SubOpcion1"=>"subop1",
				"SubOpcion2"=>"subop2"
			]
		],
		"SubOpcion2" => "subop2",
		"SubOpcion3" => "subop3"
	],
	"Opcion 2" => "op2",
	"Opcion 3" => "op3",
];

//js
$Scripts = array(
	// El orden de los scripts es el orden de importación
	"main",
	"Factura",
	"lista_facturas"
);


// *****************************************************************

//header y footer de las pantallas
$header = "header";
$footer = "footer";
$admin_header = "header";
$admin_footer = "footer";


// *****************************************************************

//sitio de Inicio 
//front view
$HomePage = current($Nav_items);

//directorio para el view general
$viewPath = "view/";


//directorio para el view de administrador
$admin_viewPath = "view/admin/";
//admin view
$admin_Panel = "panel";


//se mostratá este archivo cuando la página no se haya encontrado
$Not_found = "not_found";

?>
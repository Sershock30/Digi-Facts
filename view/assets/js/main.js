//script para el submenu anidado de N niveles
$(document).ready(function(){
  $('.dropdown-submenu a.menu_sub').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

//script para hacer sticky el navbar

//cuando se hace scroll
window.onscroll = function() {myFunction()};

//se obtiene el navbar
var navbar = document.getElementById("navbar");

// obtener offset
var sticky = navbar.offsetTop;

// Agregar sticky a la class list
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("navbar-fixed-top");
  } else {
    navbar.classList.remove("navbar-fixed-top");
  }
}
//funcion de carga inicial.
$(document).ready(function() {
	$("#data_fecha").val(GetFecha());

    $(".linea_cantidad").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
              // Permite: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            // Permite: Flechas
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $(".linea_precio").keydown(function (e) {
        // permite: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Permite: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
            // Permite: Flechas
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

});

function ActualizaPrecios(){
	//variables de la función
	var subtotal = 0;
	var impuesto = $("#impuesto").val();
	var monto = 0;
	var cant = 0;
	//se prepara el impuesto para funciones matemáticas
	if (impuesto == "") {
		impuesto = 0;
	}
	//se reccorren todas las lineas de la factura
	$(".linea_factura").each(function() {
	  cant = $(this).children("td").children('.linea_cantidad').first().val();
	  monto = $(this).children("td").children('.linea_precio').first().val();

	  if (cant == "") {
	  	cant = 1;
	  }

	  if (monto == "") {
	  	monto = 0;
	  }
	  subtotal = +subtotal + (+cant * +monto);

	});
	$("#subtotal").val(subtotal);
	impuesto = subtotal* ("0."+impuesto);
	var total = subtotal+impuesto;
	$("#total").val(total);
}

//se establece la variable de la linea
var linea = `<tr class="linea_factura">
    		<td><input 
    				onfocus="this.value = '';"
                    onblur="if(this.value == '' || this.value <= 0){this.value = '1'}"
    				type="number" 
    				class="form-control 
    				input-sm linea_cantidad" 
    				placeholder="Cantidad:" 
    				value="1"></td>
    		<td><input type="text" class="form-control input-sm linea_servicio" placeholder="Servicio:"></td>
    		<td><input type="number" class="form-control input-sm linea_precio" placeholder="Monto:"></td>
    	</tr>`;

//función para agregar una linea
function AgregaLinea(){
	$("#detalles_factura").append(linea);
	$("#remover_linea").show();
}

//función para quitar una linea
function RemueveLinea(){
	if ($('#detalles_factura .linea_factura').length > 1) {
		$('#detalles_factura .linea_factura').last().remove();

		if ($('#detalles_factura .linea_factura').length == 1) {
			$("#remover_linea").hide();
		}
	}
}

//funcion para remover los datos
function LimpiaDatos(){
	$("#detalles_factura").html(linea);
	$("#impuesto").val("0");
	$("#data_cliente").val("");
}

//función para obtener la fecha actual
function GetFecha(){
	// se obtiene la fecha
	var fecha = new Date();
	//se obtiene el dia
	var dd = fecha.getDate();
	//se obtiene el mes
	var mm = fecha.getMonth()+1; //Enero es 0
	//se obtiene el año
	var yyyy = fecha.getFullYear();

	//se ajusta el formato del día
	if(dd<10) {
	    dd = '0'+dd
	} 

	//se ajusta el formato del mes
	if(mm<10) {
	    mm = '0'+mm
	} 

	//se da formato a la fecha
	fecha = dd + '/' + mm + '/' + yyyy;
	return fecha;
}


//funcion para finalizar la factura
function FinalizaFactura(){
	var error = {
		status:false,
		title:"Datos faltantes",
		msg:"Debe completar todos las lineas vacias"
	}
	//se actualizan los totales antes de ejecutar cualquier paso de la funcion
	ActualizaPrecios();
	
	//se establecen las variables
	var fecha = $("#data_fecha").val();
	var contribuyente = $("#data_contribuyente").val();
	var cliente = $("#data_cliente").val();
	var consecutivo = $("#data_consecutivo").val();
	var tipo_doc = $("data_tipo-doc").val();
	var servicio = "";
	var cant = 0;
	var monto = 0;
	
	//se establece el array asocioativo
	var lineas = [];

	$(".linea_factura").each(function() {
	  servicio = $(this).children("td").children('.linea_servicio').first().val();
	  cant = $(this).children("td").children('.linea_cantidad').first().val();
	  monto = $(this).children("td").children('.linea_precio').first().val();

	  if (cant == "") {
	  	cant = 1;
	  }

	  if (servicio == "") {
	  	error.status = true;
	  	$(this).children("td").children('.linea_cantidad').first().addClass("has-error");
	  }

	  if (monto == "") {
	  	error.status = true;
	  	$(this).children("td").children('.linea_precio').first().addClass("has-error");
	  }else{
	  	lineas.push([cant, servicio, monto]);
	  }

	});

	//resultado del array = 
	// [ [cantidad, nombre, precio], [cantidad, nombre, precio], [cantidad, nombre, precio] ]

	// for (var i = 0; i < lineas.length; i++) {
	// 	for (var j = 0; j < lineas[i].length; j++) {
	// 		console.log(lineas[i][j]);
	// 	}
	// }

	var subtotal = $("").val();
	var impuesto = $("").val();
	var total = $("").val();
	
	if (!error.status) {
		//Función AJAX para crear el XML
		$.ajax({
			url : "controller/async/async.xmlCreator.php",
			method : "post",
			dataType : "json",
			data: {
				fecha : fecha,
				cedula : cliente,
				detalle : lineas // Por estandar , las variables que contienen elementos del DOM obtenidos con JQuery se representan con un "$" al inicio.

			},
			success: function(response){
				//se imprime el resultado en consola
				console.log(response.clave);
				console.log(response.fecha);
				console.log(response.emisor);
				console.log(response.receptor);
				console.log(response.comprobanteXml);
			},
			error: function(xhr, status, errormsg){
				//se muestra el error en consola
				console.log(xhr.responseText);
				console.log(status);
				console.log(errormsg);
			}

		});
	}else{
		//se muestra el modal de errores
		$("#response_title").text(error.title);
		$("#response_msg").text(error.msg);
		$("#myModal").modal("show");
	}


}


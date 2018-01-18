//función para mostrar la información de la facruta en el modal
function MuestraInfo(element){
	var consecutivo = $(element).children('.consecutivo').text();
	var fecha = $(element).children('.fecha').text();
	var ced_cliente = $(element).children('.ced_cliente').text();
	var monto_total = $(element).children('.monto_total').text();

	//en esta sección se realizaría el AJAX para cargar los datos de la factura y mostrarlos en el modal.

	$("#modal_consecutivo").html(consecutivo);
	$("#data_modal").modal("show");
}
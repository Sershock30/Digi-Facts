<section>
	<!-- contenedor principal de la factura -->
	<div class="container NuevaFactura">
    	<div class="row">
            <!-- bloque de anuncios de google para ad revenue -->
    		<div class="col-md-12 hidden-sm hidden-xs">
    			<div class="well well-sm">
    				<p>Aqui van los anuncions de google, pero estos se ocultan en versión móvil.</p>
    			</div>
    		</div>
    		<div class="col-md-10" id="Contenido_Factura">
    			<div class="row">
                    <!-- Primera fila de informacion -->
    				<div class="col-md-12">
    					<label for=""><small>Fecha Actual: dd/mm/yyyy</small></label>
    					<input type="text" id="data_fecha" readonly="" class="form-control" placeholder="Fecha">
    				</div>
                    <!-- Este número se obtiene de la sesión, después de haberse registrado -->
    				<div class="col-md-4">
    					<label for=""><small>No. Contribuyente</small></label>
    					<input type="text" id="data_contribuyente" readonly="" class="form-control" placeholder="No. Contribuyente">
    				</div>
                    <div class="col-md-4">
                        <label for=""><small>Tipo identificación Cliente:</small></label>
                        <select type="text" id="tipo_identificacion" readonly class="form-control" placeholder="Tipo Identificación:">
                            <option value="01">Cedula Nacional</option>
                            <option value="02">Pasaporte</option>
                        </select>
                    </div>
                    <!-- Cédula jurídica/física del cliente -->
                    <div class="col-md-4">
                        <label for=""><small>Identificación Cliente</small></label>
                        <input type="text" id="data_cliente" class="form-control" placeholder="Cedula Cliente:">
                    </div>
                    <!-- Segunda fila de información -->
                    <!-- Consecutivo de la factura con respecto al usuario que ingresó al sistema -->
    				<div class="col-md-6">
    					<label for=""><small>No. Factura</small></label>
    					<input type="text" id="data_consecutivo" readonly="" class="form-control" placeholder="Consecutivo">
    				</div>
                    <!-- Tipo de documento, por defecto solo Factura -->
                    <!-- NOTA: Incluir Notas de Crédito y Débito -->
                    <div class="col-md-6">
                        <label for=""><small>Tipo Documento</small></label>
                        <select type="text" id="data_tipo-doc" readonly class="form-control" placeholder="Tipo documento:">
                            <option value="01">Factura</option>
                            <option value="02">Nota de Crédito</option>
                        </select>
                    </div>
    			</div>

                <!-- Tabla de despliegue de detalles -->
    			<div class="table-responsive">
                    <table class="table table-condensed">
                                        
                                        <!-- Encabezado de la tabla -->
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Servicio</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                    
                                        <!-- Cuerpo de la tabla, aqui se concatenan los nuevos detalles -->
                        <tbody id="detalles_factura">
                            <tr class="linea_factura">
                                <td>
                                    <input type="number" onfocus="this.value = '';" onblur="if(this.value == '' || this.value <= 0){this.value = '1'}" class="form-control input-sm linea_cantidad"  placeholder="Cantidad:"  value="1">
                                </td>
                                <td>
                                    <input type="text" class="form-control input-sm linea_servicio" placeholder="Servicio:">
                                </td>
                                <td>
                                    <input type="number" class="form-control input-sm linea_precio" placeholder="Monto:">
                                </td>
                            </tr>
                        </tbody>
                    
                                        <!-- Pie de la tabla, se incluyen los botones -->
                        <tfoot>
                            <tr class="agrega_linea">
                                                <!-- colspan para ajustar la posicion de los botones -->
                                <td colspan="3">
                                                    <!-- Remueve una única linea (la última) -->
                                    <button id="remover_linea" class="btn btn-sm btn-danger" style="display: none;" onclick="RemueveLinea();">
                                        <i class="glyphicon glyphicon-minus"></i> 
                                        Remover Linea
                                    </button>
                                                    <!-- Agrega una linea al final -->
                                    <button id="agregar_linea" class="btn btn-sm btn-primary" onclick="AgregaLinea();">
                                        <i class="glyphicon glyphicon-plus"></i> 
                                        Agregar Linea
                                    </button>
                                </td>
                            </tr>
                            <tr class="agrega_linea">
                                <td colspan="3">
                                    <!-- Actualiza los datos del subtotal y el total -->
                                    <button id="Actualizar" class="btn btn-sm btn-success" onclick="ActualizaPrecios();">
                                        <i class="glyphicon glyphicon-refresh"></i> 
                                        Actualizar Totales
                                    </button>
                                </td>
                            </tr>
                        </tfoot>    
                    </table>
                </div>

                <!-- Segunda tabla para los detalles finales de la factura -->
    			<table class="table borderless">
    				<thead>
    					<!-- Subtotal de la factura -->
    					<tr class="text-right form-horizontal">
    						<td class="col-md-10 col-sm-6 control-label lb_subtotal"><strong>Subtotal </strong></td>
    						<td class="col-md-2 col-sm-6"><input id="subtotal" class="form-control input-sm text-center" readonly="" type="number"  value="0"></td>
    					</tr>
    					<!-- Monto del impuesto a mostrar -->
    					<tr class="text-right form-horizontal">
    						<td class="col-md-10 col-sm-6 control-label lb_impuesto"><strong>Impuesto </strong></td>
    						<td class="col-md-2 col-sm-6">
                                <input 
                                onfocus="this.value = '';"
                                onblur="if(this.value == ''){this.value = '0'}" 
                                id="impuesto" 
                                class="form-control input-sm text-center" 
                                type="number" 
                                value="0">
                            </td>
    					</tr>
    					<!-- Despliegue del total de la factura -->
    					<tr class="text-right form-horizontal">
    						<td class="col-md-10 col-sm-6 control-label lb_total"><strong>Total </strong></td>
    						<td class="col-md-2 col-sm-6"><input id="total" class="form-control input-sm text-center" readonly="" type="number" placeholder="0" value="0"></td>
    					</tr>
    					<!-- Botones para limpiar y finalizar la facturación -->
    					<tr>
                            <!-- Texto a la derecha y colspan para ajustar posición de la factura -->
    						<td colspan="3" class="text-right">
                                <!-- Button group para acomodar ambos botones en linea sin necesidad de div o estilos extra -->
                                <p class="text-danger">NOTA: Verificar los datos antes de clickear el botón de Finalizar Factura.</p>
    							<p class="btn-group">
                                    <!-- Boton para limpiar los datos -->
								  	<div class="btn-group">
								    	<button onclick="LimpiaDatos();" type="button" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-remove"></i> 
                                            Limpiar Datos
                                        </button>
								  	</div>
                                    <!-- Boton para Finalizar la factura -->
								  	<div class="btn-group">
								    	<button onclick="FinalizaFactura();" type="button" class="btn btn-success">
                                            <i class="glyphicon glyphicon-list-alt"></i> 
                                            Finalizar Factura
                                        </button>
								  	</div>
								</p>
    						</td>
    					</tr>
    				</thead>
    			</table>
    		</div>

            <!-- Sidebar para anuncios laterales de google -->
    		<aside class="col-md-2">
    			<div class="well">
    				<p>Aqui van más anuncions de google</p>
    			</div>
    		</aside>
    	</div>
	</div>

</section>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="response_title"></h4>
        </div>
        <div class="modal-body">
          <p id="response_msg"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
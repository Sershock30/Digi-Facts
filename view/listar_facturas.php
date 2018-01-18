<div class="container">
    <h4 class="text-center">Mis Facturas</h4>
    <p>Total de facturas registradas: <span id="fact_count">999</span></p>
    <div class="row">
        <div class="input-group col-md-6">
            <span class="input-group-addon">Ordenar por:</span>
            <select class="form-control" name="" id="">
                <option value="" selected>Fecha Decreciente</option>
                <option value="">Fecha Creciente</option>
                <option value="">Monto</option>
                <option value="">Alfabético</option>
            </select>
        </div>
        <div class="input-group col-md-6">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar">
        </div>
    </div>
    <hr>
    <table class="table table-condensed">
        <thead class="">
            <tr>
                <th>Consecutivo</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Monto Total</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody id="despliega_facturas">
            <tr class="factura">
                <td class="consecutivo">000000001</td>
                <td class="fecha">10/01/2018</td>
                <td class="ced_cliente">112314123</td>
                <td class="monto_total">500000</td>
                <td><button class="btn btn-primary" onclick="MuestraInfo($(this).parent().parent());">ver detalles</button></td>
            </tr>
            <tr class="factura">
                <td class="consecutivo">000000002</td>
                <td class="fecha">10/01/2018</td>
                <td class="ced_cliente">112314123</td>
                <td class="monto_total">20000</td>
                <td><button class="btn btn-primary" onclick="MuestraInfo($(this).parent().parent());">ver detalles</button></td>
            </tr>
            <tr class="factura">
                <td class="consecutivo">000000003</td>
                <td class="fecha">10/01/2018</td>
                <td class="ced_cliente">112314123</td>
                <td class="monto_total">1200000</td>
                <td><button class="btn btn-primary" onclick="MuestraInfo($(this).parent().parent());">ver detalles</button></td>
            </tr>
            <tr class="factura">
                <td class="consecutivo">000000004</td>
                <td class="fecha">10/01/2018</td>
                <td class="ced_cliente">112314123</td>
                <td class="monto_total">300000</td>
                <td><button class="btn btn-primary" onclick="MuestraInfo($(this).parent().parent());">ver detalles</button></td>
            </tr>
             <tr class="factura">
                <td class="consecutivo">000000004</td>
                <td class="fecha">10/01/2018</td>
                <td class="ced_cliente">112314123</td>
                <td class="monto_total">300000</td>
                <td><button class="btn btn-primary" onclick="MuestraInfo($(this).parent().parent());">ver detalles</button></td>
            </tr>
        </tbody>   
    </table>
</div>


<!-- Modal para el despliegue de los datos -->

<div class="modal fade" id="data_modal" tabindex="-1" role="dialog" aria-labelledby="data_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">
                    Información de Factura No. / 
                    <span id="modal_consecutivo"></span>
                </h5>
            </div>
            <div class="modal-body">
                <h5>Cargar info de la factura desde la BD</h5>
                <ol>
                    <li>Contribuyente</li>
                    <li>Tipo documento (Factura)</li>
                    <li>Cédula Cliente</li>
                    <li>Lineas de la factura</li>
                    <li>Subtotal</li>
                    <li>Impuesto</li>
                    <li>Total</li>
                </ol>
                NOTA: Cada linea de la factura se desplegará en una tabla como la que se muestra en agregar factura
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
                            <td>1</td>
                            <td>Descripción del servicio</td>
                            <td>5000</td>
                        </tr>
                    </tbody>   
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">generar copia (XML y PDF)</button>
            </div>
        </div>
    </div>
</div>
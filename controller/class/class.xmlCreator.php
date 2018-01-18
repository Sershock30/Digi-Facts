<?php 

class xmlCreator{

	public $consecutivo = 2;

	// Crear Detalle de Factura

	function numeracionComercial(){

		$num_sucursal = "001";
		$punto_venta = "00001";
		$tipo_documento = "01";
		$numeracion_comprobante = "0000000001";

		return $num_sucursal.$punto_venta.$tipo_documento.$numeracion_comprobante;

	}

	function crearClave(){
		$country_code = 506;
		$day = date("d");
		$month = date("m");
		$year = date("y");
		$cedula = $_POST["cedula"];
		$codigo_seguridad = 56451223; // Lo puse aleatorio, segun el video debe ser colocado por nosotros o el cliente.
		$estado = 1;

		return $country_code.$day.$month.$year.$cedula.$this->numeracionComercial().$estado.$codigo_seguridad;
	}

	function emisorInfo($doc,$root){ // Funcion para colocar los datos del Emisor
		// Nodos de Informacion
		// Nodo Raiz
		$emisor = $doc->createElement("Emisor");
		$root->appendChild($emisor);
		//
		$nombre = $doc->createElement("Nombre","Sergio Chang");
		$emisor->appendChild($nombre);
		// Seccion ramificada de Identificacion

		$identificacion = $doc->createElement("Identificacion");
		$emisor->appendChild($identificacion);

		$tipo_id = $doc->createElement("Tipo",01);
		$identificacion->appendChild($tipo_id);

		$num_identi = $doc->createElement("Numero",123567841);
		$identificacion->appendChild($num_identi);

		// Fin Seccion Identificacion
		$nom_comer = $doc->createElement("NombreComercial","SCM");
		$emisor->appendChild($nom_comer);
		//Seccion ramificada de Ubicacion

		$ubicacion = $doc->createElement("Ubicacion");
		$emisor->appendChild($ubicacion);

		$Provincia = $doc->createElement("Provincia","San José");
		$ubicacion->appendChild($Provincia);

		$Canton = $doc->createElement("Canton","Goicoechea");
		$ubicacion->appendChild($Canton);

		$Distrito = $doc->createElement("Distrito","El Carmen");
		$ubicacion->appendChild($Distrito);

		$Barrio = $doc->createElement("Barrio","Mata Platano");
		$ubicacion->appendChild($Barrio);

		$otras = $doc->createElement("OtrasSenas","Casa Roja");
		$ubicacion->appendChild($otras);

		//Fin Seccion ramificada de Ubicacion

		//Seccion Telefono

		$Telefono = $doc->createElement("Telefono");
		$emisor->appendChild($Telefono);

		$cod_pais = $doc->createElement("CodPais",506);
		$Telefono->appendChild($cod_pais);

		$num_tel = $doc->createElement("NumTelefono","Goicoechea");
		$Telefono->appendChild($num_tel);


		// Fin Seccion Telefono
		//Seccion Fax

		$fax = $doc->createElement("Fax");
		$emisor->appendChild($fax);

		$cod_pais = $doc->createElement("CodPais",506);
		$fax->appendChild($cod_pais);

		$num_tel = $doc->createElement("NumTelefono","Goicoechea");
		$fax->appendChild($num_tel);


		// Fin Seccion Fax
		//
		$correo = $doc->createElement("CorreoElectronico","scm@gmail.com");
		$emisor->appendChild($correo);
		//

	}

	function receptorInfo($doc,$root){ // Funcion para colocar los datos del Emisor
		// Nodos de Informacion
		// Nodo Raiz
		$receptor = $doc->createElement("Receptor");
		$root->appendChild($receptor);
		//
		$nombre = $doc->createElement("Nombre","Sergio Chang");
		$receptor->appendChild($nombre);
		// Seccion ramificada de Identificacion

		$identificacion = $doc->createElement("Identificacion");
		$receptor->appendChild($identificacion);

		$tipo_id = $doc->createElement("Tipo",01);
		$identificacion->appendChild($tipo_id);

		$num_identi = $doc->createElement("Numero",123567841);
		$identificacion->appendChild($num_identi);

		// Fin Seccion Identificacion

		$identificacion_extran = $doc->createElement("IdentificacionExtranjero","CDF4867464DSA5");
		$receptor->appendChild($identificacion_extran);

		$nom_comer = $doc->createElement("NombreComercial","SCM");
		$receptor->appendChild($nom_comer);
		//Seccion ramificada de Ubicacion

		$ubicacion = $doc->createElement("Ubicacion");
		$receptor->appendChild($ubicacion);

		$Provincia = $doc->createElement("Provincia","San José");
		$ubicacion->appendChild($Provincia);

		$Canton = $doc->createElement("Canton","Goicoechea");
		$ubicacion->appendChild($Canton);

		$Distrito = $doc->createElement("Distrito","El Carmen");
		$ubicacion->appendChild($Distrito);

		$Barrio = $doc->createElement("Barrio","Mata Platano");
		$ubicacion->appendChild($Barrio);

		$otras = $doc->createElement("OtrasSenas","Casa Roja");
		$ubicacion->appendChild($otras);

		//Fin Seccion ramificada de Ubicacion

		//Seccion Telefono

		$Telefono = $doc->createElement("Telefono");
		$receptor->appendChild($Telefono);

		$cod_pais = $doc->createElement("CodPais",506);
		$Telefono->appendChild($cod_pais);

		$num_tel = $doc->createElement("NumTelefono","Goicoechea");
		$Telefono->appendChild($num_tel);


		// Fin Seccion Telefono
		//Seccion Fax

		$fax = $doc->createElement("Fax");
		$receptor->appendChild($fax);

		$cod_pais = $doc->createElement("CodPais",506);
		$fax->appendChild($cod_pais);

		$num_tel = $doc->createElement("NumTelefono","Goicoechea");
		$fax->appendChild($num_tel);


		// Fin Seccion Fax
		//
		$correo = $doc->createElement("CorreoElectronico","scm@gmail.com");
		$receptor->appendChild($correo);
		//

	}

	function infoVenta($doc,$root){

		global $consecutivo;

		$condi_venta = $doc->createElement("CondicionVenta",01);
		$root->appendChild($condi_venta);

		$plazo_credito = $doc->createElement("PlazoCredito","30 Dias");
		$root->appendChild($plazo_credito);

		$medio_pago = $doc->createElement("MedioPago",01);
		$root->appendChild($medio_pago);

		$num_consecutivo = $doc->createElement("NumeroConsecutivo",$consecutivo);
		$root->appendChild($num_consecutivo);		

	}

	function resumenFactura($doc,$root){

		$resumen_fac = $doc->createElement("ResumenFactura");
		$root->appendChild($resumen_fac);

		$cod_moneda = $doc->createElement("CodigoMoneda","CRC");
		$resumen_fac->appendChild($cod_moneda);

		$medio_pago = $doc->createElement("TipoCambio",571);
		$resumen_fac->appendChild($medio_pago);

		$total_serv_gravados = $doc->createElement("TotalServGravados",562);
		$resumen_fac->appendChild($total_serv_gravados);

		$total_serv_exentos = $doc->createElement("TotalServExentos",562);
		$resumen_fac->appendChild($total_serv_exentos);

		$total_mer_gravada = $doc->createElement("TotalMercanciaGravada",562);
		$resumen_fac->appendChild($total_mer_gravada);

		$total_mer_exentas = $doc->createElement("TotalMercanciasExentas",562);
		$resumen_fac->appendChild($total_mer_exentas);

		$total_gravado = $doc->createElement("TotalGravado",562);
		$resumen_fac->appendChild($total_gravado);

		$total_Exento = $doc->createElement("TotalExento",562);
		$resumen_fac->appendChild($total_Exento);

		$total_venta = $doc->createElement("TotalVenta",562);
		$resumen_fac->appendChild($total_venta);

		$total_descuentos = $doc->createElement("TotalDescuentos",562);
		$resumen_fac->appendChild($total_descuentos);

		$total_venta_neta = $doc->createElement("TotalVentaNeta",562);
		$resumen_fac->appendChild($total_venta_neta);

		$total_impuesto = $doc->createElement("TotalImpuesto",562);
		$resumen_fac->appendChild($total_impuesto);

		$total_comprobante = $doc->createElement("TotalComprobante",562);
		$resumen_fac->appendChild($total_comprobante);

	}

	function infoReferencia($doc,$root){

		$info_ref = $doc->createElement("InformacionReferencia");
		$root->appendChild($info_ref);

		$tipo_doc = $doc->createElement("TipoDoc",01);
		$info_ref->appendChild($tipo_doc);

		$numero = $doc->createElement("Numero",571);
		$info_ref->appendChild($numero);

		$fecha = $doc->createElement("FechaEmision",date("d-m-y H:i:s"));
		$info_ref->appendChild($fecha);

		$cod = $doc->createElement("Codigo",562);
		$info_ref->appendChild($cod);

		$razon = $doc->createElement("Razon","Sale");
		$info_ref->appendChild($razon);

	}

	function normativa($doc,$root){

		$normativa = $doc->createElement("Normativa");
		$root->appendChild($normativa);

		$num_resolucion = $doc->createElement("NumeroResolucion",01);
		$normativa->appendChild($num_resolucion);

		$fecha_resolucion = $doc->createElement("FechaResolucion",date("d-m-y"));
		$normativa->appendChild($fecha_resolucion);

	}

	function otros($doc,$root){
		
		$otros = $doc->createElement("Otros");
		$root->appendChild($otros);

		$otro_texto = $doc->createElement("OtroTexto","Hola");
		$otros->appendChild($otro_texto);

		$otro_contenido = $doc->createElement("OtroContenido","Hola2");
		$otros->appendChild($otro_contenido);

	}

	function detalleFactura($doc,$root,$detalles){

		$detalle = $doc->createElement("DetalleFactura");
		$root->appendChild($detalle);

		$descuento =0;
		$subtotal =0;
		$total = 0;

		//print_r($detalles);

		for ( $i = 0; $i <  count($detalles); $i++) {
			for ($j=0; $j <count($detalles[$i]) ; $j++) { 

				//print_r($detalles[$i][$j][1]);
				$linea = $doc->createElement("LineaDetalle");
				$detalle->appendChild($linea);

				$num_line = $doc->createElement("NumeroLinea",$j+1);
				$linea->appendChild($num_line);

				// Seccion de Codigo
				$codigo = $doc->createElement("Codigo");
				$linea->appendChild($codigo);

				$tipo_cod = $doc->createElement("Tipo",01);
				$codigo->appendChild($tipo_cod);

				$cod = $doc->createElement("Codigo","FA01");
				$codigo->appendChild($cod);			

				//Fin Seccion Codigo

				$cantidad = $doc->createElement("Cantidad",$detalles[$i][$j][0]);
				$linea->appendChild($cantidad);

				$uni_medida = $doc->createElement("UnidadMedida","GR");
				$linea->appendChild($uni_medida);

				$uni_comer_medida = $doc->createElement("UnidadComercialMedida","GR");
				$linea->appendChild($uni_comer_medida);

				$detalle = $doc->createElement("Detalle","Venta");
				$linea->appendChild($detalle);

				$precio_uni = $doc->createElement("PrecioUnitario",$detalles[$i][$j][0]);
				$linea->appendChild($precio_uni);

				// Calculo Sub total

				$monto_final = $detalles[$i][$j][2] - ($detalles[$i][$j][2]*$descuento);
				$subtotal += $monto_final;

				// Fin Calculo

				$monto_total = $doc->createElement("MontoTotal",$monto_final);
				$linea->appendChild($monto_total);

				$monto_desc = $doc->createElement("MontoDescuento",$descuento);
				$linea->appendChild($monto_desc);

				$naturaleza_desc = $doc->createElement("NaturalezaDescuento","Error");
				$linea->appendChild($naturaleza_desc);

				$sub_total = $doc->createElement("SubTotal",$subtotal);
				$linea->appendChild($sub_total);

				// Seccion Impuesto

				$impuesto = $doc->createElement("Impuesto");
				$linea->appendChild($impuesto);

				$codigo_impuesto = $doc->createElement("Codigo",654);
				$impuesto->appendChild($codigo_impuesto);

				$tarifa = $doc->createElement("Tarifa",654);
				$impuesto->appendChild($tarifa);

				$monto = $doc->createElement("Monto",654);
				$impuesto->appendChild($monto);

				$exoneracion = $doc->createElement("Exoneracion",654);
				$impuesto->appendChild($exoneracion);

				$tipo_doc = $doc->createElement("TipoDocumento",01);
				$exoneracion->appendChild($tipo_doc);

				$num_doc = $doc->createElement("NumeroDocumento",1);
				$exoneracion->appendChild($num_doc);

				$nombre_insti = $doc->createElement("NombreInstitucion","SCM");
				$exoneracion->appendChild($nombre_insti);

				$fecha = $doc->createElement("FechaEmision",date("d-m-y H:i:s"));
				$exoneracion->appendChild($fecha);

				$monto_impuesto = $doc->createElement("MontoImpuesto",0.13);
				$exoneracion->appendChild($monto_impuesto);

				$por_venta = $doc->createElement("PorcentajeVenta",0.13);
				$exoneracion->appendChild($por_venta);


				// Fin Seccion Impuesto

				$total_linea = $doc->createElement("MontoTotalLinea",$total);
				$linea->appendChild($total_linea);
			}
		}
	}

	function createXML(){ // Funcion para crear el documento XML y sus nodos

		global $consecutivo;

		// Estructura basica de la creacion del XML
		$xml_doc = new DOMDocument("1.0","utf-8");
		$xml_doc->formatOutput = true;
		$xml_doc->enconding = "UTF-8";
		//
		
		// Nodo Raiz

		$facutura_elec = $xml_doc->createElement("FacuturaElectronica");
		$xml_doc->appendChild($facutura_elec);

		//
		// Nodos primarios

		$clave = $xml_doc->createElement("Clave", $this->crearClave());
		$facutura_elec->appendChild($clave);
		//
		$num_consecutivo = $xml_doc->createElement("NumeroConsecutivo",$consecutivo);
		$facutura_elec->appendChild($num_consecutivo);
		//
		$fecha_emision = $xml_doc->createElement("FechaEmision",date("d-m-y H:i:s"));
		$facutura_elec->appendChild($fecha_emision);

		// Fin Nodos Primarios

		//Nodos Sedundarios

		$this->emisorInfo($xml_doc,$facutura_elec);
		$this->receptorInfo($xml_doc,$facutura_elec);

		//Fin Nodos Secundarios

		// Nodos de Informacion de Ventas

		$this->infoVenta($xml_doc,$facutura_elec);

		// Fin Nodo de Informacion de Ventas
		$this->infoVenta($xml_doc,$facutura_elec);
		$this->detalleFactura($xml_doc,$facutura_elec, array($_POST["detalle"]));
		// Nodos de Resumen de Factura
		$this->resumenFactura($xml_doc,$facutura_elec);
		//

		$this->infoReferencia($xml_doc,$facutura_elec);

		$this->normativa($xml_doc,$facutura_elec);

		$this->otros($xml_doc,$facutura_elec);

		// Seccion de Cifrado

		//$xml_full = $xml_doc->saveXML();

		// $encryp = base64_encode($xml_full);

		// $cifrado = $xml_doc->createElement("ContenidoXML",$encryp);
		// $facutura_elec->appendChild($cifrado);

		// Fin Seccion Cifrado

		return $xml_doc->saveXML();

		$consecutivo++;
	}
}

?>
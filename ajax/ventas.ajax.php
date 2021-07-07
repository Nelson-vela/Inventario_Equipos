<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas{


	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public $activarVenta;
	public $activarId;

	public function ajaxactivarVenta(){

		$tabla = 'ventas';
		
		$item = 'estado';
		$valor = $this->activarVenta;

		$item2 = 'id';
		$valor2 = $this->activarId;

		$respuesta = ModeloVenta::mdlActualizarVenta($tabla, $item, $valor, $item2, $valor2);


	}


	/*=============================================
	ACTIVAR FACTURA
	=============================================*/

	public $activarVentaFactura;
	public $activarIdFactura;

	public function ajaxactivarVentFactura(){

		$tabla = 'ventas';
		
		$item = 'estadoFactura';
		$valor = $this->activarVentaFactura;

		$item2 = 'id';
		$valor2 = $this->activarIdFactura;

		$respuesta = ModeloVenta::mdlActualizarVenta($tabla, $item, $valor, $item2, $valor2);


	}
	
	/*=============================================
	ACTIVAR ENVIO
	=============================================*/

	public $activarEnvio;
	public $activarIdEnvio;

	public function ajaxactivarEnvio(){

		$tabla = 'ventas';
		
		$item = 'enviado';
		$valor = $this->activarEnvio;

		$item2 = 'id';
		$valor2 = $this->activarIdEnvio;

		$respuesta = ModeloVenta::mdlActualizarVenta($tabla, $item, $valor, $item2, $valor2);


	}
		


	public $idClienteSer;

	public function ajaxEditarCliente(){


		$item = 'id';
		$valor = $this->idClienteSer;

		$respuesta = ControladorVenta::ctrMostrarVenta($item, $valor);

		echo json_encode($respuesta);


	}






} //FINAL DE LA CLASE



	/*=============================================
	EDITAR CLIENTE
	=============================================*/


	if (isset($_POST['idVenta'])) {


	$cliente = new AjaxVentas();
	$cliente->idClienteSer = $_POST['idVenta'];
	$cliente->ajaxEditarCliente();
	}



	/*=============================================
	ACTIVAR USUARIO
	=============================================*/


	if (isset($_POST['estadoVenta'])) {

		$activar = new AjaxVentas();
		$activar->activarVenta = $_POST['estadoVenta'];
		$activar->activarId = $_POST['activarId'];
		$activar->ajaxactivarVenta();

	}



	/*=============================================
	ACTIVAR USUARIO
	=============================================*/


	if (isset($_POST['estadoFactura'])) {

		$activar = new AjaxVentas();
		$activar->activarVentaFactura = $_POST['estadoFactura'];
		$activar->activarIdFactura = $_POST['activarIdFactura'];
		$activar->ajaxactivarVentFactura();

	}
	
	/*=============================================
	ACTIVAR ENVIO
	=============================================*/


	if (isset($_POST['estadoEnviado'])) {

		$activar = new AjaxVentas();
		$activar->activarEnvio = $_POST['estadoEnviado'];
		$activar->activarIdEnvio = $_POST['activarId'];
		$activar->ajaxactivarEnvio();

	}
 






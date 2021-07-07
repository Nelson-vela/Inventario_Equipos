<?php 

require_once '../controladores/presupuesto.controlador.php';
require_once '../modelos/presupuesto.modelo.php';

class AjaxPresupuesto{

	public $id;

	public function ajaxEditarGastos(){

		$item = "id";
		$valor = $this->id;
		$respuesta = ControladorPresupuesto::ctrMostrarGastos($item, $valor);	 

		echo json_encode($respuesta);
	}



	public $fechaInicio;
	public $fechaFin;


	public function mostrarGastosPersonalizados(){

		$datos = array("fechaInicio" =>$this->fechaInicio,
			"fechaFin" =>$this->fechaFin);

		$respuesta = ControladorPresupuesto::ctrMostrarTotalPorMes($datos);

		echo json_encode($respuesta);



	}

	public function mostrarPresupuestoPersonalizados(){

		$datos = array("fechaInicio" =>$this->fechaInicio,
			"fechaFin" =>$this->fechaFin);

		$respuesta = ControladorPresupuesto::ctrMostrarTotalPresupuestoPorMes($datos);

		echo json_encode($respuesta);



	}


} //FINAL DE LA CALSE



/* EDITAR USUARIO */

if (isset($_POST['idGastos'])) {
	
	$gastos = New AjaxPresupuesto();
	$gastos->id = $_POST['idGastos'];
	$gastos->ajaxEditarGastos();
}




if (isset($_POST['inicioFecha'])) {
	
	$mostrarGastosporFechas = New AjaxPresupuesto();
	$mostrarGastosporFechas->fechaInicio = $_POST['inicioFecha'];
	$mostrarGastosporFechas->fechaFin = $_POST['finFecha'];
	$mostrarGastosporFechas->mostrarGastosPersonalizados();
}


if (isset($_POST['gastos'])) {
	
	$mostrarPresupuestosporFechas = New AjaxPresupuesto();
	$mostrarPresupuestosporFechas->fechaInicio = $_POST['inicioFecha'];
	$mostrarPresupuestosporFechas->fechaFin = $_POST['finFecha'];
	$mostrarPresupuestosporFechas->mostrarPresupuestoPersonalizados();
}






?>
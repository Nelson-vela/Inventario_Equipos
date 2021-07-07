<?php 

require_once '../controladores/plantilla.controlador.php';
require_once '../modelos/plantilla.modelo.php';
 
class ajaxGastosFijos{

	public $id;

	public function ajaxEditarGastosFijos(){

		$item = "id";
		$valor = $this->id;
		$respuesta = ControladorPlantilla::ctrMostrarGastosFijos($item, $valor);	 

		echo json_encode($respuesta);
	}



	/*public $fechaInicio;
	public $fechaFin;


	public function mostrarGastosPersonalizados(){

		$datos = array("fechaInicio" =>$this->fechaInicio,
			"fechaFin" =>$this->fechaFin);

		$respuesta = ControladorPlantilla::ctrMostrarGastosFijos($datos);

		echo json_encode($respuesta);



	}*/

	/*public function mostrarPresupuestoPersonalizados(){

		$datos = array("fechaInicio" =>$this->fechaInicio,
			"fechaFin" =>$this->fechaFin);

		$respuesta = ControladorPresupuesto::ctrMostrarTotalPresupuestoPorMes($datos);

		echo json_encode($respuesta);



	}*/


} //FINAL DE LA CALSE



/* EDITAR USUARIO */

if (isset($_POST['idGastosFijos'])) {
	
	$gastos = New ajaxGastosFijos();
	$gastos->id = $_POST['idGastosFijos'];
	$gastos->ajaxEditarGastosFijos();
}




if (isset($_POST['inicioFecha'])) {
	
	$mostrarGastosporFechas = New ajaxGastosFijos();
	$mostrarGastosporFechas->fechaInicio = $_POST['inicioFecha'];
	$mostrarGastosporFechas->fechaFin = $_POST['finFecha'];
	$mostrarGastosporFechas->mostrarGastosPersonalizados();
}


if (isset($_POST['gastos'])) {
	
	$mostrarPresupuestosporFechas = New ajaxEditarGastosFijos();
	$mostrarPresupuestosporFechas->fechaInicio = $_POST['inicioFecha'];
	$mostrarPresupuestosporFechas->fechaFin = $_POST['finFecha'];
	$mostrarPresupuestosporFechas->mostrarPresupuestoPersonalizados();
}






?>
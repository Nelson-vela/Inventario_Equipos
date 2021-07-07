<?php 

require_once '../controladores/pisos.controlador.php';
require_once '../modelos/pisos.modelo.php';

class AjaxPisos{

	public $id;

	public function ajaxMostrarPiso(){

		$item = "idcliente";
		$valor = $this->id;
		$respuesta = ControladorPiso::ctrMostrarPisos($item, $valor);	 

		echo json_encode($respuesta);
	}


} //FINAL DE LA CALSE



/* EDITAR USUARIO */

if (isset($_POST['idPiso'])) {
	
	$categoria = New AjaxPisos();
	$categoria->id = $_POST['idPiso'];
	$categoria->ajaxMostrarPiso();
}









?>
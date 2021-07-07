<?php 

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';

class AjaxCategoria{

	public $id;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->id;
		$respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);	 

		echo json_encode($respuesta);
	}


} //FINAL DE LA CALSE



/* EDITAR USUARIO */

if (isset($_POST['idCategoria'])) {
	
	$categoria = New AjaxCategoria();
	$categoria->id = $_POST['idCategoria'];
	$categoria->ajaxEditarCategoria();
}









?>
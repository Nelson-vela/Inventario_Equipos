<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public $activarUsuario;
	public $activarId;

	public function ajaxactivarUsuario(){

		$tabla = 'usuarios';
		
		$item = 'estado';
		$valor = $this->activarUsuario;

		$item2 = 'id';
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuarios($tabla, $item, $valor, $item2, $valor2);


	}



		/*=============================================
		VALIDAR REPETICIÓN USUARIO
		=============================================*/

		public $validarUsuario;

		public function ajaxvalidarUsuario(){

			
			$item = 'usuario';

			$valor = $this->validarUsuario;

			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

			echo json_encode($respuesta);


		}







} //FINAL DE LA CLASE





	/*=============================================
	EDITAR USUARIO
	=============================================*/
	if (isset($_POST['idUsuario'])) {


		$editar = new AjaxUsuarios();
		$editar->idUsuario = $_POST['idUsuario'];
		$editar->ajaxEditarUsuario();
	}

	

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/


	if (isset($_POST['activarUsuario'])) {

		$activar = new AjaxUsuarios();
		$activar->activarUsuario = $_POST['activarUsuario'];
		$activar->activarId = $_POST['activarId'];
		$activar->ajaxactivarUsuario();

	}




	/*=============================================
	VALIDAR REPETICIÓN USUARIO
	=============================================*/

	if (isset($_POST['validarUsuario'])) {

		$activar = new AjaxUsuarios();
		$activar->validarUsuario = $_POST['validarUsuario'];		
		$activar->ajaxvalidarUsuario();

	}

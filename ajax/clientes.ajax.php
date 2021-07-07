<?php 


require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';


class AjaxCliente{


	public $idCliente;

	public function ajaxEditarCliente(){


		$item = 'id';
		$valor = $this->idCliente;

		$respuesta = ControladorCliente::ctrMostrarCliente($item, $valor);

		echo json_encode($respuesta);


	}

	public $cliente;

		public function ajaxNombreCliente(){


		$item = null;
		$valor = null;

		$respuesta = ControladorCliente::ctrMostrarCliente($item, $valor);

		echo json_encode($respuesta);


	}






} //FIN DE LA CLASE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

/*=============================================
=            EDITAR CLIENTE           =
=============================================*/

if (isset($_POST['idCliente'])) {


	$cliente = new AjaxCliente();
	$cliente->idCliente = $_POST['idCliente'];
	$cliente->ajaxEditarCliente();
}



if (isset($_POST['cliente'])) {


	$cliente = new AjaxCliente();
	$cliente->idCliente = $_POST['cliente'];
	$cliente->ajaxNombreCliente();
}





}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}

?>
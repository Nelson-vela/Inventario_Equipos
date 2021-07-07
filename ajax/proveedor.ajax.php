 <?php 

require_once '../controladores/proveedores.controlador.php';
require_once '../modelos/proveedores.modelo.php';
 


class AjaxProveedor2{

 
	/*=============================================
	EDITAR COMPRAS
	=============================================*/	

	public $idProveedor;

	public function ajaxMostrarProveedor(){

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedor::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);

	}


}






	session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){


    /*=============================================

	INGRESAR 	

	=============================================*/

	if (isset($_POST['idProveedor'])) {

		$mostrarProveedor = new AjaxProveedor2();

		$mostrarProveedor->idProveedor = $_POST['idProveedor']; 
		$mostrarProveedor->ajaxMostrarProveedor();
	}



}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}



 
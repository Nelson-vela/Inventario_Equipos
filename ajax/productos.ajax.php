<?php 

require_once '../controladores/productos.controlador.php';
require_once '../modelos/productos.modelo.php';

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';



class AjaxProductos{



	public $idCategoria;

	public function AjaxCrearCodigoProducto(){

		$item = 'id_categoria';
		$valor = $this->idCategoria;
		$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);

		echo json_encode($respuesta);



	}



	/*==============================================================*/


	public $idProducto;
	public $traerProductos;
	public $nombreProducto;

	public function AjaxEditarProducto(){


		if ($this->traerProductos == 'ok') {
			
			$item = null;
			$valor = null;

			$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);

			echo json_encode($respuesta);

		}else if($this->nombreProducto !=''){

			$item = 'descripcion';
			$valor = $this->nombreProducto;

			$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);

			echo json_encode($respuesta);



		}else{

			$item = 'id';
			$valor = $this->idProducto;

			$respuesta = ControladorProducto::ctrMostrarProducto($item, $valor);

			echo json_encode($respuesta);

		}
	}






} //FIN DE LA CLASE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

/*=============================================
CODIGO PRODUCTOS
=============================================*/ 

if (isset($_POST['idCategoria'])) {

	$codigoProducto = new AjaxProductos();
	$codigoProducto->idCategoria = $_POST['idCategoria'];
	$codigoProducto->AjaxCrearCodigoProducto();
}



/*=============================================
EDITAR PRODUCTOS
=============================================*/ 

if (isset($_POST['idProducto'])) {

	$codigoProducto = new AjaxProductos();
	$codigoProducto->idProducto = $_POST['idProducto'];
	$codigoProducto->AjaxEditarProducto();
}



/*=============================================
TRAER PRODUCTOS
=============================================*/ 

if (isset($_POST['traerProductos'])) {

	$traerProductos = new AjaxProductos();
	$traerProductos->traerProductos = $_POST['traerProductos'];
	$traerProductos->AjaxEditarProducto();
}


/*=============================================
TRAER PRODUCTOS
=============================================*/ 

if (isset($_POST['nombreProducto'])) {

	$nombreProducto = new AjaxProductos();
	$nombreProducto->nombreProducto = $_POST['nombreProducto'];
	$nombreProducto->AjaxEditarProducto();
}

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}


?>
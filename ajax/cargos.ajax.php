 <?php 

require_once '../controladores/cargos.controlador.php';
require_once '../modelos/cargos.modelo.php';

 
 


class AjaxCargo{



 /*=============================================

	INGRESAR

	=============================================*/

	public $idCargo;	


	public function ajaxTraerCargos(){


		$item = "id";
		$valor = $this->idCargo;

		$respuesta = ControladorCargo::ctrMostrarCargos($item, $valor);

		echo json_encode($respuesta);

	}



	





} // FIN DE LA CLASE





	if (isset($_POST['idCargo'])) {


		$cargo = new AjaxCargo();
		$cargo->idCargo = $_POST['idCargo'];
		$cargo->ajaxTraerCargos();
	}



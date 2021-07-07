 <?php 

require_once '../controladores/equipos.controlador.php';
require_once '../modelos/equipos.modelo.php';


require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';

 


class AjaxArea{



 /*=============================================

	INGRESAR

	=============================================*/

	public $idArea;	


	public function ajaxTraerEquipoPorAreas(){


		$item = "id_area";
		$valor = $this->idArea;

		$respuesta = ControladorEquipo::ctrMostrarEquiposPorAreas($item, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================

	INGRESAR

	=============================================*/

	public $idAreas;	


	public function ajaxTraerArea(){


		$item = "id";
		$valor = $this->idAreas;

		$respuesta = ControladorArea::ctrMostrarAreas($item, $valor);

		echo json_encode($respuesta);

	}







} // FIN DE LA CLASE





	if (isset($_POST['idArea'])) {


		$area = new AjaxArea();
		$area->idArea = $_POST['idArea'];
		$area->ajaxTraerEquipoPorAreas();
	}






	if (isset($_POST['idAreas'])) {


		$areas = new AjaxArea();
		$areas->idAreas = $_POST['idAreas'];
		$areas->ajaxTraerArea();
	}



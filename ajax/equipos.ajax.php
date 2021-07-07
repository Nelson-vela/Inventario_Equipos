 <?php 
 

require_once '../controladores/equipos.controlador.php';
require_once '../modelos/equipos.modelo.php';


class AjaxEquipo{


/*=============================================
VER DETAKKES
	=============================================*/	

	public $idEquipo;

	public function ajaxVerDetalles(){

		$item = "id";
		$valor = $this->idEquipo;

		$respuesta = ControladorEquipo::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);

	}






} //FIN DE LA CLASE



/*=============================================
	EDITAR USUARIO
	=============================================*/
	if (isset($_POST['idEquipo'])) {


		$editar = new AjaxEquipo();
		$editar->idEquipo = $_POST['idEquipo'];
		$editar->ajaxVerDetalles();
	}

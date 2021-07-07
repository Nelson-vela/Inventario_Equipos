 <?php 

require_once '../controladores/mantenimiento.controlador.php';
require_once '../modelos/mantenimiento.modelo.php';
 


class AjaxMantenimiento{


 /*=============================================
	INGRESAR
	=============================================*/

	public $idMantenimiento;	

	public function ajaxTraerMantenimientoPorId(){

		$item = "id";
		$valor = $this->idMantenimiento;

		$respuesta = ControladorMantenimiento::ctrMostrarMantenimientos($item, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public $idMantenimiento2;
	public $estadoMantenimiento;
	public $idEquipo;

	public function ajaxEstadoMantenimiento(){

		$tabla = 'mantenimiento';
		$tabla2 = 'equipos';
		
		$item = 'estado';
		$valor = $this->estadoMantenimiento;

		$item2 = 'id';
		$valor2 = $this->idMantenimiento2;

		 
		$valor3 = $this->idEquipo;

		$respuesta = ModeloMantenimiento::mdlActualizarConclusion($tabla, $item, $valor, $item2, $valor2);

		$respuesta = ModeloMantenimiento::mdlActualizarConclusion($tabla2, $item, $valor, $item2, $valor3);

		echo json_encode($respuesta);


	}



} // FIN DE LA CLASE



	if (isset($_POST['idMantenimiento'])) {


		$mantenimiento = new AjaxMantenimiento();
		$mantenimiento->idMantenimiento = $_POST['idMantenimiento'];
		$mantenimiento->ajaxTraerMantenimientoPorId();
	}




/*=============================================
	ACTIVAR USUARIO
	=============================================*/


	if (isset($_POST['estadoMantenimiento'])) {

		$activar = new AjaxMantenimiento();
		$activar->idMantenimiento2 = $_POST['idMantenimiento'];
		$activar->estadoMantenimiento = $_POST['estadoMantenimiento'];
		$activar->idEquipo = $_POST['idEquipo'];
		$activar->ajaxEstadoMantenimiento();

	}

 <?php 

require_once '../controladores/proveedores.controlador.php';
require_once '../modelos/proveedores.modelo.php';


require_once '../controladores/compras.controlador.php';
require_once '../modelos/compras.modelo.php';


require_once '../controladores/tipodocumento.controlador.php';
require_once '../modelos/tipodocumento.modelo.php';


class AjaxProveedor{



 /*=============================================

	INGRESAR

	=============================================*/

	public $nombre;	
	public $direccion;	 	
	public $ruc;	
	public $telefono;
	public $email;	
	public $idUsuario;	



	public function ajaxCrearProveedor(){


		date_default_timezone_set('America/Bogota');

		$fecha = date('Y-m-d');
		$hora = date('H:i:s');

		$fechaActual = $fecha.' '.$hora; 

		$horaIngresada = $fechaActual;

		$tabla = 'proveedor';

		$datos = array("nombre" => $this->nombre,
						"direccion" => $this->direccion,		 
						"ruc" => $this->ruc,
						"telefono" => $this->telefono,
						"email" => $this->email,
						"idUsuario" => $this->idUsuario,
						"fechaIngreso" => $horaIngresada);	


		$respuesta = ModeloProveedores::mdlCrearProveedores($tabla, $datos);

		echo $respuesta;


	}


	/*=============================================
	EDITAR COMPRAS
	=============================================*/	

	public $id_tipodocumento_detalle;

	public function ajaxEditarCompras(){

		$item = "id_tipodocumento_detalle";
		$valor = $this->id_tipodocumento_detalle;

		$respuesta = ControladorCompras::ctrMostrarCompras($item, $valor);

		echo json_encode($respuesta);

	}



	/*=============================================
	EDITAR DOCUMENTO
	=============================================*/	

	public $id_tipodocumento_detalles;

	public function ajaxEditarDocumentoCompras(){

		$tabla = "tipo_documento_detalle";

		$item = "id";
		$valor = $this->id_tipodocumento_detalles;

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

		echo json_encode($respuesta);

	}





	/*=============================================
	VALIDAR SI EXISTE DATOS REPETIDOS EN EL DOCUMENTO DE COMPRA
	=============================================*/	

	public $nDocumento;
	public $serie;
	public $tipoDocumento;
	public $proveedor;

	public function ajaxValidarNumeroDeDocumentos(){

		$tabla = "tipo_documento_detalle";

		$datos = array("nDocumento" => $this->nDocumento,
						"serie" => $this->serie,		 
						"tipoDocumento" => $this->tipoDocumento,
						"proveedor" => $this->proveedor);	

		$respuesta = ModeloTipoDocumento::mdlValidarNumeroDeDocumento($tabla, $datos);

		echo json_encode($respuesta);

	}





} //FIN DE LA CLASE


session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){


    /*=============================================

	INGRESAR 	

	=============================================*/

	if (isset($_POST['nombre'])) {

		$crearVentasV = new AjaxProveedor();

		$crearVentasV->nombre = $_POST['nombre'];
		$crearVentasV->direccion = $_POST['direccion']; 
		$crearVentasV->ruc = $_POST['ruc'];
		$crearVentasV->telefono = $_POST['telefono'];
		$crearVentasV->email = $_POST['email'];	 
		$crearVentasV->idUsuario = $_POST['idUsuarioC'];	 
		$crearVentasV->ajaxCrearProveedor();
	}




    /*=============================================
	EDITAR USUARIO
	=============================================*/
	if (isset($_POST['id_tipodocumento_detalle'])) {


		$editar = new AjaxProveedor();
		$editar->id_tipodocumento_detalle = $_POST['id_tipodocumento_detalle'];
		$editar->ajaxEditarCompras();
	}









/*=============================================
	EDITAR USUARIO
	=============================================*/
	if (isset($_POST['idTipoDocumentoDetalles'])) {


		$editarDocumentoCompras = new AjaxProveedor();
		$editarDocumentoCompras->id_tipodocumento_detalles = $_POST['idTipoDocumentoDetalles'];
		$editarDocumentoCompras->ajaxEditarDocumentoCompras();
	}










	 /*=============================================
	VALIDAR DATOS REPETIDOS EN EL DOCUMENTO DE COMPRA
	=============================================*/
	if (isset($_POST['nDocumento'])) {


		$validar = new AjaxProveedor();
		$validar->nDocumento = $_POST['nDocumento'];
		$validar->serie = $_POST['serie'];
		$validar->tipoDocumento = $_POST['tipoDocumento'];
		$validar->proveedor = $_POST['proveedor'];
		$validar->ajaxValidarNumeroDeDocumentos();
	}



}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
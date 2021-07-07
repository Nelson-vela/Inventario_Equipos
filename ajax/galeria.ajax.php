<?php 

	require_once '../controladores/galeria.controlador.php';
	require_once '../modelos/galeria.modelo.php';


	class AjaxGaleria{

			public $nombreImagen;
			public $imagenTemporal;

					/*=============================================
					=            	SUBIENDO IMAGENES            =
					=============================================*/
					
					public function gestorGaleria(){

						$datos = array("nombreImagen" => $this->nombreImagen,
										"imagenTemporal" => $this->imagenTemporal);

						$respuesta = ControladorGaleria::ctrMostrarGaleria($datos);

						echo $respuesta;						

					}
					
					/*=====  End of 	SUBIENDO IMAGENES  ======*/




					/*======================================
					=            ELIMINAR SLIDE            =
					======================================*/
					
					public $idGaleria;
					public $rutaGaleria;

					public function eliminarGaleria(){

						$datos = array("idGaleria" => $this->idGaleria, "rutaGaleria" =>$this->rutaGaleria);

						$tabla = 'galeria';

						$respuesta = ControladorCategoriaGaleria::ctrEliminarGaleria($tabla, $datos);

						echo $respuesta;

					}
					
					/*=====  End of ELIMINAR s  ======*/


	} //FIN DE LA CLASE


session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

	/*=============================================
	EDITAR GALERIA
	=============================================*/
	if (isset($_POST['idGaleriaFoto'])) {


		$editarFoto = new AjaxGaleria();
		$editarfoto->idEditarFoto = $_POST['idGaleriaFoto'];
		$editarFoto->ajaxEditarGaleriaFoto();
	}

	 
	
	/*=============================================
	=           RECIBIENDO DATOS DE IMAGEN         =
	=============================================*/
	 
	if (isset($_FILES['imagen']['name'])) {

		$imagen = new AjaxGaleria();
		$imagen->nombreImagen = $_FILES['imagen']['name'];	
		$imagen->imagenTemporal = $_FILES['imagen']['tmp_name'];
		$imagen->gestorGaleria();
}

	/*=============================================
	=    RECIBIENDO DATOS DE IMAGEN PARA ELIMNAR        =
	=============================================*/
	 
	if (isset($_POST['idGaleria'])) {
			
		$eliminar = new AjaxGaleria();
		$eliminar->idGaleria= $_POST['idGaleria'];
		$eliminar->rutaGaleria= $_POST['rutaGaleria'];
		$eliminar->eliminarGaleria();
	
	}

	

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
	

	
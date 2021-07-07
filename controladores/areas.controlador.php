<?php


class ControladorArea{

/*=============================================
=            MOSTRAR AREAS        =
=============================================*/


  static public function ctrMostrarAreas($item, $valor){

	$tabla = 'areas';

	$respuesta = ModeloArea::mdlMostrarAreas($tabla, $item, $valor);

	return $respuesta;


}



	/*=============================================
	=        MOSTRAR TOTAL AREAS         =
	=============================================*/ 



	static public function ctrMostrarTotalAreas(){

		$tabla = 'areas';

		$respuesta = ModeloArea::mdlMostrarTotalAreas($tabla);

		return $respuesta;



	}



	/*=============================================
	=           INGRESAR AREAS         =
	=============================================*/

	static public function ctrCrearAreas(){


		if (isset($_POST['nuevoArea'])) {
			
			$tabla = 'areas';

			date_default_timezone_set('America/Lima');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora; 

			$horaIngresada = $fechaActual;

			$datos = array("area" => $_POST["nuevoArea"],							 
						   "fecha" => $horaIngresada);

			$respuesta = ModeloArea::mdlCrearAreas($tabla, $datos);


			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡El área se agrego correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){ 
							window.location = "areas";

						}

					});


				</script> 

				<?php
			}



		}

	} 
 



 /*=====================================
	=            EDITAR AREA        =
	=====================================*/
	
	static public function ctrEditarAreas(){


		if (isset($_POST['editarArea'])) {

			$tabla = 'areas';

			$datos = array("area" => $_POST["editarArea"], 
							"id" => $_POST["id"]);

			$respuesta = ModeloArea::mdlEditarAreas($tabla, $datos);


			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡El área se actualizó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){ 
							window.location = "areas";

						}

					});


				</script> 

				<?php
			}




		}


	}







	/*=============================================
	=            ELIMINAR CATEGORIA          =
	=============================================*/


	public static function ctrEliminarAreas(){


		if (isset($_GET['idArea'])) {
			

			$tabla = 'areas';			
			$valor = $_GET['idArea'];

			$respuesta = ModeloArea::mdlEliminarAreas($tabla, $valor);

			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡El área ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "areas";

						}

					});


				</script>

				<?php 

			}



		}





	}
	




} //FIIN DE LA CLASE
<?php

class ControladorPlantilla{

	 public static function ctrPlantilla(){

		include "vistas/plantilla.php";

	}	



	/*========================================
	=            MOSTAR PRESTAMOS            =
	========================================*/


	public static function ctrOperacion(){


		$tabla = 'plantilla';

		$item = null;
		$valor = null;

		$respuesta = ModeloPlantilla::mdlMostrarPrestamos($tabla, $item, $valor);

		return $respuesta;


	}

	/*========================================
	=            MOSTAR PRESTAMOS            =
	========================================*/


	public static function ctrMostrarGastosFijos($item, $valor){


		$tabla = 'plantilla';		

		$respuesta = ModeloPlantilla::mdlMostrarPrestamos($tabla, $item, $valor);

		return $respuesta;


	}



	/*=======================================
 	=            INGRESAR GASTOS FIJOS            =
 	=======================================*/
 	
 	
 	public static function ctrIngresarGastosFijos(){

 		if (isset($_POST['nuevoDescripcionGastos'])) {




 			$tabla = 'plantilla';

 			$datos = array("descripcion" => $_POST["nuevoDescripcionGastos"],
 				"gastos" => $_POST["nuevoMontoGastos"],
 				"fecha" => $_POST["nuevoFechaGastos"]);

 			$respuesta = ModeloPlantilla::mdlIngresarGastosFijos($tabla, $datos);

 			if ($respuesta == 'ok') { ?>


 				<script>

 					swal({

 						type: "success",
 						title: "¡El gasto fijo se agrego correctamente!",
 						showConfirmButton: true,
 						confirmButtonText: "Cerrar",
 						closeOnConfirm: false

 					}).then((result)=>{

 						if(result.value){

 							window.location = "gastos-fijos";

 						}

 					});


 				</script> 

 				<?php
 			}




 		}


 	}



/*=============================================
	=            EDITAR GASTOS          =
	=============================================*/


	public static function ctrEditarGastosFijo(){

		if (isset($_POST['editarDescripcionGastos'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionGastos"])){


				$tabla = 'plantilla';			 


				$datos = array("id" => $_POST['id'],
								"descripcion" =>$_POST["editarDescripcionGastos"],
								"gastos" =>$_POST["editarMontoGastos"],
								"fecha" =>$_POST['editaroFechaGastos']);

				$respuesta = ModeloPlantilla::mdlEditarGastosFijos($tabla, $datos);

				if ($respuesta == 'ok') { ?>
					
					
					<script>

						swal({

							type: "success",
							title: "El gasto fijo se actualizó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "gastos-fijos";

							}

						});


					</script> 

					<?php
				}




			}else{ ?>

				<script>

					swal({

						type: "error",
						title: "El gasto no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "gastos-fijos";

						}

					});


				</script> 

				<?php


			}



		}



	}



/*=======================================
=            ELIMINAR GASTOS            =
=======================================*/

public static function ctrEliminarGastosFijos(){


	if (isset($_GET['idGastosFijos'])) {


		$tabla = 'plantilla';			
		$valor = $_GET['idGastosFijos'];

		$respuesta = ModeloPlantilla::mdlEliminarGastosFijos($tabla, $valor);

		if ($respuesta == 'ok') { ?>

			<script>

				swal({

					type: "success",
					title: "¡El gasto fijo ha sido borrado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "gastos-fijos";

					}

				});


			</script>

			<?php 

		}


	}



}




/*=============================================

	=        MOSTRAR TOTAL DE LAS VENTAS           =

	=============================================*/ 



	public static function ctrMostrarTotalGastosFijos(){



		$tabla = 'plantilla';



		$respuesta = ModeloPlantilla::mdlMostrarTotalGastosFijos($tabla);



		return $respuesta;



	}







}
<?php 


class ControladorPresupuesto{




	/*=====================================
	=            MOSTAR GASTOS            =
	=====================================*/
	
	public static function ctrMostrarGastos($item, $valor){


		$tabla = 'presupuesto';

		$respuesta = ModeloPresupuesto::mdlMostrarGastos($tabla, $item, $valor);

		return $respuesta;

	}



	/*=============================================

	=        MOSTRAR TOTAL DE LAS VENTAS           =

	=============================================*/ 



	public static function ctrMostrarTotalGastos(){



		$tabla = 'presupuesto';



		$respuesta = ModeloPresupuesto::mdlMostrarTotalGasto($tabla);



		return $respuesta;



	}


	/*=============================================

	=        MOSTRAR TOTAL DE LAS VENTAS           =

	=============================================*/ 



	public static function ctrMostrarTotalPorMes($datos){

		$tabla = 'ventas';

		$respuesta = ModeloPresupuesto::mdlMostrarTotalPorMes($tabla, $datos);

		return $respuesta;



	}


	/*=============================================

	=        MOSTRAR TOTAL DE LAS VENTAS           =

	=============================================*/ 



	public static function ctrMostrarTotalPresupuestoPorMes($datos){

		$tabla = 'presupuesto';

		$respuesta = ModeloPresupuesto::mdlMostrarTotalPresupuestoPorMes($tabla, $datos);

		return $respuesta;



	}
	



 	/*=======================================
 	=            INGRESAR GASTOS            =
 	=======================================*/
 	
 	
 	public static function ctrIngresarGastos(){

 		if (isset($_POST['nuevoDescripcionGastos'])) {




 			$tabla = 'presupuesto';

 			$datos = array("descripcion" => $_POST["nuevoDescripcionGastos"],
			 				"cantidad" => $_POST["nuevoCantidadGastos"],
			 				"gastos" => $_POST["nuevoMontoGastos"],
			 				"gastoTotal" => $_POST["nuevoMontoGastosTotal"],
			 				"fecha" => $_POST["nuevoFechaGastos"],
			 				"responsable" => $_POST["nuevoResponsableGastos"]);

 			$respuesta = ModeloPresupuesto::mdlIngresarGastos($tabla, $datos);

 			if ($respuesta == 'ok') { ?>


 				<script>

 					swal({

 						type: "success",
 						title: "¡La compra se agrego correctamente!",
 						showConfirmButton: true,
 						confirmButtonText: "Cerrar",
 						closeOnConfirm: false

 					}).then((result)=>{

 						if(result.value){

 							window.location = "gastos";

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


	public static function ctrEditarGastos(){

		if (isset($_POST['editarDescripcionGastos'])) {


				$tabla = 'presupuesto';			 


				$datos = array("id" => $_POST['id'],
								"descripcion" =>$_POST["editarDescripcionGastos"],
								"cantidad" =>$_POST["editarCantidadGastos"],
								"gastos" =>$_POST["editarMontoGastos"],
								"gastoTotal" =>$_POST["editarMontoGastosTotal"],
								"fecha" =>$_POST['editaroFechaGastos'],
								"responsable" =>$_POST['editarResponsableGastos']);

				$respuesta = ModeloPresupuesto::mdlEditarGastos($tabla, $datos);

				if ($respuesta == 'ok') { ?>
					
					
					<script>

						swal({

							type: "success",
							title: "La compra se actualizó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "gastos";

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

public static function ctrEliminarGastos(){


	if (isset($_GET['idGastos'])) {


		$tabla = 'presupuesto';			
		$valor = $_GET['idGastos'];

		$respuesta = ModeloPresupuesto::mdlEliminarGastos($tabla, $valor);

		if ($respuesta == 'ok') { ?>

			<script>

				swal({

					type: "success",
					title: "¡La compra ha sido borrado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "gastos";

					}

				});


			</script>

			<?php 

		}


	}



}








}
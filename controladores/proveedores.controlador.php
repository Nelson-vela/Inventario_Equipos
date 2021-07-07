<?php 


class ControladorProveedor{




	/*=====================================
	=            MOSTAR TIPO DOCUMENTO            =
	=====================================*/
	
	public static function ctrMostrarProveedores($item, $valor){


		$tabla = 'proveedor';

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;

	}




	/*=====================================
	=            INGRESAR DOCUMENTO         =
	=====================================*/
	
	static public function ctrIngresarProveedor(){


		if (isset($_POST['nuevoRucProveedor'])) {


			$tabla = 'proveedor';

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora; 

			$horaIngresada = $fechaActual;

			$datos = array("nombre" => $_POST["nuevoNombreProveedor"],
				"ruc" => $_POST["nuevoRucProveedor"],
				"direccion" => $_POST["nuevoDireccionProveedor"],
				"email" => $_POST["nuevoEmailProveedor"],
				"telefono" => $_POST["nuevoTelefonoProveedor"],
				"fechaIngreso" => $horaIngresada);

			$respuesta = ModeloProveedores::mdlCrearProveedores($tabla, $datos);


			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡El proveedor se agrego correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){ 
							window.location = "proveedores";

						}

					});


				</script> 

				<?php
			}




		}


	}




	/*=====================================
	=            IEDITAR        =
	=====================================*/
	
	static public function ctrEditarProveedor(){


		if (isset($_POST['editarRucProveedor'])) {


			$tabla = 'proveedor';
/*
			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora; 

			$horaIngresada = $fechaActual;
*/
			$datos = array("nombre" => $_POST["editarNombreProveedor"],
				"ruc" => $_POST["editarRucProveedor"],
				"direccion" => $_POST["editarDireccionProveedor"],
				"email" => $_POST["editarEmailProveedor"],
				"telefono" => $_POST["editarTelefonoProveedor"],
				"id" => $_POST["id"]);

			$respuesta = ModeloProveedores::mdlEditarProveedores($tabla, $datos);


			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡El proveedor se actualizó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){ 
							window.location = "proveedores";

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


	public static function ctrEliminarProveedor(){


		if (isset($_GET['idProveedor'])) {
			

			$tabla = 'proveedor';			
			$valor = $_GET['idProveedor'];

			$respuesta = ModeloProveedores::mdlEliminarProveedores($tabla, $valor);

			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡El proveedor ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "proveedores";

						}

					});


				</script>

				<?php 

			}



		}





	}


	/*=============================================

	=        MOSTRAR TOTAL PROVEEDORES         =

	=============================================*/ 



	static	public function ctrMostrarTotalProveedor(){



		$tabla = 'proveedor';



		$respuesta = ModeloProveedores::mdlMostrarTotalProveedores($tabla);



		return $respuesta;



	}






} // FIN DE LA CLASE
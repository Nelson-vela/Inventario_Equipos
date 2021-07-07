<?php

class ControladorCategoria{



	/*=============================================
	=            AGREGAR CATEGORIA          =
	=============================================*/

	public static function ctrCrearCategoria(){

		if (isset($_POST['nuevaCategoria'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){


				$tabla = 'categorias';

				$datos = array("categoria" => $_POST["nuevaCategoria"]);

				$respuesta = ModeloCategoria::mdlIngresarCategoria($tabla, $datos);

				if ($respuesta == 'ok') { ?>
					
					
					<script>

						swal({

							type: "success",
							title: "¡La categoría se agrego correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "categorias";

							}

						});


					</script> 

					<?php
				}




			}else{ ?>

				<script>

					swal({

						type: "error",
						title: "¡La categoría no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

						}

					});


				</script> 

				<?php


			}

		}





	}



	/*=============================================
	=            MOSTRAR CATEGORIA          =
	=============================================*/


	 public static function ctrMostrarCategoria($item, $valor){

		$tabla = 'categorias';		

		$respuesta = ModeloCategoria::mdlMostrarCategoria($tabla, $item, $valor);

		return $respuesta;



	}



	/*=============================================
	=            EDITAR CATEGORIA          =
	=============================================*/


	public static function ctrEditarCategoria(){

		if (isset($_POST['editarCategoria'])) {

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){


				$tabla = 'categorias';

				$item = $_POST['idCategoria'];

				$valor = $_POST["editarCategoria"];

				$respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $item, $valor);

				if ($respuesta == 'ok') { ?>
					
					
					<script>

						swal({

							type: "success",
							title: "¡La categoría se actualizó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false

						}).then((result)=>{

							if(result.value){

								window.location = "categorias";

							}

						});


					</script> 

					<?php
				}




			}else{ ?>

				<script>

					swal({

						type: "error",
						title: "¡La categoría no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

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


	public static function ctrEliminarCategoria(){


		if (isset($_GET['idCategoria'])) {
			

			$tabla = 'categorias';			
			$valor = $_GET['idCategoria'];

			$respuesta = ModeloCategoria::mdlEliminarCategoria($tabla, $valor);

			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡La categoría ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "categorias";

						}

					});


				</script>

				<?php 

			}



		}





	}


/*=============================================
	=        MOSTRAR TOTAL CATEGORIA         =
	=============================================*/ 

	public static function ctrMostrarTotalCategoria(){

	$tabla = 'categorias';

	$respuesta = ModeloCategoria::mdlMostrarTotalCategoria($tabla);

	return $respuesta;

	}




} //FIN DE LA CLASE
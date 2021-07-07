<?php 


class ControladorTipoDocumento{




	/*=====================================
	=            MOSTAR TIPO DOCUMENTO            =
	=====================================*/
	
	public static function ctrMostrarTipoDocumento($item, $valor){


		$tabla = 'tipo_documento';

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

		return $respuesta;

	}


	/*==========================================================================================*/
	/*=====  End of Section comment block  ======*/
	/*==========================================================================================*/
	/*=====  End of Section comment block  ======*/




	/*=====================================
	=            MOSTAR TIPO DOCUMENTO DETALLE           =
	=====================================*/
	
	public static function ctrMostrarTipoDocumentoDetalle($item, $valor){


		$tabla = 'tipo_documento_detalle';

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

		return $respuesta;

	}




	/*=====================================
	=            INGRESAR DOCUMENTO         =
	=====================================*/
	
	public static function ctrAgregarTipoDocumento(){


		if (isset($_POST['nuevoTipoDocumento'])) {


			$tabla = 'tipo_documento_detalle';			

			$datos = array("id_proveedor" => $_POST["nuevoProveedorDocumento"],
				"id_tipo_documento" => $_POST["nuevoTipoDocumento"],
				"serie" => $_POST["nuevoSerieDocumento"],
				"ntipo" => $_POST["nuevoNumeroDocumento"],
				"fecha_emision" => $_POST["nuevoFechaEmision"],
				"fecha_almacenamiento" => $_POST["nuevoFechaAlmacenamiento"],
				"id_usuario" => $_POST["idUsuarioC"]);

			$respuesta = ModeloTipoDocumento::mdlAgregarTipoDocumento($tabla, $datos);

			$tabla2 = 'compras';


			$idultimo = ModeloTipoDocumento::mdlObtenerUltimoId($tabla);

			foreach ($idultimo as $key => $cod) { }
				 
				$codigo = $cod[0];



			$datos2 = array("id_tipodocumento_detalle" => $codigo,
							"fecha_compra" => $_POST["nuevoFechaEmision"]);

			$agregarDocumentoEnCompras = ModeloCompras::mdlAgregarTipoDocumentoCompras($tabla2, $datos2);

			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡El documento se agrego correctamente!",
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

public static function ctrEliminarTipoDocumento(){


	if (isset($_GET['idTipoDocumentoDetalle'])) {


		$tabla = 'tipo_documento_detalle';			
		$tabla2 = 'compras';	

		$valor = $_GET['idTipoDocumentoDetalle'];

		$respuesta = ModeloTipoDocumento::mdlEliminarTipoDocumento($tabla, $valor);
		$respuesta2 = ModeloCompras::mdlEliminarTipoDocumentoCompras($tabla2, $valor);

		if ($respuesta == 'ok') { ?>

			<script>

				swal({

					type: "success",
					title: "El documento ha sido borrado correctamente!",
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






	/*=====================================
	=            INGRESAR DOCUMENTO         =
	=====================================*/
	
	public static function ctrActualizarTipoDocumento(){


		if (isset($_POST['editarTipoDocumento'])) {


			$tabla = 'tipo_documento_detalle';			

			$datos = array("id_proveedor" => $_POST["editarProveedorDocumento"],
							"id_tipo_documento" => $_POST["editarTipoDocumento"],
							"serie" => $_POST["editarSerieDocumento"],
							"ntipo" => $_POST["editarNumeroDocumento"],
							"fecha_emision" => $_POST["editarFechaEmision"],
							"fecha_almacenamiento" => $_POST["editarFechaAlmacenamiento"],
							"id" => $_POST['idDocumentoCompra']);
			

			$respuesta = ModeloTipoDocumento::mdlEditarTipoDocumento($tabla, $datos);

			$tabla2 = 'compras';


			/*$$idultimo = ModeloTipoDocumento::mdlObtenerUltimoId($tabla);

			foreach ($idultimo as $key => $cod) { }
				 
				$codigo = $cod[0];*/
 

			$item2 = 'id_tipodocumento_detalle';
			$valor2 = $_POST['idDocumentoCompra'];

			$item = 'fecha_compra';
			$valor = $_POST["editarFechaEmision"];

			$agregarDocumentoEnCompras = ModeloCompras::mdlActualizarTipoDocumentoCompras($tabla2, $item, $valor, $item2, $valor2);

			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡El documento se actualizó correctamente!",
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















} //FIN DE LA CLASE
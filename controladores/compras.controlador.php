<?php 


class ControladorCompras{

 
	/*=====================================
	=            MOSTAR COMRPAS            =
	=====================================*/
	
	public static function ctrMostrarCompras($item, $valor){


		$tabla = 'compras';

		$respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

		return $respuesta;

	}




	/*=====================================
	=            INGRESAR DOCUMENTO         =
	=====================================*/
	
	public static function ctrAgregarCompras(){


		if (isset($_POST['nuevoResponsableGastos'])) {


			$tabla = 'compras';

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora; 

			$horaIngresada = $fechaActual;

			$datos = array("nuevoResponsableGastos" => $_POST["nuevoResponsableGastos"],
							"totalVenta" => $_POST["totalVenta"],
							"listaProductosDocumento" => $_POST["listaProductosDocumento"],
							"id_tipodocumento_detalle" => $_POST["id_tipodocumento_detalle"],
							"fecha_compra" => $horaIngresada);

			$respuesta = ModeloCompras::mdlAgregarCompras($tabla, $datos);


			$tabla2 = "tipo_documento_detalle";

			$item = 'total';
			$valor = $_POST["totalVenta"];

			$item2 = 'id';
			$valor2 = $_POST["id_tipodocumento_detalle"];


			$actualizarTotal = ModeloTipoDocumento::mdlActualizarTipoDocumento($tabla2, $item, $valor, $item2, $valor2);

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

							localStorage.removeItem("listaProductos3");
							window.location = "gastos";

						}

					});


				</script> 

				<?php
			}




		}


	}






	/*=====================================
	=            ACTUALIZAR  DOCUMENTO         =
	=====================================*/
	
	public static function ctrActualizarCompras(){


		if (isset($_POST['nuevoResponsableGastos'])) {


			$tabla = 'compras';

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$fechaActual = $fecha.' '.$hora; 

			$horaIngresada = $fechaActual;

			$datos = array("nuevoResponsableGastos" => $_POST["nuevoResponsableGastos"],
							"totalVenta" => $_POST["totalVenta"],
							"listaProductosDocumento" => $_POST["listaProductosDocumento"],
							"id_tipodocumento_detalle" => $_POST["id_tipodocumento_detalle"],
							"fecha_compra" => $horaIngresada);

			/*$respuesta = ModeloCompras::mdlAgregarCompras($tabla, $datos);*/
			$respuesta = ModeloCompras::mdlActualizarCompras($tabla, $datos);


			$tabla2 = "tipo_documento_detalle";

			$item = 'total';
			$valor = $_POST["totalVenta"];

			$item2 = 'id';
			$valor2 = $_POST["id_tipodocumento_detalle"];


			$actualizarTotal = ModeloTipoDocumento::mdlActualizarTipoDocumento($tabla2, $item, $valor, $item2, $valor2);

			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "¡La compra se guardó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							localStorage.removeItem("listaProductos3");
							window.location = "gastos";

						}

					});


				</script> 

				<?php
			}




		}


	}



/*=============================================

	=        MOSTRAR TOTAL co,pas         =

	=============================================*/ 



	static public function ctrMostrarTotalCompras(){



		$tabla = 'compras';



		$respuesta = ModeloCompras::mdlMostrarTotalCompras($tabla);



		return $respuesta;



	}









} //FIN DE LA CLASE
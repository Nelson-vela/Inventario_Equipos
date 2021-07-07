<?php 





class ControladorVenta{





		/*=============================================

		=            MOSTRAR VENTA           =

		=============================================*/





		public static function ctrMostrarVenta($item, $valor){



			$tabla = 'ventas';



			$respuesta = ModeloVenta::mdlMostrarVenta($tabla, $item, $valor);



			return $respuesta;



		}







		/*=============================================

		=            CREAR VENTA           =

		=============================================*/







		public static function ctrCrearVenta(){



			if (isset($_POST['nuevaVenta'])) {



		/*=============================================

		=            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR Y AUMENTAR  LAS VENTAS         =

		=============================================*/



		$listaProductos = json_decode($_POST['listaProductos'], true);

		$listaProductosExtra = json_decode($_POST['listaProductosExtra'], true);



		$totalProductosComprados = array();



		

		foreach ($listaProductos as $key => $value) {



			array_push($totalProductosComprados, $value['cantidad']);





			$tablaProductos = 'productos';



			$item = 'id';

			$valor = $value['id'];



			$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos, $item, $valor);



			

			$item1 = 'ventas';

			$valor1 = $value['cantidad']+$traerProducto['ventas'];



			$nuevasVentas = ModeloProducto::mdlActualizarProducto($tablaProductos, $item1, $valor1, $valor);





			$item2 = 'stock';

			$valor2 = $value['stock'];



			$nuevoStock = ModeloProducto::mdlActualizarProducto($tablaProductos, $item2, $valor2, $valor);

		}



		$tablaCliente = 'clientes';



		$item = 'id';

		$valor = $_POST['seleccionarCliente'];



		$traerCliente = ModeloCliente::mdlMostrarCliente($tablaCliente, $item, $valor);





		$item2 = 'compras';

		$valor2 = array_sum($totalProductosComprados) + $traerCliente['compras'];



		$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item2, $valor2, $valor);







		$item3 = 'ultima_compra';



		date_default_timezone_set('Europe/Madrid');



		$fecha = date('Y-m-d');

		$hora = date('H:i:s');



		$fechaActual = $fecha.' '.$hora;

		

		$valor3 = $fechaActual;



		$ultimaCompra = ModeloCliente::mdlActualizarCliente($tablaCliente, $item3, $valor3, $valor);







		/*=============================================

		=            GUARDAR COMPRA           =

		=============================================*/



		$tabla = 'ventas';
		
		
		date_default_timezone_set('Europe/Madrid');

		$fecha = date('Y-m-d');
        //$hora = date('H:i:s');

		$fechaActual = $fecha;

		/*======================================
		=            OBTENER CODIGO            =
		======================================*/
		$obtenerCodigo = ModeloVenta::mdlObtenerUltimoId($tabla);

		if ($_POST['nuevaVenta'] == '10001') {

			$codigo = '10001';

		}else{


			foreach ($obtenerCodigo as $key => $cod) {

			}

			$codigo = $cod[0];

		}

		
		


		$datos = array('id_vendedor' => $_POST['idVendedor'],

			'codigo' => $codigo,

			/*'numPedido' => $_POST['nuevaNumPedido'],

			'numObra' => $_POST['nuevaNumObra'],*/

			'cliente' => $_POST['seleccionarCliente'],

			'direccion' => $_POST['nuevaDireccion'],

			'telefono' => $_POST['nuevaTelefono'],

			'email' => $_POST['nuevoEmail'],

			'productos' => $_POST['listaProductos'],

			'productosExtras' => $_POST['listaProductosExtra'],

			'impuesto' => $_POST['nuevoPrecioImpuesto'],

			'neto' => $_POST['nuevoPrecioNeto'],

			'total' => $_POST['totalVenta'],
			
			'fechaModi' => $fechaActual,

			'metodoPago' => 'Transferencia Bancaria');



		$respuesta = ModeloVenta::mdlCrearventa($tabla, $datos);



		if ($respuesta == 'ok') {

			?>



			<script>



				swal({	



					type: "success",

					title: "¡El servicio ha sido realizado correctamente!",

					showConfirmButton: true,

					confirmButtonText: "Cerrar",

					closeOnConfirm: false



				}).then((result)=>{



					if(result.value){



						window.location = "administrar-servicios";



					}



				});





			</script> 



			<?php

		}





	}







}























		/*=============================================

		=            EDITAR VENTA           =

		=============================================*/









		public static function ctrEditarVenta(){



			if (isset($_POST['editarVenta'])) {





				/*=============================================

				=            FORMATEAR TABLA DE PRODUCTOS Y CLIENTES         =

				=============================================*/



				$tabla = 'ventas';



				$item = 'codigo';

				$valor = $_POST['editarVenta'];



				$traerVenta  = ModeloVenta::mdlMostrarVenta($tabla, $item, $valor);



				$productos = json_decode($traerVenta['productos'], true);



				$totalProductosComprados = array();



				foreach ($productos as $key => $value) {



					array_push($totalProductosComprados, $value['cantidad']);

					

					$tablaProductos = 'productos';



					$item = 'id';

					$valor = $value['id'];



					$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos, $item, $valor);





					$item1 = 'ventas';

					$valor1 = $traerProducto['ventas'] - $value['cantidad'];



					$nuevasVentas = ModeloProducto::mdlActualizarProducto($tablaProductos, $item1, $valor1, $valor);





					$item2 = 'stock';

					$valor2 = $value['cantidad'] + $traerProducto['stock'];



					$nuevoStock = ModeloProducto::mdlActualizarProducto($tablaProductos, $item2, $valor2, $valor);



					

				}



				$tablaCliente = 'clientes';



				$itemCliente = 'id';

				$valorCliente = $_POST['seleccionarCliente'];



				$traerCliente = ModeloCliente::mdlMostrarCliente($tablaCliente, $itemCliente, $valorCliente);





				$item2 = 'compras';

				$valor2 = $traerCliente['compras'] - array_sum($totalProductosComprados);



				$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item2, $valor2, $valor);





				/*=============================================

				=            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR Y AUMENTAR  LAS VENTAS         =

				=============================================*/





				$listaProductos_2 = json_decode($_POST['listaProductos'], true);

				$listaProductosExtra = json_decode($_POST['listaProductosExtra'], true);



				$totalProductosComprados_2 = array();





				foreach ($listaProductos_2 as $key => $value) {



					array_push($totalProductosComprados_2, $value['cantidad']);





					$tablaProductos_2 = 'productos';



					$item_2 = 'id';

					$valor_2 = $value['id'];



					$traerProducto_2 = ModeloProducto::mdlMostrarProducto($tablaProductos_2, $item_2, $valor_2);





					$item1_2 = 'ventas';

					$valor1_2 = $value['cantidad']+$traerProducto_2['ventas'];



					$nuevasVentas_2 = ModeloProducto::mdlActualizarProducto($tablaProductos_2, $item1_2, $valor1_2, $valor_2);





					$item2_2 = 'stock';

					$valor2_2 = $value['stock'];



					$nuevoStock_2 = ModeloProducto::mdlActualizarProducto($tablaProductos_2, $item2_2, $valor2_2, $valor_2);

				}



				$tablaCliente_2 = 'clientes';



				$item_2 = 'id';

				$valor_2 = $_POST['seleccionarCliente'];



				$traerCliente_2 = ModeloCliente::mdlMostrarCliente($tablaCliente_2, $item_2, $valor_2);





				$item2_2 = 'compras';

				$valor2_2 = array_sum($totalProductosComprados_2) + $traerCliente_2['compras'];



				$comprasCliente_2 = ModeloCliente::mdlActualizarCliente($tablaCliente_2, $item2_2, $valor2_2, $valor_2);







				$item3_2 = 'ultima_compra';



				date_default_timezone_set('Europe/Madrid');



				$fecha = date('Y-m-d');

				$hora = date('H:i:s');



				$fechaActual = $fecha.' '.$hora;



				$valor3_2 = $fechaActual;



				$ultimaCompra = ModeloCliente::mdlActualizarCliente($tablaCliente_2, $item3_2, $valor3_2, $valor_2);







		/*=============================================

		=            GUARDAR COMPRA           =

		=============================================*/



		//$tabla = 'ventas';



		$datos = array(/*'id_vendedor' => $_POST['idVendedor'],

			'id_cliente' => $_POST['seleccionarCliente'],

			'codigo' => $_POST['editarVenta'],

			'numPedido' => $_POST['editarNumPedido'],

			'numObra' => $_POST['editarNumObra'],*/

			'id_vendedor' => $_POST['idVendedor'],

			'codigo' => $_POST['editarVenta'],

			'productos' => $_POST['listaProductos'],

			'productosExtras' => $_POST['listaProductosExtra'],

			'impuesto' => $_POST['nuevoPrecioImpuesto'],

			'neto' => $_POST['nuevoPrecioNeto'],

			'total' => $_POST['totalVenta']);

		/*'metodoPago' => 'Transferencia Bancaria'*/



		$respuesta = ModeloVenta::mdlEditarVenta($tabla, $datos);



		if ($respuesta == 'ok') {

			?>



			<script>



				swal({	



					type: "success",

					title: "¡El servicio ha sido realizado correctamente!",

					showConfirmButton: true,

					confirmButtonText: "Cerrar",

					closeOnConfirm: false



				}).then((result)=>{



					if(result.value){



						window.location = "administrar-servicios";



					}



				});





			</script> 



			<?php

		}







	}



}



		/*=============================================

			    ELIMINAR VENTAS        =

			    =============================================*/





			    public static function ctrEliminarVenta(){



			    	if (isset($_GET['idVenta'])) {



			    		$tabla = 'ventas';



			    		$item = 'id';

			    		$valor = $_GET['idVenta'];



			    		$traerVenta = ModeloVenta::mdlMostrarVenta($tabla,$item, $valor);





						/*=============================================

						=     ACTUALIZAR FECHA ÚLTIMA COMPRA          =

						=============================================*/



						$tablaCliente = 'clientes';



						$itemVentas = null;

						$valorVentas = null;



						$traerVentas = ModeloVenta::mdlMostrarVenta($tabla, $itemVentas, $valorVentas);



						$guardarFechas = array();



						foreach ($traerVentas as $key => $value) {

							

							if ($value['id_cliente'] == $traerVenta['id_cliente']) {								



								array_push($guardarFechas, $value['fecha']);

							}

						}





						





						if (count($guardarFechas)>1) {



							if ($traerVenta['fecha'] > $guardarFechas[count($guardarFechas)-2]) {

								



								$item = 'ultima_compra';

								$valor = $guardarFechas[count($guardarFechas)-2];

								$valorIdCliente = $traerVenta['id_cliente'];



								$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item, $valor, $valorIdCliente);



							}else{



								$item = 'ultima_compra';

								$valor = $guardarFechas[count($guardarFechas)-1];

								$valorIdCliente = $traerVenta['id_cliente'];



								$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item, $valor, $valorIdCliente);



							}



							

						}else{



							$item = 'ultima_compra';

							$valor = '0000-00-00 00:00:00';

							$valorCliente = $traerVenta['id_cliente'];



							$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item, $valor, $valorCliente);





						}



						/*=============================================

						=     FORMATEAR TABLA DE PRODUCTOS Y LA DEL CLIENTE         =

						=============================================*/



						$productos = json_decode($traerVenta['productos'], true);



						$totalProductosComprados = array();



						foreach ($productos as $key => $value) {



							array_push($totalProductosComprados, $value['cantidad']);



							$tablaProductos = 'productos';



							$item = 'id';

							$valor = $value['id'];



							$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos, $item, $valor);





							$item1 = 'ventas';

							$valor1 = $traerProducto['ventas'] - $value['cantidad'];



							$nuevasVentas = ModeloProducto::mdlActualizarProducto($tablaProductos, $item1, $valor1, $valor);





							$item2 = 'stock';

							$valor2 = $traerProducto['stock'] + $value['cantidad'];



							$nuevoStock = ModeloProducto::mdlActualizarProducto($tablaProductos, $item2, $valor2, $valor);





						}



						$tablaCliente = 'clientes';



						$itemCliente = 'id';

						$valorCliente = $traerVenta['id_cliente'];



						$traerCliente = ModeloCliente::mdlMostrarCliente($tablaCliente, $itemCliente, $valorCliente);





						$item2 = 'compras';

						$valor2 = $traerCliente['compras'] - array_sum($totalProductosComprados);



						$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item2, $valor2, $valorCliente); //

						//$productos = json_decode($traerVenta['productos'], true);



						/*$totalProductosComprados = array();



						foreach ($productos as $key => $value) {



							array_push($totalProductosComprados, $value['cantidad']);



							$tablaProductos = 'productos';



							$item = 'id';

							$valor = $value['id'];



							$traerProducto = ModeloProducto::mdlMostrarProducto($tablaProductos, $item, $valor);





							$item1 = 'ventas';

							$valor1 = $traerProducto['ventas'] - $value['cantidad'];



							$nuevasVentas = ModeloProducto::mdlActualizarProducto($tablaProductos, $item1, $valor1, $valor);





							$item2 = 'stock';

							$valor2 = $value['cantidad'] + $traerProducto['stock'];



							$nuevoStock = ModeloProducto::mdlActualizarProducto($tablaProductos, $item2, $valor2, $valor);





						}



						$tablaCliente = 'clientes';



						$itemCliente = 'id';

						$valorCliente = $traerVenta['id_cliente'];



						$traerCliente = ModeloCliente::mdlMostrarCliente($tablaCliente, $itemCliente, $valorCliente);





						$item2 = 'compras';

						$valor2 = $traerCliente['compras'] - array_sum($totalProductosComprados);



						$comprasCliente = ModeloCliente::mdlActualizarCliente($tablaCliente, $item2, $valor2, $valorCliente);*/





						/*=============================================

						=     ELIMINAR VENTA         =

						=============================================*/



						$respuesta = ModeloVenta::mdlEliminarVenta($tabla, $_GET['idVenta']);



						if($respuesta == "ok"){ ?>



							<script>



								swal({

									type: "success",

									title: "la venta se elimino correctamente",

									showConfirmButton: true,

									confirmButtonText: "Cerrar",

									closeOnConfirm: false

								}).then((result) => {

									if (result.value) {



										window.location = "administrar-servicios";

										

									}

								})



							</script>



							<?php

						}









					}







				}











	/*=============================================

	=        MOSTRAR TOTAL DE LAS VENTAS           =

	=============================================*/ 



	public static function ctrMostrarTotalVenta(){



		$tabla = 'ventas';



		$respuesta = ModeloVenta::mdlMostrarTotalVenta($tabla);



		return $respuesta;



	}





	/*=============================================

	=        MOSTRAR TOTAL DE LOS SERVICIOS POR COBRAR         =

	=============================================*/ 



	public static function ctrMostrarTotalVentaPendiente(){



		$tabla = 'ventas';



		$respuesta = ModeloVenta::mdlMostrarTotalVentaPendiente($tabla);



		return $respuesta;



	}




/*=======================================
	=            EDITAR CLIENTES            =
	=======================================*/
	
	
	public static function ctrEditarCliente(){


		if (isset($_POST['editarDireccion'])) {



			$tabla = 'ventas';

			$datos = array("cliente" => $_POST['editarCliente'],
				"numPedido" => $_POST['editarNumPedido'],
				"numObra" => $_POST['editarNumObra'],
				"email" => $_POST['editarEmail'],
				"telefono" => $_POST['editarTelefono'],
				"direccion" => $_POST['editarDireccion'],
				"fecha" => $_POST['editarFechaCliente'],
				"id" => $_POST['id']);

			$respuesta = ModeloVenta::mdlEditarCliente($tabla, $datos);

			if ($respuesta == 'ok') {
				?>

				<script>

					swal({

						type: "success",
						title: "¡El cliente se ha editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "administrar-servicios";

						}

					});


				</script> 

				<?php
			}


		}


	}




} // FIN DE LA CLASE













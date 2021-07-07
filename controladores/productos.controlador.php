<?php



class ControladorProducto{



	/*=============================================

	=            MOSTRAR PRODUCTOS           =

	=============================================*/



	 public static function ctrMostrarProducto($item, $valor){



		$tabla = 'productos';



		$respuesta = ModeloProducto::mdlMostrarProducto($tabla, $item, $valor);



		return $respuesta;





	}





	/*=============================================

	=            CREAR PRODUCTOS           =

	=============================================*/





	public static function ctrCrearProducto(){





		if (isset($_POST['nuevaDescripcion'])) {





				 /*=============================================

					 VALIDAR IMAGEN

					 =============================================*/

					 $ruta = 'vistas/img/productos/default/anonymous.png';



					 if (isset($_FILES['nuevaImagen']["tmp_name"])) {



							list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]); //saber las propiedades



							$nuevoAncho = 500;

							$nuevoAlto = 500;



							/*=============================================

							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

							=============================================*/



							$directorio = "vistas/img/productos/".$_POST['nuevoCodigo'];



							mkdir(utf8_decode($directorio), 0755);



							/*=============================================

							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

							=============================================*/



							if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/productos/".$_POST['nuevoCodigo']."/".$aleatorio.".jpg";



									$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagejpeg($destino, utf8_decode($ruta));





								}





								if($_FILES["nuevaImagen"]["type"] == "image/png"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/productos/".$_POST['nuevoCodigo']."/".$aleatorio.".png";



									$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagepng($destino, utf8_decode($ruta));





								}



							}



							$tabla = 'productos';							



							$datos = array('id_categoria' => $_POST['nuevaCategoria'],

								'codigo' => $_POST['nuevoCodigo'],

								'descripcion' => $_POST['nuevaDescripcion'],

								'stock' => $_POST['nuevoStock'],

								'precio_compra' =>  $_POST['nuevoPrecioCompra'],

								'precio_venta' => $_POST['nuevoPrecioVenta'],

								'imagen' => $ruta);



							$respuesta = ModeloProducto::mdlCrearProducto($tabla, $datos);



							if ($respuesta == 'ok') { ?>



								<script>



									swal({



										type: "success",

										title: "¡El servicio se registro correctamente!",

										showConfirmButton: true,

										confirmButtonText: "Cerrar",

										closeOnConfirm: false



									}).then((result)=>{



										if(result.value){



											window.location = "tareas";



										}



									});





								</script> 



								<?php		

							} 





						

					}







				}











	/*=============================================

	=            EDITAR PRODUCTOS           =

	=============================================*/





	public static function ctrEditarProducto(){



		if (isset($_POST['editarDescripcion'])) {



			/*if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])&&

				preg_match('/^[0-9]+$/', $_POST["editarStock"])&&

				preg_match('/^[0-9]+$/', $_POST["editarPrecioCompra"])&&

				preg_match('/^[0-9]+$/', $_POST["editarPrecioVenta"])){*/



				

			/*=============================================

			VALIDAR IMAGEN

			=============================================*/





			$ruta = $_POST["imagenActual"];





			if (isset($_FILES['editarImagen']["tmp_name"])) {



							list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]); //saber las propiedades



							$nuevoAncho = 500;

							$nuevoAlto = 500;



							/*=============================================

							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

							=============================================*/



							$directorio = "vistas/img/productos/".$_POST['editarCodigo'];



							/*=============================================

							PREGUNTAMOS SI NO ESTA VACIO EL IMPUT DE LA FOTO ACTUAL

							=============================================*/



							if (!empty($_POST["imagenActual"])) {



								unlink(utf8_decode($_POST["imagenActual"]));



							}else{



								mkdir($directorio, 0755);

							}



							



							/*=============================================

							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

							=============================================*/



							if($_FILES["editarImagen"]["type"] == "image/jpeg"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".jpg";



									$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagejpeg($destino, utf8_decode($ruta));





								}





								if($_FILES["editarImagen"]["type"] == "image/png"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".png";



									$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagepng($destino, utf8_decode($ruta));





								}



							}







			/*=============================================

			FIN DE VALIDAR IMAGEN

			=============================================*/





			$tabla = 'productos';	



			$datos = array('id_categoria' => $_POST['editarCategoria'],

				'codigo' => $_POST['editarCodigo'],

				'descripcion' => $_POST['editarDescripcion'],

				'stock' => $_POST['editarStock'],

				'precio_compra' =>  $_POST['editarPrecioCompra'],

				'precio_venta' => $_POST['editarPrecioVenta'],

				'id' => $_POST['id'],

				'imagen' => $ruta);



			$respuesta = ModeloProducto::mdlEditarProducto($tabla, $datos);



			if ($respuesta == 'ok') { ?>



				<script>



					swal({



						type: "success",

						title: "¡El producto se ha editado correctamente!",

						showConfirmButton: true,

						confirmButtonText: "Cerrar",

						closeOnConfirm: false



					}).then((result)=>{



						if(result.value){



							window.location = "tareas";



						}



					});





				</script> 



				<?php		

			} 





		/*}else{



			?>



			<script>



				swal({



					type: "error",

					title: "¡No puede ir vacío o llevar caracteres especiales!",

					showConfirmButton: true,

					confirmButtonText: "Cerrar",

					closeOnConfirm: false



				}).then((result)=>{



					if(result.value){



						window.location = "productos";



					}



				});





			</script> 



			<?php 

		}*/





	}









}













	/*=============================================

	=            BORRAR PRODUCTOS           =

	=============================================*/



	public function ctrEliminarProducto(){



		if (isset($_GET['idProducto'])) {



			$tabla = 'productos';



			$datos = $_GET['idProducto'];



			if (!empty($_GET['imagen'])) {



				unlink(utf8_decode($_GET['imagen'])); // USAR UTF8_DECODE PARA TILDES EN CARPETAS

						rmdir('vistas/img/productos/'.utf8_decode($_GET['codigoborrar'])); //USAR UTF8_DECODE PARA TILDES



					}





					$respuesta = ModeloProducto::mdlBorrarProducto($tabla, $datos);





					if ($respuesta == 'ok') { ?>



						<script>



							swal({



								type: "success",

								title: "¡El servicio ha sido borrado correctamente!",

								showConfirmButton: true,

								confirmButtonText: "Cerrar",

								closeOnConfirm: false



							}).then((result)=>{



								if(result.value){



									window.location = "tareas";



								}



							});





						</script>



						<?php 



					}



				}





			}















	/*=============================================

	=        MOSTRAR TOTAL PRODUCTOS         =

	=============================================*/ 



	public function ctrMostrarTotalProducto(){



	$tabla = 'productos';



	$respuesta = ModeloProducto::mdlMostrarTotalProducto($tabla);



	return $respuesta;



	}











} // FIN DE LA CLASE










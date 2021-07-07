<?php



class ControladorEquipo{



	/*=============================================

	=            MOSTRAR PRODUCTOS           =

	=============================================*/



	public static function ctrMostrarEquipos($item, $valor){



		$tabla = 'equipos';



		$respuesta = ModeloEquipo::mdlMostrarEquipos($tabla, $item, $valor);



		return $respuesta;





	}


	/*=============================================

	=            MOSTRAR EQUIPO POR AREA           =

	=============================================*/



	public static function ctrMostrarEquiposPorAreas($item, $valor){



		$tabla = 'equipos';



		$respuesta = ModeloEquipo::mdlMostrarEquiposAreas($tabla, $item, $valor);



		return $respuesta;





	}





	/*=============================================

	=            CREAR PRODUCTOS           =

	=============================================*/





	public static function ctrCrearEquipos(){





		if (isset($_POST['nuevaCategoriaEquipo'])) {





				 /*=============================================

					 VALIDAR IMAGEN

					 =============================================*/

					 /*$ruta = 'vistas/img/equipo/default/default.jpg';*/
					 $ruta = '';



					 if (isset($_FILES['nuevaImagen']["tmp_name"])) {



							list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]); //saber las propiedades



							$nuevoAncho = 700;

							$nuevoAlto = 700;



							/*=============================================

							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

							=============================================*/



							$directorio = "vistas/img/equipo/";



							mkdir(utf8_decode($directorio), 0755);



							/*=============================================

							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

							=============================================*/



							if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/equipo/".$aleatorio.".jpg";



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



									$ruta = "vistas/img/equipo/".$aleatorio.".png";



									$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagepng($destino, utf8_decode($ruta));





								}



							}



							$tabla = 'equipos';							



							$datos = array('id_categoria' => $_POST['nuevaCategoriaEquipo'],

								'id_area' => $_POST['nuevaAreaEquipo'],

								'id_cliente' => $_POST['nuevaUsuarioEquipo'],

								'alias' => $_POST['nuevaAliasoEquipo'],

								'serie' => $_POST['nuevaSerieEquipo'],

								'marca' =>  $_POST['nuevaMarcaEquipo'],

								'modelo' => $_POST['nuevaModeloEquipo'],

								'codbarra' => $_POST['nuevaCodBarraEquipo'],

								'detalles' => $_POST['listaCaracteristicasDetallesEquipos'],

								'estado' => $_POST['nuevaEstadoEquipo'],

								'fecha_ingreso' => $_POST['nuevaFechaEquipo'],

								'imagen' => $ruta);



							$respuesta = ModeloEquipo::mdlCrearEquipos($tabla, $datos);



							if ($respuesta == 'ok') { ?>



								<script>



									swal({



										type: "success",

										title: "¡El equipo se registro correctamente!",

										showConfirmButton: true,

										confirmButtonText: "Cerrar",

										closeOnConfirm: false



									}).then((result)=>{



										if(result.value){

											/* $('#listaCaracteristicasDetallesEquipos').val('');*/
											localStorage.removeItem("listaProductos4");
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





	public static function ctrEditarEquipos(){



		if (isset($_POST['editarCategoriaEquipo'])) {



			/*=============================================
			VALIDAR IMAGEN
			=============================================*/


			//$ruta = $_POST["imagenActual"];

			$ruta = "".$_POST["imagenActual"];


			//if (isset($_FILES['editarImagen']["tmp_name"])) {

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){



							unlink("".$_POST["imagenActual"]);	


							$nuevoAncho = 700;
							$nuevoAlto = 700;

							list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]); //saber las propiedades

							/*=============================================
							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
							=============================================*/



							//$directorio = "vistas/img/equipo/";


							/*=============================================
							PREGUNTAMOS SI NO ESTA VACIO EL IMPUT DE LA FOTO ACTUAL
							=============================================*/


						/*	if (!empty($_POST["imagenActual"])) {

								unlink(utf8_decode($_POST["imagenActual"]));

							}else{

								mkdir($directorio, 0755);

							}*/



							
							/*=============================================
							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
							=============================================*/


							if($_FILES["editarImagen"]["type"] == "image/jpeg"){

									/*=============================================
									GUARDAMOS LA IMAGEN EN EL DIRECTORIO
									=============================================*/

									$aleatorio = mt_rand(100,999);

									$ruta = "vistas/img/equipo/".$aleatorio.".jpg";


									/*$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".jpg";*/



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


									/*$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".png";*/
									$ruta = "vistas/img/equipo/".$aleatorio.".png";

									$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

									imagealphablending($destino, FALSE);

									imagesavealpha($destino, TRUE);

									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

									imagepng($destino, utf8_decode($ruta));


								}



							}







			/*=============================================
			FIN DE VALIDAR IMAGEN
			=============================================*/


			$tabla = 'equipos';		

			$datos = array('id_categoria' => $_POST['editarCategoriaEquipo'],

				'id_area' => $_POST['editarAreaEquipo'],

				'id_cliente' => $_POST['editarUsuarioEquipo'],

				'alias' => $_POST['editarAliasoEquipo'],

				'serie' => $_POST['editarSerieEquipo'],

				'marca' =>  $_POST['editarMarcaEquipo'],

				'modelo' => $_POST['editarModeloEquipo'],

				'codbarra' => $_POST['editarCodBarraEquipo'],

				'detalles' => $_POST['editarlistaCaracteristicasDetallesEquipos'],

				'estado' => $_POST['editarEstadoEquipo'],

				'fecha_ingreso' => $_POST['editarFechaEquipo'],

				'id' => $_POST['idEditar'],

				'imagen' => $ruta);



			$respuesta = ModeloEquipo::mdlEditarEquipos($tabla, $datos);

			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡El equipo se ha editado correctamente!",
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



	public function ctrEliminarEquipos(){



		if (isset($_GET['idEquipo'])) {



			$tabla = 'equipos';



			$datos = $_GET['idEquipo'];



			if (!empty($_GET['imagen'])) {



				unlink(utf8_decode($_GET['imagen'])); // USAR UTF8_DECODE PARA TILDES EN CARPETAS

						rmdir('vistas/img/equipo/'.utf8_decode($_GET['imagen'])); //USAR UTF8_DECODE PARA TILDES



					}





					$respuesta = ModeloEquipo::mdlBorrarEquipos($tabla, $datos);





					if ($respuesta == 'ok') { ?>



						<script>



							swal({



								type: "success",

								title: "¡El dispositivo ha sido borrado correctamente!",

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



	public function ctrMostrarTotalEquipos(){



		$tabla = 'equipos';



		$respuesta = ModeloEquipo::mdlMostrarTotalEquipos($tabla);



		return $respuesta;



	}











} // FIN DE LA CLASE










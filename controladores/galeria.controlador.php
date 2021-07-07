<?php 

class ControladorCategoriaGaleria{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/


		 public static function ctrMostrarCategoriaGaleria($tabla, $item, $valor){			

			$respuesta = ModeloCategoriaGaleria::mdlMostrarCategoriaGaleria($tabla, $item, $valor);

			return $respuesta;



		}



		/*==================================
		=            SUBIR FOTO            =
		==================================*/

		 public static function ctrSubirFotoGaleria(){

			if (isset($_FILES['nuevaFotoGaleria']["tmp_name"])) {

				$item = 'id';
				$valor = $_POST['idventa'];

				$ventas = ControladorVenta::ctrMostrarVenta($item, $valor);

				$ruta = '';

				if (isset($_FILES['nuevaFotoGaleria']["tmp_name"])) {			 

				 /*=============================================
					 VALIDAR IMAGEN
					 =============================================*/
					 

					 

							list($ancho, $alto) = getimagesize($_FILES["nuevaFotoGaleria"]["tmp_name"]); //saber las propiedades

							$nuevoAncho = 720;
							$nuevoAlto = 480;

							/*=============================================
							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
							=============================================*/
							

							$directorio = "vistas/img/galeria/".$ventas['id'];

							mkdir(utf8_decode($directorio), 0755);

							/*=============================================
							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
							=============================================*/

							if($_FILES["nuevaFotoGaleria"]["type"] == "image/jpeg"){

									/*=============================================
									GUARDAMOS LA IMAGEN EN EL DIRECTORIO
									=============================================*/
									$aleatorio = mt_rand(100,999);

									$ruta = "vistas/img/galeria/".$ventas['id']."/".$aleatorio.".jpg";

									$origen = imagecreatefromjpeg($_FILES["nuevaFotoGaleria"]["tmp_name"]);

									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

									imagejpeg($destino, utf8_decode($ruta));


								}


								if($_FILES["nuevaFotoGaleria"]["type"] == "image/png"){

									/*=============================================
									GUARDAMOS LA IMAGEN EN EL DIRECTORIO
									=============================================*/
									$aleatorio = mt_rand(100,999);

									$ruta = "vistas/img/galeria/".$ventas['id']."/".$aleatorio.".png";

									$origen = imagecreatefrompng($_FILES["nuevaFotoGaleria"]["tmp_name"]);

									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

									imagepng($destino, utf8_decode($ruta));

								}
							}


							$tabla = 'galeria';							

							$datos = array('idventa' => $_POST['idventa'],
							                'titulo' => $_POST['nombreFoto'],
							            	'imagen' => $ruta);

							$respuesta = ModeloCategoriaGaleria::mdlsubirGaleria($tabla, $datos);

							if ($respuesta == 'ok') { ?>

								<script>
									
									var id = '<?=$ventas['id']?>';

									swal({

										type: "success",
										title: "¡La foto se subió correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){

											window.location = 'index.php?ruta=galeria-reporte&idVenta='+id;

										}

									});


								</script> 

								<?php		
							} 

						}

					}


					/*=====  End of SUBIR FOTO  ======*/ 

					
					 public static function ctrEliminarGaleria(){	

						if(isset($_GET['idGaleria'])) {

							$tabla = 'galeria';

							$datos = $_GET['idGaleria'];

							$idven = $_GET['idven'];

							if(!empty($_GET['rutaGaleria'])) {

						unlink(utf8_decode($_GET['rutaGaleria'])); // USAR UTF8_DECODE PARA TILDES EN CARPETAS
						//rmdir('vistas/img/usuarios/'.utf8_decode($_GET['nombreborrar'])); //USAR UTF8_DECODE PARA TILDES
					}

					$respuesta = ModeloCategoriaGaleria::mdlEliminarGaleria($tabla, $datos);


					if ($respuesta == 'ok') { ?>

						<script>

							var id = '<?=$idven?>';

							swal({

								type: "success",
								title: "¡La imagen ha sido borrado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){

									window.location = 'index.php?ruta=galeria-reporte&idVenta='+id;

								}

							});


						</script>

						<?php 

					}

				}

			}
			


				/*===========================================
				=            GALERIA CONFORMIDAD            =
				===========================================*/
				
				 public static function ctrSubirFotoGaleriaConformidad(){

			if (isset($_FILES['nuevaFotoGaleriaConformidad']["tmp_name"])) {

				$item = 'id';
				$valor = $_POST['idventaC'];

				$ventas = ControladorVenta::ctrMostrarVenta($item, $valor);

				$ruta = '';

				if (isset($_FILES['nuevaFotoGaleriaConformidad']["tmp_name"])) {			 

				 /*=============================================
					 VALIDAR IMAGEN
					 =============================================*/


					 

							list($ancho, $alto) = getimagesize($_FILES["nuevaFotoGaleriaConformidad"]["tmp_name"]); //saber las propiedades

							$nuevoAncho = 1300;
							$nuevoAlto = 1500;

							/*=============================================
							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
							=============================================*/
							

							$directorio = "vistas/img/galeria/".$ventas['id'];

							//mkdir(utf8_decode($directorio), 0755);

							/*=============================================
							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
							=============================================*/

							if($_FILES["nuevaFotoGaleriaConformidad"]["type"] == "image/jpeg"){

									/*=============================================
									GUARDAMOS LA IMAGEN EN EL DIRECTORIO
									=============================================*/
									$aleatorio = mt_rand(100,999);

									$ruta = "vistas/img/galeria/".$ventas['id']."/".$aleatorio.".jpg";

									$origen = imagecreatefromjpeg($_FILES["nuevaFotoGaleriaConformidad"]["tmp_name"]);

									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

									imagejpeg($destino, utf8_decode($ruta));


								}


								if($_FILES["nuevaFotoGaleriaConformidad"]["type"] == "image/png"){

									/*=============================================
									GUARDAMOS LA IMAGEN EN EL DIRECTORIO
									=============================================*/
									$aleatorio = mt_rand(100,999);

									$ruta = "vistas/img/galeria/".$ventas['id']."/".$aleatorio.".png";

									$origen = imagecreatefrompng($_FILES["nuevaFotoGaleriaConformidad"]["tmp_name"]);

									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

									imagepng($destino, utf8_decode($ruta));

								}
							}


							$tabla = 'galeria_conformidad';							

							$datos = array('idventa' => $_POST['idventaC'],
											'imagen' => $ruta);

							$respuesta = ModeloCategoriaGaleria::mdlsubirGaleriaConformidad($tabla, $datos);

							if ($respuesta == 'ok') { ?>

								<script>

									var id = '<?=$ventas['id']?>';

									swal({

										type: "success",
										title: "¡La foto se subió correctamente!",
										showConfirmButton: true,
										confirmButtonText: "Cerrar",
										closeOnConfirm: false

									}).then((result)=>{

										if(result.value){

											window.location = 'index.php?ruta=galeria-reporte&idVenta='+id;

										}

									});


								</script> 

								<?php		
							} 

						}

					}
				
				/*=====  End of GALERIA CONFORMIDAD  ======*/



				/*============================================
				=            ELIMINAR CONFORMIDAD            =
				============================================*/
				
				 public static function ctrEliminarGaleriaConformidad(){	

				if(isset($_GET['idGaleriaC'])) {

					$tabla = 'galeria_conformidad';

					$datos = $_GET['idGaleriaC'];

					$idven = $_GET['idvenC'];

					if(!empty($_GET['rutaGaleriaC'])) {

						unlink(utf8_decode($_GET['rutaGaleriaC'])); // USAR UTF8_DECODE PARA TILDES EN CARPETAS
						//rmdir('vistas/img/usuarios/'.utf8_decode($_GET['nombreborrar'])); //USAR UTF8_DECODE PARA TILDES
					}

					$respuesta = ModeloCategoriaGaleria::mdlEliminarGaleriaConformidad($tabla, $datos);


					if ($respuesta == 'ok') { ?>

						<script>

							var id = '<?=$idven?>';

							swal({

								type: "success",
								title: "¡La imagen de conformidad ha sido borrado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

							}).then((result)=>{

								if(result.value){

									window.location = 'index.php?ruta=galeria-reporte&idVenta='+id;

								}

							});


						</script>

						<?php 

					}

				}

			}

				
				/*=====  End of ELIMINAR CONFORMIDAD  ======*/
				
				


	} //FIN DE LA CLASE



	?>
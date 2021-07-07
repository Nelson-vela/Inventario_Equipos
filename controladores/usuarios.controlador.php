<?php

class ControladorUsuarios{



	/*=============================================

	INGRESO DE USUARIO

	=============================================*/



	public static function ctrIngresoUsuario(){



		if(isset($_POST["ingUsuario"])){



			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&

				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){



				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	



			$tabla = "usuarios";



			$item = "usuario";

			$valor = $_POST["ingUsuario"];



			$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);



			if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){



				if ($respuesta["estado"] == 1) {			



							//session_start();



					$_SESSION["iniciarSesion"] = "ok";

					$_SESSION["id"] = $respuesta["id"];

					$_SESSION["nombre"] = $respuesta["nombre"];

					$_SESSION["usuario"] = $respuesta["usuario"];

					$_SESSION["foto"] = $respuesta["foto"];

					$_SESSION["perfil"] = $respuesta["perfil"];



					date_default_timezone_set('America/Lima');



					$fecha = date('Y-m-d');

					$hora = date('H:i:s');



					$fechaActual = $fecha.' '.$hora;



					$item = 'ultimo_login';

					$valor = $fechaActual;



					$item2 = 'id';

					$valor2 = $respuesta['id'];



					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuarios($tabla, $item, $valor, $item2, $valor2);



					if ($ultimoLogin == 'ok') {



						echo '<script>



						window.location.href = "inicio";



						</script>';

					}



					





				}else{



					echo '<br><div class="alert alert-danger">Usuario desactivado<div>';

				}



			}else{



				echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';



			}



		}	



	}



}







	/*=============================================

		MOSTRAR DE USUARIO

		=============================================*/



		public static function ctrMostrarUsuarios($item, $valor){



			$tabla = 'usuarios';



			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);



			return $respuesta;



		}























	/*=============================================

	REGISTRO DE USUARIO

	=============================================*/



	

	public static function ctrCrearUsuario(){



		if(isset($_POST["nuevoUsuario"])){



			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&

				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPerfil"]) &&

				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&

				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){



				    /*=============================================

					 VALIDAR IMAGEN

					 =============================================*/



					 $ruta = "";



					 if (isset($_FILES['nuevaFoto']["tmp_name"])) {



							list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]); //saber las propiedades



							$nuevoAncho = 500;

							$nuevoAlto = 500;



							/*=============================================

							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

							=============================================*/



							$directorio = "vistas/img/usuarios/".$_POST["nuevoNombre"];



							mkdir(utf8_decode($directorio), 0755);



							/*=============================================

							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

							=============================================*/



							if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/usuarios/".$_POST["nuevoNombre"]."/".$aleatorio.".jpg";



									$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagejpeg($destino, utf8_decode($ruta));





								}





								if($_FILES["nuevaFoto"]["type"] == "image/png"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/usuarios/".$_POST["nuevoNombre"]."/".$aleatorio.".png";



									$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagepng($destino, utf8_decode($ruta));





								}





							}



							$tabla = 'usuarios';



							$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



							$datos = array('nombre' => $_POST['nuevoNombre'], 

								'usuario' => $_POST['nuevoUsuario'],

								'password' => $encriptar,

								'perfil' => $_POST['nuevoPerfil'],

								'ruta' => $ruta);



							$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);



							if ($respuesta == 'ok') { ?>



								<script>



									swal({



										type: "success",

										title: "¡El se registro correctamente!",

										showConfirmButton: true,

										confirmButtonText: "Cerrar",

										closeOnConfirm: false



									}).then((result)=>{



										if(result.value){



											window.location = "usuarios";



										}



									});





								</script>



								<?php 



							}



						}else{ ?>



							<script>



								swal({



									type: "error",

									title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",

									showConfirmButton: true,

									confirmButtonText: "Cerrar",

									closeOnConfirm: false



								}).then((result)=>{



									if(result.value){



										window.location = "usuarios";



									}



								});





							</script> 



							<?php 



						}



					}



				}

















				/*=============================================

					EDITAR USUARIO

					=============================================*/



					public static function ctrEditarUsuario(){



						if (isset($_POST['editarUsuario'])) {



							if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&	

								preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUsuario"])){







			/*=============================================

			VALIDAR IMAGEN

			=============================================*/





			$ruta = $_POST["fotoActual"];



			

			if (isset($_FILES['editarFoto']["tmp_name"]) && !empty($_FILES['editarFoto']["tmp_name"])) {



							list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]); //saber las propiedades



							$nuevoAncho = 500;

							$nuevoAlto = 500;



							/*=============================================

							CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO

							=============================================*/



							$directorio = "vistas/img/usuarios/".$_POST["editarNombre"];



							/*=============================================

							PREGUNTAMOS SI NO ESTA VACIO EL IMPUT DE LA FOTO ACTUAL

							=============================================*/



							if (!empty($_POST["fotoActual"])) {



								unlink(utf8_decode($_POST["fotoActual"]));



							}else{



								mkdir(utf8_decode($directorio), 0755);

							}

							



							/*=============================================

							DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP

							=============================================*/



							if($_FILES["editarFoto"]["type"] == "image/jpeg"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/usuarios/".$_POST["editarNombre"]."/".$aleatorio.".jpg";



									$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagejpeg($destino, utf8_decode($ruta));





								}





								if($_FILES["editarFoto"]["type"] == "image/png"){



									/*=============================================

									GUARDAMOS LA IMAGEN EN EL DIRECTORIO

									=============================================*/

									$aleatorio = mt_rand(100,999);



									$ruta = "vistas/img/usuarios/".$_POST["editarNombre"]."/".$aleatorio.".png";



									$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);



									$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);



									imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);



									imagepng($destino, utf8_decode($ruta));





								}





							}







			/*=============================================

			FIN DE VALIDAR IMAGEN

			=============================================*/







			$tabla = 'usuarios';





			if(!empty($_POST["editarPassword"])){



				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){



					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



				}else{  ?>



					<script>



						swal({

							type: "error",

							title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",

							showConfirmButton: true,

							confirmButtonText: "Cerrar",

							closeOnConfirm: false

						}).then((result) => {

							if (result.value) {



								window.location = "usuarios";



							}

						})



					</script>



					<?php 

				}



			}else{



				//$encriptar = $passwordActual;

				$encriptar = $_POST['passwordActual'];



			}



			//$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



			echo $item = $_POST['id'];





			$datos = array('usuario' => $_POST['editarUsuario'],				

				'password' => $encriptar,

				'perfil' => $_POST['editarPerfil'],

				'foto' => $ruta);



			$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos, $item);



			if($respuesta == "ok"){ ?>



				<script>



					swal({

						type: "success",

						title: "El usuario ha sido editado correctamente",

						showConfirmButton: true,

						confirmButtonText: "Cerrar",

						closeOnConfirm: false

					}).then((result) => {

						if (result.value) {



							window.location = "usuarios";



						}

					})



				</script>



				<?php

			}



		}else{  ?>



			<script>



				swal({

					type: "error",

					title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",

					showConfirmButton: true,

					confirmButtonText: "Cerrar",

					closeOnConfirm: false

				}).then((result) => {

					if (result.value) {



						window.location = "usuarios";



					}

				})



			</script>



			<?php 



		}







	}



}





/*=============================================

=           BORRAR USUARIOS	        =

=============================================*/





public static function ctrBorrarUsuario(){



	if(isset($_GET['idUsuario'])) {

		

		$tabla = 'usuarios';



		$datos = $_GET['idUsuario'];



		if(!empty($_GET['fotoUsuario'])) {

			

						unlink(utf8_decode($_GET['fotoUsuario'])); // USAR UTF8_DECODE PARA TILDES EN CARPETAS

						rmdir('vistas/img/usuarios/'.utf8_decode($_GET['nombreborrar'])); //USAR UTF8_DECODE PARA TILDES

					}



					$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);





					if ($respuesta == 'ok') { ?>



						<script>



							swal({



								type: "success",

								title: "¡El usuario ha sido borrado correctamente!",

								showConfirmButton: true,

								confirmButtonText: "Cerrar",

								closeOnConfirm: false



							}).then((result)=>{



								if(result.value){



									window.location = "usuarios";



								}



							});





						</script>



						<?php 



					}



				}





			}









			/*=============================================

			=        MOSTRAR TOTAL CLIENTES         =

			=============================================*/ 



			public static function ctrMostrarTotalUsuario(){



				$tabla = 'usuarios';



				$respuesta = ModeloUsuarios::mdlMostrarTotalUsuario($tabla);



				return $respuesta;



			}



			/*=============================================

			=       VALIDAR ROL        =

			=============================================*/ 



			public static function ctrRolVendedor($rol){


				if ($rol == "Vendedor") {
					
					echo '<script>

					window.location = "crear-servicio";

					</script>';
				}


			}





		}
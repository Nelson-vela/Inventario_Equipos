<?php 



class ControladorCargo{

/*=============================================
=            MOSTRAR CLIENTE        =
=============================================*/


public static function ctrMostrarCargos($item, $valor){

	$tabla = 'cargos';

	$respuesta = ModeloCargo::mdlMostrarCargos($tabla, $item, $valor);

	return $respuesta;


}


/*=============================================
=            REGISTRAR CLIENTE        =
=============================================*/

public static function ctrRegistrarCargo(){


	if (isset($_POST['nuevoCargoUsuario'])) {

		$tabla = 'cargos';


		$obtenerCodigo = ModeloCargo::mdlObtenerUltimoId($tabla);

		if ($_POST['nuevoCodigoCargo'] == '1') {

			$codigo = '1';


		}else{			

			date_default_timezone_set('America/Lima');

			$año = date('Y');		

			foreach ($obtenerCodigo as $key => $cod) { }

				//$codigo = "".$año.$cod[0]."";
				$codigo = "".$cod[0]."";

		}



		

		$datos = array("id_usuario" => $_POST['nuevoCargoUsuario'],
						"id_usuarioEntrega" => $_POST['nuevoCargoUsuarioEntrega'],
						"id_equipo" => $_POST['nuevoCargoEquipo'],
						"fechaEntrega" => $_POST['nuevoFechaEquipo'],
						"horaEntrega" => $_POST['nuevoHoraEntrega'],
						"serie" => $año,
						"codigo" => $codigo);

		$respuesta = ModeloCargo::mdlRegistrarCargo($tabla, $datos);

		if ($respuesta == 'ok') {
			?>

			<script>

				swal({

					type: "success",
					title: "¡El cargo se registro correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "administrar-cargos";

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


	public static function ctrEliminarCargo(){


		if (isset($_GET['idCargo'])) {
			

			$tabla = 'cargos';	

			$valor = $_GET['idCargo'];

			$respuesta = ModeloCargo::mdlEliminarCargo($tabla, $valor);

			if ($respuesta == 'ok') { ?>

				<script>

					swal({

						type: "success",
						title: "¡El cargo ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "administrar-cargos";

						}

					});


				</script>

				<?php 

			}



		}





	}





/*=============================================
=            REGISTRAR CLIENTE        =
=============================================*/

public static function ctrEditarCargo(){


	if (isset($_POST['editarCargoEquipo'])) {

		$tabla = 'cargos';


		/*$obtenerCodigo = ModeloCargo::mdlObtenerUltimoId($tabla);

		if ($_POST['nuevoCodigoCargo'] == '001') {

			$codigo = '001';


		}else{					

			foreach ($obtenerCodigo as $key => $cod) { }

				$codigo = '00'.$cod[0];

		}
*/


		

		$datos = array("id_usuario" => $_POST['editarCargoUsuario'],
			"id_usuarioEntrega" => $_POST['editarCargoUsuarioEntrega'],
			"id_equipo" => $_POST['editarCargoEquipo'],
			"fechaEntrega" => $_POST['editarFechaEquipoCargo'],
			"horaEntrega" => $_POST['editarhoraEntregaCargo'],
			"id" =>$_POST['idCargoE']);

		$respuesta = ModeloCargo::mdlEditarCargo($tabla, $datos);

		if ($respuesta == 'ok') {
			?>

			<script>

				swal({

					type: "success",
					title: "¡El cargo se registro correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "administrar-cargos";

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



	static	public function ctrMostrarTotalCargo(){



		$tabla = 'cargos';



		$respuesta = ModeloCargo::mdlMostrarTotalCargos($tabla);



		return $respuesta;



	}


/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasCargos($fechaInicial, $fechaFinal){

		$tabla = "cargos";

		$respuesta = ModeloCargo::mdlRangoFechasCargos($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}



} // FIN DE LA CLASE

<?php


class ControladorMantenimiento{

/*=============================================
=            MOSTRAR MANTENIMIENTO        =
=============================================*/


static public function ctrMostrarMantenimientos($item, $valor){

	$tabla = 'mantenimiento';

	$respuesta = ModeloMantenimiento::mdlMostrarMantenimientos($tabla, $item, $valor);

	return $respuesta;


}




/*=============================================
=           AGREGAR MANTENIMIENTO          =
=============================================*/


 static public function ctrAgregarMantenimientos(){

	if (isset($_POST['nuevaResponsbleMantenimiento'])) {

		$requerimiento = null;
		$observacione = null;



		if ($_POST['nuevaListaRequerimientosMantenimiento'] == "") {
			
			$requerimiento = "[]";

		}else{

		$requerimiento = $_POST['nuevaListaRequerimientosMantenimiento'];

		}




		if ($_POST['nuevaListaObservacionesMantenimiento'] == "") {
			
			$observacione = "[]";


		}else{

				$observacione =	$_POST['nuevaListaObservacionesMantenimiento'];

		}


		$datos = array('responsable' => $_POST['nuevaResponsbleMantenimiento'],

			'id_equipo' => $_POST['nuevaEquipoMantenimiento'],

			/*'observaciones' => $_POST['nuevaListaObservacionesMantenimiento'],*/
			'observaciones' => $observacione,

			/*'requerimientos' => $_POST['nuevaListaRequerimientosMantenimiento'],*/

			'requerimientos' => $requerimiento,

			'total_presupuesto' => $_POST['totalRequerimiento'],

			'fecha_mantenimiento' =>  $_POST['nuevaFechaMantenimiento'], 

			'estado' => 1);




		$tabla = 'mantenimiento';
		$tablaEquipo = 'equipos';

		$respuesta = ModeloMantenimiento::mdlAgregarMantenimientos($tabla, $datos);	 

		$item = 'ultimo_mantenimiento';
		$valor = $_POST['nuevaFechaMantenimiento'];

		$valor2 = $_POST['nuevaEquipoMantenimiento'];

		$actualizarFechaEquipo = ModeloEquipo::mdlActualizarEquipos($tablaEquipo, $item, $valor, $valor2);

		if ($respuesta == 'ok') { ?>


			<script>

				swal({

					type: "success",
					title: "¡El mantenimiento se registro correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){
						/* $('#listaCaracteristicasDetallesEquipos').val('');*/
						localStorage.removeItem("listaRequerimientosM");  
						localStorage.removeItem("listaObservacionesM"); 
						window.location = "mantenimiento";

					}

				});

			</script> 

			<?php		

		} 


	}


}



/*================================================
=            ACTUALIZAR MANTENIMIENTO            =
================================================*/


 /*=====================================
	=            ACTUALIZAR  DOCUMENTO         =
	=====================================*/
	
	static public function ctrActualizarMantenimiento(){


		if (isset($_POST['editarResponsableMantenimiento'])) {


			$tabla = 'mantenimiento';


			$datos = array('responsable' => $_POST['editarResponsableMantenimiento'],

							'id_equipo' => $_POST['editarEquipoMantenimiento'],

							'observaciones' => $_POST['editarListaObservacionesMantenimiento'],

							'requerimientos' => $_POST['editarListaRequerimientosMantenimiento'],

							'total_presupuesto' => $_POST['editarTotalRequerimiento'],

							'id' => $_POST['id'],

							'fecha_mantenimiento' =>  $_POST['editarFechaMantenimiento']);


			/*$respuesta = ModeloCompras::mdlAgregarCompras($tabla, $datos);*/
			$respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $datos);


			$tabla = 'mantenimiento';
			$tablaEquipo = 'equipos';
			$item = 'ultimo_mantenimiento';
			$valor = $_POST['editarFechaMantenimiento'];

			$valor2 = $_POST['editarEquipoMantenimiento'];

			$actualizarFechaEquipo = ModeloEquipo::mdlActualizarEquipos($tablaEquipo, $item, $valor, $valor2);

			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "El mantenimiento se actualizó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							localStorage.removeItem("listaRequerimientosM");  
							localStorage.removeItem("listaObservacionesM"); 
							window.location = "mantenimiento";

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
	
	static public function ctrActualizarConclusion(){


		if (isset($_POST['nuevaConclusion'])) {


			$tabla = 'mantenimiento';

			$item = 'conclusion';
			$valor = $_POST['nuevaConclusion'];

			$item2 = 'id';
			$valor2 = $_POST['idMante'];
 

			/*$respuesta = ModeloCompras::mdlAgregarCompras($tabla, $datos);*/
			$respuesta = ModeloMantenimiento::mdlActualizarConclusion($tabla, $item, $valor, $item2, $valor2);


		 

			if ($respuesta == 'ok') { ?>


				<script>

					swal({

						type: "success",
						title: "El mantenimiento se actualizó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

						 
							window.location = "mantenimiento";

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

  static public function ctrEliminarMantenimiento(){


	if (isset($_GET['idMantenimiento'])) {


		$tabla = 'mantenimiento';		 
		$valor = $_GET['idMantenimiento'];

		$respuesta = ModeloMantenimiento::mdlEliminarMantenimiento($tabla, $valor);


		if ($respuesta == 'ok') { ?>

			<script>

				swal({

					type: "success",
					title: "El mantenimiento ha sido borrado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "mantenimiento";

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



	static public function ctrMostrarTotalGastoMantenimiento(){



		$tabla = 'mantenimiento';



		$respuesta = ModeloMantenimiento::mdlMostrarTotalGastoMantenimiento($tabla);



		return $respuesta;



	}




	static public function ctrMostrarTotalMantenimiento(){



		$tabla = 'mantenimiento';



		$respuesta = ModeloMantenimiento::mdlMostrarTotalMantenimiento($tabla);



		return $respuesta;



	}


	/*=============================================

	=        MOSTRAR TOTAL PRODUCTOS         =

	=============================================*/ 



	static public function ctrMostrarTotalPendienteReparado($valor){



		$tabla = 'mantenimiento';



		$respuesta = ModeloMantenimiento::mdlMostrarTotalPendienteReparado($tabla, $valor);



		return $respuesta;



	}





} //FIIN DE LA CLASE
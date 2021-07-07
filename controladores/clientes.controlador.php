<?php


class ControladorCliente{

/*=============================================
=            MOSTRAR CLIENTE        =
=============================================*/


public static function ctrMostrarCliente($item, $valor){

	$tabla = 'clientes';

	$respuesta = ModeloCliente::mdlMostrarCliente($tabla, $item, $valor);

	return $respuesta;


}


/*=============================================
=            REGISTRAR CLIENTE        =
=============================================*/

public static function ctrRegistrarCliente(){


	if (isset($_POST['nuevoCliente'])) {



		$tabla = 'clientes';

		$datos = array("cliente" => $_POST['nuevoCliente'],
			"id_area" => $_POST['nuevoAreaCliente'],
			"documentoID" => $_POST['nuevoDocumentoID'],
			"email" => $_POST['nuevoEmail'],
			"telefono" => $_POST['nuevoTelefono'],
			"direccion" => $_POST['nuevaDireccion']);

		$respuesta = ModeloCliente::mdlRegistrarCliente($tabla, $datos);

		if ($respuesta == 'ok') {
			?>

			<script>

				swal({

					type: "success",
					title: "¡El usuario se registro correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "clientes";

					}

				});


			</script> 

			<?php
		}


	}


}



/*=============================================
=            EDITAR CLIENTE        =
=============================================*/



public static function ctrEditarCliente(){


	if (isset($_POST['editarCliente'])) {
		


		$tabla = 'clientes';
 

		$datos = array("cliente" => $_POST['editarCliente'],
						"documentoID" => $_POST['editarDocumentoID'],
						"id_area" => $_POST['editarAreaCliente'],
						"email" => $_POST['editarEmail'],
						"telefono" => $_POST['editarTelefono'],			
						"direccion" => $_POST['editarDirecciónCliente'],			
						"id" => $_POST['id']);



		$respuesta = ModeloCliente::mdlEditarCliente($tabla, $datos);
 

		if ($respuesta == 'ok') {
			?>

			<script>

				swal({

					type: "success",
					title: "¡El usuario se ha editado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "clientes";

					}

				});


			</script> 

			<?php
		}







	}



}



/*=============================================
=           ELIMINAR CLIENTE           =
=============================================*/


public static function ctrEliminarCliente(){

	if (isset($_GET['idCliente'])) {
		
		$tabla = 'clientes';

		$datos = $_GET['idCliente'];

		$respuesta = ModeloCliente::mdlEliminarCliente($tabla, $datos);

		if ($respuesta == 'ok') {  

			?>

			<script>

				swal({

					type: "success",
					title: "¡El usuario se eliminó correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false

				}).then((result)=>{

					if(result.value){

						window.location = "clientes";

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

	public static function ctrMostrarTotalCliente(){

		$tabla = 'clientes';

		$respuesta = ModeloCliente::mdlMostrarTotalCliente($tabla);

		return $respuesta;

	}














} // FIN DE LA CLASE


?>
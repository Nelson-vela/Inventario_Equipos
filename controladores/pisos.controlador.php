<?php 


class ControladorPiso{


	/*======================================
	=            MOSTRAR PISOS            =
	======================================*/
	 public static function ctrMostrarPisos($item, $valor){

		$tabla = 'pisos';		

		$respuesta = ModeloPiso::mdlMostrarPisos($tabla, $item, $valor);

		return $respuesta;



	}


	 /*=======================================
 	=            INGRESAR GASTOS            =
 	=======================================*/
 	
 	
 	public static function ctrIngresarPisos(){

 		if (isset($_POST['nuevoPiso'])) {




 			$tabla = 'pisos';

 			$datos = array("cliente" => $_POST["seleccionarCliente"],
 				"piso" => $_POST["nuevoPiso"],
 				"direccion" => $_POST["nuevoPisoDireccion"]);

 			$respuesta = ModeloPiso::mdlIngresarPisos($tabla, $datos);

 			if ($respuesta == 'ok') { ?>


 				<script>

 					swal({

 						type: "success",
 						title: "¡El piso se agrego correctamente!",
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
	






}



 ?>
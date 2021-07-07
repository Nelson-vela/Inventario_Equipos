<?php 

require_once '../controladores/plantilla.controlador.php';
require_once '../modelos/plantilla.modelo.php';


class AjaxListarGastosFijos{


	public function mostrarTabla(){

		
		$gastos = ControladorPlantilla::ctrOperacion();

		$tabla = '';

		//$estado = '';

		foreach ($gastos as $key => $value) {

			/*if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}*/


			$editar = '<button class=\"btn btn-warning editarGastosFijos\" idGastosFijos=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarGastosFijos\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger eliminarGastosFijos\" idGastosFijos=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';


			/*if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}*/
			$fechaBD = new DateTime($value['fecha']);
            $fecha =  $fechaBD->format('d-m-Y');

			$tabla.='{
				"id":"'.($key+1).'",			
				"descripcion":"'.$value['descripcion'].'",
				"gastos":"'.$value['monto'].'", 
				"fecha":"'.$fecha.'",
				"acciones":"'.$editar.$eliminar.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

$activar = new AjaxListarGastosFijos();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
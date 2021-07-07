<?php 

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';

require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';


class AjaxListarClientesT{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$clientes = ControladorCliente::ctrMostrarCliente($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($clientes as $key => $value) {



			$item2 = 'id';
			$valor2 = $value['id_area'];

			$area = ControladorArea::ctrMostrarAreas($item2, $valor2);

			/*if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}*/


			$editar = '<button class=\"btn btn-warning btn-xs editarClientes\" idCliente=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarCliente\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs eliminarClientes\" idCliente=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';

			$reporte = '<a class=\"btn btn-success btn-xs\" href=\"index.php?ruta=reporteUsuario&idUsuarios='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';


			/*if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}*/
			$fechaBD = new DateTime($value['fecha']);
            $fecha =  $fechaBD->format('d-m-Y');

			$tabla.='{
				"id":"'.($key+1).'",			
				"nombre":"'.$value['nombre'].'",
				"area":"'.$area['area'].'",
				"dni":"'.$value['documentoID'].'", 
				"telefono":"'.$value['telefono'].'", 
				"email":"'.$value['email'].'", 
				"telefono":"'.$value['telefono'].'",				
				"direccion":"'.$value['direccion'].'",				
				"acciones":"'.$editar.$eliminar.$reporte.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

$activar = new AjaxListarClientesT();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
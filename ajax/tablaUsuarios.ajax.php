<?php 

require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';


class AjaxListarUsuarios{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$clientes = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($clientes as $key => $value) {

			if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}


			$editar = '<button class=\"btn btn-warning btn-xs editarUsuario\" idUsuario=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarUsuarios\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs eliminarUsuario\" idUsuario=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';


			if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}
				

			$tabla.='{
				"id":"'.($key+1).'",			
				"nombre":"'.$value['nombre'].'",
				"usuario":"'.$value['usuario'].'",			 
				"foto":"'.$foto.'",
				"perfil":"'.$value['perfil'].'",
				"estado":"'.$estado.'",	
				"fecha":"'.$value['ultimo_login'].'",
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

$activar = new AjaxListarUsuarios();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
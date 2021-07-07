<?php 

require_once '../controladores/proveedores.controlador.php';
require_once '../modelos/proveedores.modelo.php';

 





class AjaxListarProveedor{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$proveedores = ControladorProveedor::ctrMostrarProveedores($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($proveedores as $key => $value) {

			/*$itemE = 'id';
			$valorE = $value['id_equipo'];


			$equipo = ControladorEquipo::ctrMostrarEquipos($itemE, $valorE);
*/

			/*$areaEquipo = $equipo['id_area'];

			$cat = $equipo['id_categoria'];



			$area = ControladorArea::ctrMostrarAreas($itemE, $areaEquipo);

			$categoria = ControladorCategoria::ctrMostrarCategoria($itemE, $cat);*/

			/*if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}*/
 

			$editar = '<button class=\"btn btn-warning btn-xs btnEditarProveedor\" idProveedor=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarProveedor2\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs btnEliminarProveedor\" idProveedor=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';
 


			$reporte = '<a class=\"btn btn-success btn-xs\" href=\"index.php?ruta=reporteProveedor&idProveedor='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';
  


			/*if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}*/
			$fechaA = new DateTime($value['fecha_ingreso']);
            $fecha_ingreso =  $fechaA->format('d-m-Y');




 



			$tabla.='{
				"id":"'.($key+1).'",			
				"proveedor":"'.$value['proveedor'].'",
				"ruc":"'.$value['ruc'].'",
				"direccion":"'.$value['direccion'].'", 		 
				"email":"'.$value['email'].'", 		 
				"telefono":"'.$value['telefono'].'", 		 
				"fecha_ingreso":"'.$fecha_ingreso.'",
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

$activar = new AjaxListarProveedor();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
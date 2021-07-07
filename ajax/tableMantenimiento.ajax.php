<?php 

require_once '../controladores/equipos.controlador.php';
require_once '../modelos/equipos.modelo.php';


require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';

require_once '../controladores/mantenimiento.controlador.php';
require_once '../modelos/mantenimiento.modelo.php';

require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';






class AjaxListarMantenimiento{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$mantenimiento = ControladorMantenimiento::ctrMostrarMantenimientos($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($mantenimiento as $key => $value) {

			$itemE = 'id';
			$valorE = $value['id_equipo'];


			$equipo = ControladorEquipo::ctrMostrarEquipos($itemE, $valorE);


			$areaEquipo = $equipo['id_area'];

			$cat = $equipo['id_categoria'];



			$area = ControladorArea::ctrMostrarAreas($itemE, $areaEquipo);

			$categoria = ControladorCategoria::ctrMostrarCategoria($itemE, $cat);

			/*if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}*/
 

			$editar = '<button class=\"btn btn-warning btn-xs btnEditarMantenimiento\" idMantenimiento=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarMantenimiento\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs btnEliminarMantenimiento\" idMantenimiento=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';




			$obervaciones = '<center><button class=\"btn bg-maroon btn-flat verObservacionesMantenimientos\" idMantenimiento=\"'.$value['id'].'\"   data-toggle=\"modal\" data-target=\"#modalVerObservaciones\"><i class=\"fa fa-eye\"></i></button></center>';


			$requerimientos = '<center><button class=\"btn  bg-navy btn-flat verRequerimientosMantenimientos\" idMantenimiento=\"'.$value['id'].'\"   data-toggle=\"modal\" data-target=\"#modalVerRequerimientos\"><i class=\"fa fa-eye\"></i></button></center>';


			$reporte = '<a class=\"btn btn-success btn-xs\" href=\"index.php?ruta=reporteMantenimiento&idMantenimiento='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';


			$conclusion = '<center><button class=\"btn bg-purple btn-flat verConclusion\" idMantenimiento=\"'.$value['id'].'\"   data-toggle=\"modal\" data-target=\"#modalVerConclusion\"><i class=\"fa fa-eye\"></i></button></center>';



			/*if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}*/

			if($value['estado'] == 1){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoMantenimiento\" idEquipo=\"'.$value['id_equipo'].'\" idMantenimiento=\"'.$value['id'].'\"  estadoMantenimiento=\"2\">Excelente</button>';

			}

			if($value['estado'] == 2){

				$estado = '<button class=\"btn btn-info btn-xs btnEstadoMantenimiento\" idEquipo=\"'.$value['id_equipo'].'\" idMantenimiento=\"'.$value['id'].'\"  estadoMantenimiento=\"3\">En mantenimiento</button>';


			}

			if($value['estado'] == 3){

				$estado = '<button class=\"btn btn-warning btn-xs btnEstadoMantenimiento\" idEquipo=\"'.$value['id_equipo'].'\" idMantenimiento=\"'.$value['id'].'\"  estadoMantenimiento=\"4\">Necesita cambios</button>';


			}


			if($value['estado'] == 4){

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoMantenimiento\" idEquipo=\"'.$value['id_equipo'].'\" idMantenimiento=\"'.$value['id'].'\"  estadoMantenimiento=\"1\">Dar de baja</button>';


			}








			$fechaA = new DateTime($value['fecha_mantenimiento']);
            $fecha_mantenimiento =  $fechaA->format('d-m-Y');
 



			$tabla.='{
				"id":"'.($key+1).'",			
				"categoria":"'.$categoria['categoria'].'",
				"area":"'.$area['area'].'",
				"equipo":"'.$equipo['alias'].'", 
				"responsable":"'.$value['responsable'].'", 
				"observaciones":"'.$obervaciones.'", 
				"requerimientos":"'.$requerimientos.'", 
				"total":"S/ '.number_format($value['total_presupuesto'],2).'", 
				"conclusion":"'.$conclusion.'",
				"fecha_mantenimiento":"'.$fecha_mantenimiento.'",
				"estado":"'.$estado.'",
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

$activar = new AjaxListarMantenimiento();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
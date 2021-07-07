<?php 

require_once '../controladores/equipos.controlador.php';
require_once '../modelos/equipos.modelo.php';

require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';

require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';

class AjaxListarSer{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$equipos = ControladorEquipo::ctrMostrarEquipos($item, $valor);
		

		$tabla = '';

		//$estado = '';

		foreach ($equipos as $key => $value) {	

		    $item2 = 'id';

			$valor2 = $value['id_categoria'];
			$valor3 = $value['id_cliente'];
			$valor4 = $value['id_area'];
		 
		    $categoria = ControladorCategoria::ctrMostrarCategoria($item2, $valor2);

		    $usuarios = ControladorCliente::ctrMostrarCliente($item2, $valor3);	

		    $areas = ControladorArea::ctrMostrarAreas($item2, $valor4);	 


			$editar = '<button class=\"btn btn-warning btn-xs editarEquipo\" style=\"1px\" idEquipo=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarEquipo\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger  btn-xs eliminarEquipo\"  imagen=\"'.$value['imagen'].'\"  idEquipo=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';

			$reporte = '<a class=\"btn btn-info btn-xs\" href=\"index.php?ruta=reporteEquipo&idEquipo='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';


			if($value['estado'] == 1){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoEquipo\" idEquipo=\"'.$value['id'].'\"  estadoEquipo=\"0\">Excelente</button>';

			}

			if($value['estado'] == 2){

				$estado = '<button class=\"btn btn-info btn-xs btnEstadoEquipo\" idEquipo=\"'.$value['id'].'\"  estadoEquipo=\"1\">En mantenimiento</button>';


			}

			if($value['estado'] == 3){

				$estado = '<button class=\"btn btn-warning btn-xs btnEstadoEquipo\" idEquipo=\"'.$value['id'].'\"  estadoEquipo=\"1\">Necesita cambios</button>';


			}


			if($value['estado'] == 4){

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoEquipo\" idEquipo=\"'.$value['id'].'\"  estadoEquipo=\"1\">Dar de baja</button>';


			}


			if($value['imagen'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"70px\" src=\"'.$value['imagen'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"70px\" src=\"vistas/img/equipo/default/default.jpg\">';
			
			}
					

			 
			$detalles = '<button class=\"btn bg-purple btn-flat verDetallesEquipos\" idEquipoDetalle=\"'.$value['id'].'\"   data-toggle=\"modal\" data-target=\"#modalVerDetalles\"><i class=\"fa fa-eye\"></i></button>';


			$fechaA = new DateTime($value['ultimo_mantenimiento']);

			$fechaI = new DateTime($value['fecha_ingreso']);



			$fecha_mantenimientos =  $fechaA->format('d-m-Y');

			$fecha_ingreso =  $fechaI->format('d-m-Y');

			if ($fecha_mantenimientos == "30-11--0001") {

				$fecha_mantenimiento = 'Aún no tiene mantenimiento';
				
			}else{

				$fecha_mantenimiento = $fecha_mantenimientos;
				  
			}

          


			$tabla.='{
				"id":"'.($key+1).'",
				"categoria":"'.$categoria['categoria'].'", 	
				"area":"'.$areas['area'].'",
				"alias":"'.$value['alias'].'", 	
				"usuario":"'.$usuarios['nombre'].'", 				
				"marca":"'.$value['marca'].'",				 
				"modelo":"'.$value['modelo'].'",				 
				"codbarra":"'.$value['codbarra'].'",				 
				"detalles":"'.$detalles.'",
				"estado":"'.$estado.'",				
				"imagen":"'.$foto.'",	
				"fecha_ingreso":"'.$fecha_ingreso.'",				
				"ultimo_mantenimiento":"'.$fecha_mantenimiento.'",				
				"acciones":"'.$editar.$eliminar.$reporte.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE



$activar = new AjaxListarSer();
$activar -> mostrarTabla();


?>
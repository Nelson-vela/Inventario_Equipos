<?php 

require_once '../controladores/equipos.controlador.php';
require_once '../modelos/equipos.modelo.php';

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';

require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';

require_once '../controladores/cargos.controlador.php';
require_once '../modelos/cargos.modelo.php';

class AjaxListarCargos{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$cargos = ControladorCargo::ctrMostrarCargos($item, $valor);
		

		$tabla = '';

		//$estado = '';

		foreach ($cargos as $key => $value) {	

		    $item2 = 'id';

			$valor2 = $value['id_equipo'];
			$valor3 = $value['id_cliente'];
			$valor5 = $value['id_clienteEntrega'];
		 
		 
		    $equipos = ControladorEquipo::ctrMostrarEquipos($item2, $valor2);

		    $usuarios = ControladorCliente::ctrMostrarCliente($item2, $valor3);	

		    $usuarioEntrega = ControladorCliente::ctrMostrarCliente($item2, $valor5);	


		    $valor4 = $usuarios['id_area'];

		    $areas = ControladorArea::ctrMostrarAreas($item2, $valor4);	 


			$editar = '<button class=\"btn btn-warning btn-xs editarCargo\" idCargo=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarCargo\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger  btn-xs eliminarCargo\"  idCargo=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';

			$reporte = '<a class=\"btn btn-info btn-xs\" href=\"index.php?ruta=reporteCargo&idCargo='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';			 
 
  
			 
 			 


			$fechaE = new DateTime($value['fechaEntrega']);

		 



			$fecha_entrega =  $fechaE->format('d-m-Y');

			 

			if ($fecha_entrega == "30-11--0001") {

				$fecha_Entreg = 'Aún no tiene fecha entrega';
				
			}else{

				$fecha_Entreg = $fecha_entrega;
				  
			}

          


			$tabla.='{
				"id":"'.($key+1).'",
				"codigo":"'.$value['serie']."-".$value['codigo'].'", 	
				"usuarioe":"'.$usuarioEntrega['nombre'].'",
				"usuarior":"'.$usuarios['nombre'].'",
				"area":"'.$areas['area'].'",  		 
				"equipo":"'.$equipos['alias'].'",
				"fechaEntrega":"'.$fecha_Entreg.'",				
				"acciones":"'.$editar.$eliminar.$reporte.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE



$activar = new AjaxListarCargos();
$activar -> mostrarTabla();


?>
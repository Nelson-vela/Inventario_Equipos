<?php 

require_once '../controladores/areas.controlador.php';
require_once '../modelos/areas.modelo.php';

 





class AjaxListarAreas{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$areas = ControladorArea::ctrMostrarAreas($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($areas as $key => $value) {

			 
 

			$editar = '<button class=\"btn btn-warning btn-xs btnEditarArea\" idArea=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarAreas\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs btnEliminarArea\" idArea=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';
 


			$reporte = '<a class=\"btn btn-success btn-xs\" href=\"index.php?ruta=reporteProveedor&idProveedor='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';
  
 
			/*$fechaA = new DateTime($value['fecha_ingreso']);
            $fecha_ingreso =  $fechaA->format('d-m-Y');*/




 



			$tabla.='{
				"id":"'.($key+1).'",			
				"area":"'.$value['area'].'",
				"fecha":"'.$value['fecha'].'",				 
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

$activar = new AjaxListarAreas();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
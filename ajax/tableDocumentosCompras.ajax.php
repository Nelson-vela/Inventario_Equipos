<?php 

require_once '../controladores/tipodocumento.controlador.php';
require_once '../modelos/tipodocumento.modelo.php';


require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

require_once '../controladores/proveedores.controlador.php';
require_once '../modelos/proveedores.modelo.php';






class AjaxListarTipoDocumento{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$documentoDetalle = ControladorTipoDocumento::ctrMostrarTipoDocumentoDetalle($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($documentoDetalle as $key => $value) {

			$itemD = 'id';
			$valorD = $value['id_tipo_documento'];

			$valorU = $value['id_usuario'];

			$valorP = $value['id_proveedor'];


			$tipoDocumento = ControladorTipoDocumento::ctrMostrarTipoDocumento($itemD, $valorD);

			$usuario = ControladorUsuarios::ctrMostrarUsuarios($itemD, $valorU);

			$proveedor = ControladorProveedor::ctrMostrarProveedores($itemD, $valorP);

			/*if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"0\">Activado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoUsuario\" idUsuario=\"'.$value['id'].'\"  estadoUsuario=\"1\">Desactivado</button>';
			}*/


			$agregar = '<button class=\"btn btn-primary btn-xs ingresarCompras\" idTipoDocumentoDetalle=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalAgregarGastos\"><i class=\"fa fa-check\"></i></button>';	

			$editar = '<button class=\"btn btn-warning btn-xs editarTipoDocumentoDetalle\" idTipoDocumentoDetalle=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarDocumento\"><i class=\"fa fa-pencil\"></i></button>';	

			$eliminar = '<button class=\"btn btn-danger btn-xs eliminarTipoDocumentoDetalle\" idTipoDocumentoDetalle=\"'.$value['id'].'\"><i class=\"fa fa-times\"></i></button>';

			/*$reporte = '<a class=\"btn btn-info btn-xs\" href=\"index.php?ruta=reporteComprasv&idCompras='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';	*/	

 			$reporte = '<a class=\"btn btn-info btn-xs escogReport\" data-toggle=\"modal\" idCompras=\"'.$value['id'].'\" data-target=\"#modalEscogerFormato\"><i class=\"fa fa-download\"></i></a>';			 
 








			/*if($value['foto'] != ""){


			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"'.$value['foto'].'\">';

			}else{

			$foto = '<img class=\"img-thumbnail\" width=\"40px\" src=\"vistas/img/usuarios/default/anonymous.png\">';
			
			}*/
			$fechaA = new DateTime($value['fecha_almacenamiento']);
            $fecha_almacenamiento =  $fechaA->format('d-m-Y');

            $fechaE = new DateTime($value['fecha_emision']);
            $fecha_emision =  $fechaE->format('d-m-Y');



			$tabla.='{
				"id":"'.($key+1).'",			
				"proveedor":"'.$proveedor ['proveedor'].'",
				"tipo":"'.$tipoDocumento['tipo'].'",
				"numero":"'.$value['serie'].'-'.$value['ntipo'].'", 
				"fecha_emision":"'.$fecha_emision.'", 
				"fecha_almacenamiento":"'.$fecha_almacenamiento.'",	
				"total":"S/ '.number_format($value['total'],2).'", 		 
				"usuario_ingresado":"'.$usuario['nombre'].'", 
				"acciones":"'.$agregar.$editar.$eliminar.$reporte.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

$activar = new AjaxListarTipoDocumento();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
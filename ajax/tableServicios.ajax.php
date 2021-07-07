<?php 

require_once '../controladores/ventas.controlador.php';
require_once '../modelos/ventas.modelo.php';

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';


class AjaxListarVenta{


	public function mostrarTabla(){


		$item = null;
		$valor = null;

		$venta = ControladorVenta::ctrMostrarVenta($item, $valor);

		$tabla = '';

		//$estado = '';

		foreach ($venta as $key => $value) {

			$item2 = 'id';
			$valor2 = $value['id_cliente'];
			$cliente = ControladorCliente::ctrMostrarCliente($item2, $valor2);




			if($value['estado'] != 0){		

				$estado = '<button class=\"btn btn-success btn-xs btnEstadoVenta\" idVenta=\"'.$value['id'].'\"  estadoVenta=\"0\">Cancelado</button>';

			}else{

				$estado = '<button class=\"btn btn-danger btn-xs btnEstadoVenta\" idVenta=\"'.$value['id'].'\"  estadoVenta=\"1\">Pendiente</button>';


			}


			if($value['estadoFactura'] != 0){		

				$estadoFactura = '<button class=\"btn btn-success btn-xs btnActivarFactura\" idVenta=\"'.$value['id'].'\"  estadoFactura=\"0\">Entregado</button>';

			}else{

				$estadoFactura = '<button class=\"btn btn-danger btn-xs btnActivarFactura\" idVenta=\"'.$value['id'].'\"  estadoFactura=\"1\">No Entregado</button>';
				

			}
			
			if($value['enviado'] != 0){		

				$estadoEnviado = '<button class=\"btn btn-success btn-xs btnActivarEnviado\" idVenta=\"'.$value['id'].'\"  estadoEnviado=\"0\">Enviado</button>';

			}else{

				$estadoEnviado = '<button class=\"btn btn-danger btn-xs btnActivarEnviado\" idVenta=\"'.$value['id'].'\"  estadoEnviado=\"1\">No Enviado</button>';
				

			}


			$editar = '<a class=\"btn btn-warning editarCategoria1\" href=\"index.php?ruta=editar-venta&idVenta='.$value['id'].'\"\"><i class=\"fa fa-pencil\"></i></a>';

			$correo = '<a class=\"btn btn-success\" href=\"index.php?ruta=correo&idClie='.$value['id'].'\"\"><i class=\"fa fa-mail-forward\"></i></a>';

			$reporte = '<a class=\"btn btn-info\" href=\"index.php?ruta=reporte&idClie='.$value['id'].'\"\"><i class=\"fa fa-download\"></i></a>';

			$foto = '<a class=\"btn btn-primary\" href=\"index.php?ruta=galeria-reporte&idVenta='.$value['id'].'\"\"><i class=\"fa fa-file-image-o\"></i></a>';

			$editarCliente = '<button class=\"btn btn-default editarClienteSer\" idVenta=\"'.$value['id'].'\" data-toggle=\"modal\" data-target=\"#modalEditarCliente\"><i class=\"fa fa-users\"></i></button>';

			$eliminar = '<button class=\"btn btn-danger eliminarVenta1\" idVenta=\"'.$value['id'].'\"\"><i class=\"fa fa-times\"></i></button>';

			

			

			$tabla.='{
				"id":"'.($key+1).'",			
				"codigo":"'.$value['codigo'].'",
				"cliente":"'.$cliente['nombre'].'",				
				"direccion":"'.$value['direccion'].'",					
				"neto":"€.'.number_format($value['neto'],2).'",					
				"total":"€.'.number_format($value['total'],2).'",
				"fecha":"'.$value['fechaModi'].'",	
				"estadoFactura":"'.$estadoFactura.'",
				"enviado":"'.$estadoEnviado.'",
				"estado":"'.$estado.'",		
				"acciones":"'.$editar.$eliminar.$correo.$editarCliente.$foto.$reporte.'"


			},';
		}


		//ELIMINAMOS LA COMA QUE SOBRA
		
		$tabla = substr($tabla,0, strlen($tabla)-1);

		echo '{"data":['.$tabla.']}';	

	}

} //FINAL DE LA CALSE

session_start();

if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

$activar = new AjaxListarVenta();
$activar -> mostrarTabla();

}else{

	echo '<script>

	window.location = "../";

	</script>';

	
}
?>
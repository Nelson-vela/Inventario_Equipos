<?php 


require_once '../controladores/ventas.controlador.php';
require_once '../modelos/ventas.modelo.php';

require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';



class TablaVenta{


	public function mostrarTablaVentas(){
	
	    $item = null;
		$valor = null;
		
		$ventas = ControladorVenta::ctrMostrarVenta($item, $valor);


		echo'{
			"data": [';


			for($i = 0; $i < count($ventas)-1; $i++){

				$valor = $ventas[$i]['id_cliente'];
				$item = 'id';

				$usuarios = ControladorCliente::ctrMostrarCliente($item, $valor);

				echo'[
				"'.($i+1).'",
				"'.$ventas[$i]['codigo'].'",				
				"'.$usuarios['nombre'].'",	
				"'.$ventas[$i]['numPedido'].'",					
				"'.$ventas[$i]['numObra'].'",	
				"'.$ventas[$i]['metodo_pago'].'",	
				"€ '.number_format($ventas[$i]['neto'],2).'",	
				"€ '.number_format($ventas[$i]['total'],2).'",	
				"'.$ventas[$i]['estado'].'",			     
				"'.$ventas[$i]['id'].'"	,	      
				"'.$ventas[$i]['id_cliente'].'"		      
			],';

		}

		echo'[
		"'.count($ventas).'",		
		"'.$ventas[count($ventas)-1]['codigo'].'",		
		"'.$usuarios['nombre'].'",
		"'.$ventas[count($ventas)-1]['numPedido'].'",
		"'.$ventas[count($ventas)-1]['numObra'].'",
		"'.$ventas[count($ventas)-1]['metodo_pago'].'",
		"€ '.number_format($ventas[count($ventas)-1]['neto'],2).'",
		"€ '.number_format($ventas[count($ventas)-1]['total'],2).'",
		"'.$ventas[count($ventas)-1]['estado'].'",
		"'.$ventas[count($ventas)-1]['id'].'",
		"'.$ventas[count($ventas)-1]['id_cliente'].'"
		]
		]
	}';

} //FIN DEL MÉTODO




} //FIN DE LA CLASE


$activar = new TablaVenta();
$activar->mostrarTablaVentas();






?>
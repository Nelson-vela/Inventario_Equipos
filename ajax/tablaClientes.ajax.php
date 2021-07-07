<?php 


require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';



class TablaCliente{


	public function mostrarTablaClientes(){
	
	    $item = null;
		$valor = null;
		
		$cliente = ControladorCliente::ctrMostrarCliente($item, $valor);


		echo'{
			"data": [';


			for($i = 0; $i < count($cliente)-1; $i++){

				echo'[
				"'.($i+1).'",
				"'.$cliente[$i]['nombre'].'",
				"'.$cliente[$i]['documentoID'].'",	
				"'.$cliente[$i]['email'].'",	
				"'.$cliente[$i]['telefono'].'",					
				"'.$cliente[$i]['direccion'].'",	
				"'.$cliente[$i]['compras'].'",	
				"'.$cliente[$i]['ultima_compra'].'",	
				"'.$cliente[$i]['fecha'].'",	      
				"'.$cliente[$i]['id'].'"		      
			],';

		}

		echo'[
		"'.count($cliente).'",		
		"'.$cliente[count($cliente)-1]['nombre'].'",
		"'.$cliente[count($cliente)-1]['documentoID'].'",
		"'.$cliente[count($cliente)-1]['email'].'",
		"'.$cliente[count($cliente)-1]['telefono'].'",
		"'.$cliente[count($cliente)-1]['direccion'].'",
		"'.$cliente[count($cliente)-1]['compras'].'",
		"'.$cliente[count($cliente)-1]['ultima_compra'].'",
		"'.$cliente[count($cliente)-1]['fecha'].'",
		"'.$cliente[count($cliente)-1]['id'].'"
		]
		]
	}';

} //FIN DEL MÉTODO




} //FIN DE LA CLASE


$activar = new TablaCliente();
$activar->mostrarTablaClientes();






?>
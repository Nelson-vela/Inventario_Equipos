<?php 


require_once '../controladores/categorias.controlador.php';
require_once '../modelos/categorias.modelo.php';



class TablaCategoria{


	public function mostrarTablaCategorias(){
	
	    $item = null;
		$valor = null;
		
		$categoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);


		echo'{
			"data": [';


			for($i = 0; $i < count($categoria)-1; $i++){

				echo'[
				"'.($i+1).'",
				"'.$categoria[$i]['categoria'].'",	
				"'.$categoria[$i]['id'].'"		      
			],';

		}

		echo'[
		"'.count($categoria).'",		
		"'.$categoria[count($categoria)-1]['categoria'].'",		 
		"'.$categoria[count($categoria)-1]['id'].'"
		]
		]
	}';

} //FIN DEL MÉTODO




} //FIN DE LA CLASE


$activar = new TablaCategoria();
$activar->mostrarTablaCategorias();






?>
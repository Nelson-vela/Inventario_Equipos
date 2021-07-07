<?php 



require_once "conexion.php";





class ModeloVenta{







		/*=============================================

		=            MOSTRAR VENTA           =

		=============================================*/



		 public static function mdlMostrarVenta($tabla, $item, $valor){



			if ($item != null) {



				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id desc");



				$stmt->bindParam(":$item", $valor, PDO::PARAM_STR);



				$stmt->execute();



				return $stmt -> fetch();



			}else{



				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");



				$stmt->execute();



				return $stmt -> fetchAll();

			}





			$stmt -> close();



			$stmt = null;



		}









		/*=============================================

		=            MOSTRAR VENTA           =

		=============================================*/







		 public static function mdlCrearVenta($tabla, $datos){





			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_vendedor, id_cliente, /*numPedido, numObra,*/ direccion, telefono, email, productos, productosExtras, impuesto, neto, total, metodo_pago, fechaModi) VALUES(:codigo, :id_vendedor, /*:numPedido, :numObra,*/ :id_cliente, :direccion, :telefono, :email, :productos, :productosExtras, :impuesto, :neto, :total, :metodo_pago, :fechaModi)");



			$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);

			$stmt->bindParam(":id_vendedor", $datos['id_vendedor'], PDO::PARAM_INT);

			/*$stmt->bindParam(":numPedido", $datos['numPedido'], PDO::PARAM_STR);

			$stmt->bindParam(":numObra", $datos['numObra'], PDO::PARAM_STR);*/

			$stmt->bindParam(":id_cliente", $datos['cliente'], PDO::PARAM_INT);

			$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);

			$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);

			$stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);

			$stmt->bindParam(":productos", $datos['productos'], PDO::PARAM_STR);

			$stmt->bindParam(":productosExtras", $datos['productosExtras'], PDO::PARAM_STR);

			$stmt->bindParam(":impuesto", $datos['impuesto'], PDO::PARAM_STR);

			$stmt->bindParam(":neto", $datos['neto'], PDO::PARAM_STR);

			$stmt->bindParam(":total", $datos['total'], PDO::PARAM_STR);
			
			$stmt->bindParam(":fechaModi", $datos['fechaModi'], PDO::PARAM_STR);

			$stmt->bindParam(":metodo_pago", $datos['metodoPago'], PDO::PARAM_STR);



			if ($stmt -> execute()) {



				return 'ok';



			}else{



				return 'error';

			}



			$stmt -> close();



			$stmt = null;





		}

















		/*=============================================

		=            MOSTRAR VENTA           =

		=============================================*/









		 public static function mdlEditarVenta($tabla, $datos){





			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_vendedor = :id_vendedor, productos = :productos, productosExtras = :productosExtras, impuesto = :impuesto, neto = :neto, total = :total WHERE codigo = :codigo");



			$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);			

			$stmt->bindParam(":id_vendedor", $datos['id_vendedor'], PDO::PARAM_STR);		    

			$stmt->bindParam(":productos", $datos['productos'], PDO::PARAM_STR);

			$stmt->bindParam(":productosExtras", $datos['productosExtras'], PDO::PARAM_STR);

			$stmt->bindParam(":impuesto", $datos['impuesto'], PDO::PARAM_STR);

			$stmt->bindParam(":neto", $datos['neto'], PDO::PARAM_STR);

			$stmt->bindParam(":total", $datos['total'], PDO::PARAM_STR);

			



			if ($stmt -> execute()) {



				return 'ok';



			}else{



				return 'error';

			}



			$stmt -> close();



			$stmt = null;





		}







		/*=============================================

		=     ELIMINAR VENTA         =

		=============================================*/







		 public static function mdlEliminarVenta($tabla, $valor){



			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id ");



			$stmt->bindParam(":id", $valor, PDO::PARAM_INT);



			if ($stmt -> execute()) {



				return 'ok';



			}else{



				return 'error';

			}



			$stmt -> close();



			$stmt = null;





		}	





/*=============================================

	ACTUALIZAR USUARIOS

	=============================================*/



	public static function mdlActualizarVenta($tabla, $item, $valor, $item2, $valor2){





		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item  = :$item WHERE $item2 = :$item2");



		$stmt->bindParam(":$item", $valor, PDO::PARAM_STR);

		$stmt->bindParam(":$item2", $valor2, PDO::PARAM_STR);





		if($stmt->execute()){



			return "ok";	



		}else{



			return "error";



		}



		$stmt->close();

		

		$stmt = null;





	}

	

	/*=============================================

	=      MOSTRAR TOTAL LAS COMRAS REALIZADAS           =

	=============================================*/

 

  public static function mdlMostrarTotalVenta($tabla){



 	$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE estado = 1");



 	$stmt->execute();



 	return $stmt->fetch();



 	$stmt-close();



 	$stmt = null;





 }





	/*=============================================

	=      MOSTRAR TOTAL LOS SERVICIOS PENDIENTES           =

	=============================================*/

 

  public static function mdlMostrarTotalVentaPendiente($tabla){



 	$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE estado = 0");



 	$stmt->execute();



 	return $stmt->fetch();



 	$stmt-close();



 	$stmt = null;




 }


/*=============================================
		=            OBTENER ULTIMO ID VENTA           =
		=============================================*/

		public static function mdlObtenerUltimoId($tabla){


			$stmt = Conexion::conectar()->prepare("SELECT MAX(codigo)+1 FROM $tabla");					

				$stmt->execute();

				return $stmt -> fetchAll();

				$stmt -> close();

			   $stmt = null;
		}



/*=============================================
	=            EDITAR CLIENTE        =
	=============================================*/


	 public static function mdlEditarCliente($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numPedido = :numPedido, numObra = :numObra, cliente = :cliente, direccion = :direccion, telefono = :telefono, email = :email, fecha = :fecha , fechaModi = :fechaModi WHERE id = :id");

		
		$stmt->bindParam(":numPedido", $datos['numPedido'], PDO::PARAM_STR);
		$stmt->bindParam(":numObra", $datos['numObra'], PDO::PARAM_STR);
		$stmt->bindParam(":cliente", $datos['cliente'],PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);	
		$stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);			
		$stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);			
		$stmt->bindParam(":fechaModi", $datos['fecha'], PDO::PARAM_STR);	
		$stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);

		if ($stmt->execute()){

			return 'ok';


		}else{
			return 'falso';
		}


		$stmt -> close();

		$stmt = null;



	}





} //FIN DE LA CLASE








?>
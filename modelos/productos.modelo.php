<?php 

require_once "conexion.php";

class ModeloProducto{


		/*=============================================
	=            MOSTRAR PRODUCTOS           =
	=============================================*/

	 public static function mdlMostrarProducto($tabla, $item, $valor){
		

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		
		$stmt -> close();

		$stmt = null;



	}



	/*=============================================
	=            CREAR PRODUCTOS           =
	=============================================*/

	 public static function mdlCrearProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta)VALUES(:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");

		$stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos['stock'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos['precio_compra'], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos['precio_venta'], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';

		}else{
			
			return 'error';
		}

		$stmt -> close();

		$stmt = null;


	}




	 public static function mdlEditarProducto($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, codigo = :codigo, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE id = :id ");


		$stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
		$stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos['stock'], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos['precio_compra'], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos['precio_venta'], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';

		}else{
			
			return 'error';
		}

		$stmt -> close();

		$stmt = null;


	}





		 public static function mdlBorrarProducto($tabla, $datos){


			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id ");
			$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

			if ($stmt->execute()) {
				
				return 'ok';

			}else{

				return 'false';
			}

			$stmt->close();
		
		$stmt = null;



		}


/*=============================================
=           ACTUALIZAR PRODUCTO          =
=============================================*/


	public static function mdlActualizarProducto($tabla, $item, $valor, $valor2){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item  = :$item WHERE id = :id");

		$stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;


	}


	/*=============================================
	=      MOSTRAR TOTAL PRODUCTO         =
	=============================================*/


 public static function mdlMostrarTotalProducto($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

	$stmt->execute();

	return $stmt->fetchAll();

	$stmt->close();

	$stmt = null;


}




} //FIN DE LA CLASE






?>
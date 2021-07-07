<?php 

require_once "conexion.php";

class ModeloCategoria{


/*=============================================
	=            INGRESAR CATEGORIA          =
	=============================================*/

	public static function mdlIngresarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES(:categoria)");

		$stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}



/*=============================================
	=            MOSTRAR CATEGORIA          =
	=============================================*/

	public static function mdlMostrarCategoria($tabla, $item, $valor){


		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		
		$stmt -> close();

		$stmt = null;

	}





/*=============================================
	=            EDITAR CATEGORIA          =
	=============================================*/


	public static function mdlEditarCategoria($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :$item");

		$stmt -> bindParam(":categoria", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":$item", $item, PDO::PARAM_INT);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;



	}




/*=============================================
	=            ELIMINAR CATEGORIA          =
	=============================================*/


	public static function mdlEliminarCategoria($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}





		
	}




/*=============================================
=      MOSTRAR TOTAL CATEGOIRA       =
=============================================*/


public static function mdlMostrarTotalCategoria($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

	$stmt->execute();

	return $stmt->fetchAll();

	$stmt->close();

	$stmt = null;


}





} // FIN DE LA CLASE



?>
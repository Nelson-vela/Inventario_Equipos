<?php 

require_once "conexion.php";

class ModeloPiso{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		public static function mdlMostrarPisos($tabla, $item, $valor){


			if ($item != null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}


			$stmt -> close();

			$stmt = null;

		}


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		public static function mdlMostrarPisosUnitario($tabla, $item, $valor){			

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

			$stmt = null;

		}


		
		

/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	public static function mdlIngresarPisos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idcliente, piso, direccion) VALUES(:cliente, :piso, :direccion)");

		$stmt->bindParam(":cliente", $datos['cliente'], PDO::PARAM_STR);
		$stmt->bindParam(":piso", $datos['piso'], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}


/*=============================================
	=            EDITAR GASTOS          =
	=============================================*/


	public static function mdlEditarGastos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, gastos = :gastos, fecha = :fecha WHERE id = :id");

		$stmt -> bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt -> bindParam(":gastos", $datos['gastos'], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos['id'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;



	}

/*=============================================
	=            ELIMINAR GASTOS          =
	=============================================*/


	public static function mdlEliminarGastos($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}





		
	}





/*=============================================
=            EDITAR PISO        =
=============================================*/


public static function mdlEditarPiso($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET piso = :piso, direccion = :direccion WHERE id = :id");

	$stmt->bindParam(":piso", $datos['piso'],PDO::PARAM_STR); 
	$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
	$stmt->bindParam(":id", $datos['idPiso'], PDO::PARAM_INT);

	if ($stmt->execute()){

		return 'ok';


	}else{
		return 'falso';
	}


	$stmt -> close();

	$stmt = null;



}


}
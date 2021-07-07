<?php 

require_once "conexion.php";

class ModeloPlantilla{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		 public static function mdlMostrarPrestamos($tabla, $item, $valor){


			if ($item != null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}


			$stmt -> close();

			$stmt = null;

		}




		/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	 public static function mdlIngresarGastosFijos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, monto, fecha) VALUES(:descripcion, :gastos, :fecha)");

		$stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":gastos", $datos['gastos'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);


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


	 public static function mdlEditarGastosFijos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, monto = :gastos, fecha = :fecha WHERE id = :id");

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


	 public static function mdlEliminarGastosFijos($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}





		
	}




/*=============================================

	=      MOSTRAR TOTAL LAS COMRAS REALIZADAS           =

	=============================================*/



	 public static function mdlMostrarTotalGastosFijos($tabla){



		$stmt = Conexion::conectar()->prepare("SELECT SUM(monto) as total FROM $tabla");



		$stmt->execute();



		return $stmt->fetch();



		$stmt-close();



		$stmt = null;





	}


}
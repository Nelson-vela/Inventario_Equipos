<?php 

require_once "conexion.php";

class ModeloPresupuesto{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		 public static function mdlMostrarGastos($tabla, $item, $valor){


			if ($item != null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}


			$stmt -> close();

			$stmt = null;

		}



		/*=============================================

	=      MOSTRAR TOTAL LAS COMRAS REALIZADAS           =

	=============================================*/



	 public static function mdlMostrarTotalGasto($tabla){



		$stmt = Conexion::conectar()->prepare("SELECT SUM(gastos) as total FROM $tabla");



		$stmt->execute();



		return $stmt->fetch();



		$stmt-close();



		$stmt = null;





	}



		/*=============================================

	=      MOSTRAR TOTAL LAS COMRAS REALIZADAS           =

	=============================================*/



	 public static function mdlMostrarTotalPorMes($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE estado = 1 AND fechaModi between :fechaInicio AND :fechaFin");

		$stmt -> bindParam(":fechaInicio", $datos['fechaInicio'], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $datos['fechaFin'], PDO::PARAM_STR);

		$stmt->execute();



		return $stmt->fetch();



		$stmt-close();



		$stmt = null;

	}




		/*=============================================

	=      MOSTRAR TOTAL LAS COMRAS REALIZADAS           =

	=============================================*/



	 public static function mdlMostrarTotalPresupuestoPorMes($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("SELECT SUM(gastos) as total FROM $tabla WHERE fecha between :fechaInicio AND :fechaFin");

		$stmt -> bindParam(":fechaInicio", $datos['fechaInicio'], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $datos['fechaFin'], PDO::PARAM_STR);

		$stmt->execute();



		return $stmt->fetch();



		$stmt-close();



		$stmt = null;

	}



/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	 public static function mdlIngresarGastos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, cantidad, gastos, gastoTotal, fecha, responsable) VALUES(:descripcion, :cantidad, :gastos, :gastoTotal, :fecha, :responsable)");

		$stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_INT);
		$stmt->bindParam(":gastos", $datos['gastos'], PDO::PARAM_STR);
		$stmt->bindParam(":gastoTotal", $datos['gastoTotal'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $datos['responsable'], PDO::PARAM_STR);


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

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, cantidad = :cantidad, gastos = :gastos, gastoTotal = :gastoTotal, fecha = :fecha, responsable = :responsable WHERE id = :id");

		$stmt -> bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_INT);
		$stmt -> bindParam(":gastos", $datos['gastos'], PDO::PARAM_STR);
		$stmt -> bindParam(":gastoTotal", $datos['gastoTotal'], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
		$stmt -> bindParam(":responsable", $datos['responsable'], PDO::PARAM_STR);
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


}
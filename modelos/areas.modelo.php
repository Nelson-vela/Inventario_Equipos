<?php 

require_once "conexion.php";

class ModeloArea{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		public static function mdlMostrarAreas($tabla, $item, $valor){


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
		=      MOSTRAR TOTAL USUARIOS         =
		=============================================*/


		static public function mdlMostrarTotalAreas($tabla){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();

			$stmt = null;


		}
		
		/*===================================
		=            CREAR AREAS            =
		===================================*/
		
		static public function mdlCrearAreas($tabla, $datos){


			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(area, fecha) VALUES (:area, :fecha)");


			$stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR); 	
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

			if($stmt->execute()){

				return "ok";	

			}else{

				return "error";

			}

			$stmt->close();

			$stmt = null;



		}








			/*=============================================
	editar areas
	=============================================*/

	static public function mdlEditarAreas($tabla, $datos){



		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET area = :area WHERE id = :id");	

		$stmt->bindParam(":area", $datos["area"], PDO::PARAM_STR);	
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;

	}



 	/*=============================================
	=            ELIMINAR DOCUMENTO DE COMMPAS          =
	=============================================*/


	public static function mdlEliminarAreas($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}

		

		
	}



	}// FIN DE CLASE
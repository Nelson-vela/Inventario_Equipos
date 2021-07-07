<?php 

require_once "conexion.php";

class ModeloMantenimiento{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		static public  function mdlMostrarMantenimientos($tabla, $item, $valor){


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
	=           AGREGAR MANTENIMIENTO           =
	=============================================*/

	static public function mdlAgregarMantenimientos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_equipo, responsable, observaciones, requerimientos, total_presupuesto, fecha_mantenimiento, estado)VALUES(:id_equipo, :responsable, :observaciones, :requerimientos, :total_presupuesto, :fecha_mantenimiento, :estado)");

		$stmt->bindParam(":id_equipo", $datos['id_equipo'], PDO::PARAM_INT);		 
		$stmt->bindParam(":responsable", $datos['responsable'], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
		$stmt->bindParam(":requerimientos", $datos['requerimientos'], PDO::PARAM_STR);
		$stmt->bindParam(":total_presupuesto", $datos['total_presupuesto'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mantenimiento", $datos['fecha_mantenimiento'], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_INT);

		/*		$stmt->bindParam(":ultimo_mantenimiento", $datos['ultimo_mantenimiento'], PDO::PARAM_STR);*/

		if ($stmt->execute()) {

			return 'ok';

		}else{
			
			return 'error';
		}

		$stmt -> close();

		$stmt = null;


	}




	/*=============================================
	=            ELIMINAR DOCUMENTO DE COMMPAS          =
	=============================================*/

	 static public function mdlEliminarMantenimiento($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}



		
	}




	/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	static public function mdlActualizarMantenimiento($tabla, $datos){	 


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_equipo = :id_equipo, responsable = :responsable, observaciones = :observaciones, requerimientos = :requerimientos, total_presupuesto = :total_presupuesto, fecha_mantenimiento = :fecha_mantenimiento WHERE id = :id");

		$stmt->bindParam(":id_equipo", $datos['id_equipo'], PDO::PARAM_INT);		
		$stmt->bindParam(":responsable", $datos['responsable'], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
		$stmt->bindParam(":requerimientos", $datos['requerimientos'], PDO::PARAM_STR);
		$stmt->bindParam(":total_presupuesto", $datos['total_presupuesto'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_mantenimiento", $datos['fecha_mantenimiento'], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}




/*=============================================
	ACTUALIZAR DOCUEMTNOS
	=============================================*/

	static public  function mdlActualizarConclusion($tabla, $item, $valor, $item2, $valor2){


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

	=      MOSTRAR TOTAL LOS SERVICIOS PENDIENTES           =

	=============================================*/



	static public  function mdlMostrarTotalGastoMantenimiento($tabla){ 

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total_presupuesto) as total FROM $tabla WHERE estado_mantenimiento = 0"); 

		$stmt->execute(); 

		return $stmt->fetch(); 

		$stmt-close(); 

		$stmt = null;




	}



	static public  function mdlMostrarTotalPendienteReparado($tabla, $valor){ 

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE estado_mantenimiento = :valor ORDER BY id DESC"); 

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute(); 

		return $stmt->fetchAll(); 

		$stmt-close(); 

		$stmt = null;




	}


	 static public  function mdlMostrarTotalMantenimiento($tabla){ 

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt->execute(); 

		return $stmt->fetchAll(); 

		$stmt-close(); 

		$stmt = null;




	}




	}// FIN DE CLASE
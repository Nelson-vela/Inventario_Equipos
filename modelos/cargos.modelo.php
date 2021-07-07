<?php 

require_once "conexion.php";


class ModeloCargo{



	static public function mdlMostrarCargos($tabla, $item, $valor){


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
	=            REGISTRAR CLIENTE        =
	=============================================*/





	public static function mdlRegistrarCargo($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_equipo, id_cliente, id_clienteEntrega, serie, codigo, fechaEntrega, horaEntrega)VALUES(:id_equipo, :id_cliente, :id_clienteEntrega, :serie, :codigo, :fechaEntrega, :horaEntrega)");

		$stmt->bindParam(":id_equipo", $datos['id_equipo'],PDO::PARAM_INT);
		$stmt->bindParam(":id_clienteEntrega", $datos['id_usuarioEntrega'],PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos['id_usuario'],PDO::PARAM_INT);
		$stmt->bindParam(":serie", $datos['serie'],PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos['codigo'], PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntrega", $datos['fechaEntrega'], PDO::PARAM_STR);
		$stmt->bindParam(":horaEntrega", $datos['horaEntrega'], PDO::PARAM_STR);

		/*$stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);*/

		if ($stmt->execute()){

			return 'ok';


		}else{
			return 'falso';
		}


		$stmt -> close();

		$stmt = null;


	}


	/*=============================================
	=            EDITAR CLIENTE        =
	=============================================*/


	public static function mdlEditarCargo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_equipo = :id_equipo, id_cliente = :id_cliente, id_clienteEntrega = :id_clienteEntrega, fechaEntrega = :fechaEntrega, horaEntrega = :horaEntrega WHERE id = :id");

		$stmt->bindParam(":id_equipo", $datos['id_equipo'],PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos['id_usuario'],PDO::PARAM_STR);
		$stmt->bindParam(":id_clienteEntrega", $datos['id_usuarioEntrega'],PDO::PARAM_STR);
		$stmt->bindParam(":fechaEntrega", $datos['fechaEntrega'], PDO::PARAM_STR); 	
		$stmt->bindParam(":horaEntrega", $datos['horaEntrega'], PDO::PARAM_STR); 	
		$stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);

		if ($stmt->execute()){

			return 'ok';


		}else{
			return 'falso';
		}


		$stmt -> close();

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
	=            ELIMINAR CLIENTE        =
	=============================================*/


	public static function mdlEliminarCargo($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		}else{

			return 'false';
		}


		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	=      MOSTRAR TOTAL CARGOS         =
	=============================================*/


	public static function mdlMostrarTotalCargos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;


	}




	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasCargos($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaEntrega like '%$fechaFinal%'");

			$stmt -> bindParam(":fechaEntrega", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaEntrega BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechaEntrega BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


} // FIN DE LA CLASE
<?php 

require_once "conexion.php";

class ModeloTipoDocumento{


		/*=============================================
		=            MOSTRAR TIPO DOCUEMTNO          =
		=============================================*/

		 public static function mdlMostrarTipoDocumento($tabla, $item, $valor){


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
		=            VALIDAR NOMBRE DE  TIPO DOCUEMTNO          =
		=============================================*/

		 public static function mdlValidarNumeroDeDocumento($tabla, $datos){
			

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo_documento = :id_tipo_documento AND  id_proveedor = :id_proveedor AND  serie = :serie AND ntipo = :ntipo ");

				$stmt -> bindParam(":id_tipo_documento", $datos['tipoDocumento'], PDO::PARAM_INT);
				$stmt -> bindParam(":id_proveedor", $datos['proveedor'], PDO::PARAM_INT);
				$stmt -> bindParam(":serie", $datos['serie'], PDO::PARAM_STR);
				$stmt -> bindParam(":ntipo", $datos['nDocumento'], PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();			

				$stmt -> close();

				$stmt = null;

		}









		/*================================================
		=            INGRRESAR TIPO DOCUMENTO            =
		================================================*/
 

	 public static function mdlAgregarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_documento, id_proveedor, id_usuario, serie, ntipo, fecha_emision, fecha_almacenamiento) VALUES(:id_tipo_documento, :id_proveedor, :id_usuario, :serie, :ntipo, :fecha_emision, :fecha_almacenamiento)");

		$stmt->bindParam(":id_tipo_documento", $datos['id_tipo_documento'], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos['id_proveedor'], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_INT);
		$stmt->bindParam(":serie", $datos['serie'], PDO::PARAM_STR);
		$stmt->bindParam(":ntipo", $datos['ntipo'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_emision", $datos['fecha_emision'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_almacenamiento", $datos['fecha_almacenamiento'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}







	/*================================================
		=            INGRRESAR TIPO DOCUMENTO            =
		================================================*/
 

	 public static function mdlEditarTipoDocumento($tabla, $datos){

	 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_documento  = :id_tipo_documento, id_proveedor = :id_proveedor, serie = :serie, ntipo = :ntipo, fecha_emision = :fecha_emision, fecha_almacenamiento = :fecha_almacenamiento  WHERE id = :id");

	 

		$stmt->bindParam(":id_tipo_documento", $datos['id_tipo_documento'], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos['id_proveedor'], PDO::PARAM_INT); 
		$stmt->bindParam(":serie", $datos['serie'], PDO::PARAM_STR);
		$stmt->bindParam(":ntipo", $datos['ntipo'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_emision", $datos['fecha_emision'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_almacenamiento", $datos['fecha_almacenamiento'], PDO::PARAM_STR);
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

	public static function mdlActualizarTipoDocumento($tabla, $item, $valor, $item2, $valor2){


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
		=            OBTENER ULTIMO ID VENTA           =
		=============================================*/

		public static function mdlObtenerUltimoId($tabla){


			$stmt = Conexion::conectar()->prepare("SELECT MAX(id) FROM $tabla");					

				$stmt->execute();

				return $stmt -> fetchAll();

				$stmt -> close();

			   $stmt = null;
		}




		/*=============================================
	=            ELIMINAR DOCUMENTO DE COMMPAS          =
	=============================================*/


	 public static function mdlEliminarTipoDocumento($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}

 

		
	}


	} // FIN DE CLASE	
 <?php 

 require_once "conexion.php";

 class ModeloProveedores{


		/*=============================================
		=            MOSTRAR TIPO DOCUEMTNO          =
		=============================================*/

		public static function mdlMostrarProveedores($tabla, $item, $valor){


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
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlCrearProveedores($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(proveedor, ruc, direccion, email, telefono, fecha_Ingreso) VALUES (:proveedor, :ruc, :direccion, :email, :telefono, :fechaIngreso)");

		
		$stmt->bindParam(":proveedor", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);		 
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);		
		$stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;

	}





	/*=============================================
	EDITAR
	=============================================*/

	static public function mdlEditarProveedores($tabla, $datos){

		

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET proveedor = :proveedor, ruc = :ruc, direccion = :direccion, email =  :email, telefono = :telefono  WHERE id = :id");

		
		$stmt->bindParam(":proveedor", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);		 
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
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


	public static function mdlEliminarProveedores($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}

		

		
	}

	/*=============================================
	=      MOSTRAR TOTAL PRODUCTO         =
	=============================================*/


	public static function mdlMostrarTotalProveedores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;


	}





} // FIN DE LA CLASE
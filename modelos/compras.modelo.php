<?php 

require_once "conexion.php";

class ModeloCompras{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		 public static function mdlMostrarCompras($tabla, $item, $valor){


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
	=            INGRESAR GASTOS          =
	=============================================*/

	 public static function mdlAgregarCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipodocumento_detalle, productos, total, fecha_compra, responsable) VALUES(:id_tipodocumento_detalle, :productos, :total, :fecha_compra, :responsable)");

		$stmt->bindParam(":id_tipodocumento_detalle", $datos['id_tipodocumento_detalle'], PDO::PARAM_INT); 
		$stmt->bindParam(":productos", $datos['listaProductosDocumento'], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos['totalVenta'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_compra", $datos['fecha_compra'], PDO::PARAM_STR);
		$stmt->bindParam(":responsable", $datos['nuevoResponsableGastos'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}




	/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	 public static function mdlActualizarCompras($tabla, $datos){	 


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET productos = :productos, total = :total, responsable = :responsable WHERE id_tipodocumento_detalle = :id_tipodocumento_detalle");

		$stmt->bindParam(":id_tipodocumento_detalle", $datos['id_tipodocumento_detalle'], PDO::PARAM_INT);		
		$stmt->bindParam(":productos", $datos['listaProductosDocumento'], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos['totalVenta'], PDO::PARAM_STR);
		/*$stmt->bindParam(":fecha_compra", $datos['fecha_compra'], PDO::PARAM_STR);*/
		$stmt->bindParam(":responsable", $datos['nuevoResponsableGastos'], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;


	}






	/*=============================================
	=            INGRESAR GASTOS          =
	=============================================*/

	 public static function mdlAgregarTipoDocumentoCompras($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipodocumento_detalle, fecha_compra) VALUES(:id_tipodocumento_detalle, :fecha_compra)");

		$stmt->bindParam(":id_tipodocumento_detalle", $datos['id_tipodocumento_detalle'], PDO::PARAM_INT);		
		$stmt->bindParam(":fecha_compra", $datos['fecha_compra'], PDO::PARAM_STR);

		if ($stmt->execute()) {

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


	 public static function mdlEliminarTipoDocumentoCompras($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_tipodocumento_detalle = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		}else{
			return 'error';
		}

 

		
	}








	/*=============================================
	ACTUALIZAR DOCUEMTNOS
	=============================================*/

	public static function mdlActualizarTipoDocumentoCompras($tabla, $item, $valor, $item2, $valor2){


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



	static public  function mdlMostrarTotalCompras($tabla){ 

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla "); 

		$stmt->execute(); 

		return $stmt->fetch(); 

		$stmt-close(); 

		$stmt = null;




	}



	} // FINI DE LA CLASE

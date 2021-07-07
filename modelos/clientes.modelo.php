<?php 

require_once "conexion.php";

class ModeloCliente{


/*=============================================
=            MOSTRAR CLIENTE           =
=============================================*/

 public static function mdlMostrarCliente($tabla, $item, $valor){

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





  public static function mdlRegistrarCliente($tabla, $datos){


	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_area, nombre, documentoID, email, telefono, direccion)VALUES(:id_area, :cliente, :documentoID, :email, :telefono, :direccion)");

	$stmt->bindParam(":cliente", $datos['cliente'],PDO::PARAM_STR);
	$stmt->bindParam(":id_area", $datos['id_area'],PDO::PARAM_STR);
	$stmt->bindParam(":documentoID", $datos['documentoID'], PDO::PARAM_STR);
	$stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
	$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
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


  public static function mdlEditarCliente($tabla, $datos){

$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_area = :id_area, nombre = :cliente, documentoID = :documentoID, email = :email, telefono = :telefono, direccion = :direccion WHERE id = :id");

	$stmt->bindParam(":id_area", $datos['id_area'],PDO::PARAM_STR);
	$stmt->bindParam(":cliente", $datos['cliente'],PDO::PARAM_STR);
	$stmt->bindParam(":documentoID", $datos['documentoID'], PDO::PARAM_STR);
	$stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
	$stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
	$stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);	
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
=            ELIMINAR CLIENTE        =
=============================================*/


  public static function mdlEliminarCliente($tabla, $datos){


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
=           ACTUALIZAR CLIENTE          =
=============================================*/


	 public static function mdlActualizarCliente($tabla, $item, $valor, $valor2){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item  = :$item WHERE id = :id");

		$stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;


	}


/*=============================================
=      MOSTRAR TOTAL CLIENTES         =
=============================================*/


  public static function mdlMostrarTotalCliente($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

	$stmt->execute();

	return $stmt->fetchAll();

	$stmt->close();

	$stmt = null;


}


} //FN DE LA CLASE


?>
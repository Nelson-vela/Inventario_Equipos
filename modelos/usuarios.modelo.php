<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	 public static function mdlMostrarUsuarios($tabla, $item, $valor){

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
	REGISTRAR USUARIOS
	=============================================*/

	 public static function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, usuario, password, perfil, foto) VALUES(:nombre, :usuario, :password, :perfil, :foto)");

		$stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(":password",$datos['password'], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos['perfil'], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos['ruta'], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";	

		}else{

			return "error";
		}


		$stmt->close();
		
		$stmt = null;

	}



/*=============================================
	EDITAR USUARIOS
	=============================================*/


 public static function mdlEditarUsuario($tabla, $datos, $item){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, perfil =:perfil, foto = :foto WHERE id = :item");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		//$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":item", $item, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;

	}



/*=============================================
	ACTUALIZAR USUARIOS
	=============================================*/

	public static function mdlActualizarUsuarios($tabla, $item, $valor, $item2, $valor2){


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
	BORRAR USUARIOS
	=============================================*/

	 public static function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(':id', $datos, PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";

		}

		$stmt->close();
		
		$stmt = null;





	}



	/*=============================================
		=      MOSTRAR TOTAL USUARIOS         =
		=============================================*/


 public static function mdlMostrarTotalUsuario($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

	$stmt->execute();

	return $stmt->fetchAll();

	$stmt->close();

	$stmt = null;


}


}
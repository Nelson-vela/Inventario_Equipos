<?php 

require_once "conexion.php";

class ModeloEquipo{


		/*=============================================
	=            MOSTRAR PRODUCTOS           =
	=============================================*/

	public static function mdlMostrarEquipos($tabla, $item, $valor){
		

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		
		$stmt -> close();

		$stmt = null;



	}





		/*=============================================
	=            MOSTRAR EQUIPOR POR AREA           =
	=============================================*/

	public static function mdlMostrarEquiposAreas($tabla, $item, $valor){
		

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		
		$stmt -> close();

		$stmt = null;



	}



	/*=============================================
	=            CREAR PRODUCTOS           =
	=============================================*/

	public static function mdlCrearEquipos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, id_area, id_cliente, alias, serie, marca, modelo, codbarra, detalles, estado, imagen, fecha_ingreso)VALUES(:id_categoria, :id_area, :id_cliente, :alias, :serie, :marca, :modelo, :codbarra, :detalles, :estado, :imagen, :fecha_ingreso)");

		$stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $datos['id_area'], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos['id_cliente'], PDO::PARAM_INT);
		$stmt->bindParam(":alias", $datos['alias'], PDO::PARAM_STR);
		$stmt->bindParam(":serie", $datos['serie'], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos['marca'], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos['modelo'], PDO::PARAM_STR);
		$stmt->bindParam(":codbarra", $datos['codbarra'], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos['detalles'], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_INT);
		$stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos['fecha_ingreso'], PDO::PARAM_STR);
/*		$stmt->bindParam(":ultimo_mantenimiento", $datos['ultimo_mantenimiento'], PDO::PARAM_STR);*/

		if ($stmt->execute()) {

			return 'ok';

		}else{
			
			return 'error';
		}

		$stmt -> close();

		$stmt = null;


	}




	public static function mdlEditarEquipos($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_area = :id_area, id_cliente = :id_cliente, alias = :alias, serie = :serie, marca = :marca, modelo = :modelo, codbarra = :codbarra, detalles = :detalles, estado = :estado, imagen = :imagen, fecha_ingreso = :fecha_ingreso WHERE id = :id ");


		$stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);
		$stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $datos['id_area'], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos['id_cliente'], PDO::PARAM_INT);
		$stmt->bindParam(":alias", $datos['alias'], PDO::PARAM_STR);
		$stmt->bindParam(":serie", $datos['serie'], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos['marca'], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos['modelo'], PDO::PARAM_STR);
		$stmt->bindParam(":codbarra", $datos['codbarra'], PDO::PARAM_STR);
		$stmt->bindParam(":detalles", $datos['detalles'], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_INT);
		$stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $datos['fecha_ingreso'], PDO::PARAM_STR);
		/*$stmt->bindParam(":ultimo_mantenimiento", $datos['ultimo_mantenimiento'], PDO::PARAM_STR);*/
		if ($stmt->execute()) {

			return 'ok';

		}else{
			
			return 'error';
		}

		$stmt -> close();

		$stmt = null;


	}





	public static function mdlBorrarEquipos($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id ");
		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return 'ok';

		}else{

			return 'false';
		}

		$stmt->close();
		
		$stmt = null;



	}


/*=============================================
=           ACTUALIZAR PRODUCTO          =
=============================================*/


public static function mdlActualizarEquipos($tabla, $item, $valor, $valor2){


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
	=      MOSTRAR TOTAL PRODUCTO         =
	=============================================*/


	public static function mdlMostrarTotalEquipos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;


	}




} //FIN DE LA CLASE






?>
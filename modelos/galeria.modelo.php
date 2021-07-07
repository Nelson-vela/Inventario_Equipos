<?php 

require_once "conexion.php";

class ModeloCategoriaGaleria{


		/*=============================================
		=            MOSTRAR CATEGORIA          =
		=============================================*/

		 public static function mdlMostrarCategoriaGaleria($tabla, $item, $valor){


			if ($item != null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

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

			 public static function mdlsubirGaleria($tabla, $datos){

				$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idventa, titulo, ruta) VALUES(:idventa, :titulo, :ruta)");

				$stmt->bindParam(":idventa", $datos['idventa'], PDO::PARAM_STR);
				$stmt->bindParam(":titulo", $datos['titulo'], PDO::PARAM_STR);
				$stmt->bindParam(":ruta", $datos['imagen'], PDO::PARAM_STR);
			
				/*$stmt->bindParam(":estado", 1, PDO::PARAM_STR);*/


				if ($stmt->execute()) {

					return "ok";	

				}else{

					return "error";
				}


				$stmt->close();
				
				$stmt = null;

			}




			/*=========================================
			=            ELIMNAR CATEGORIA            =
			=========================================*/
			
			 public static function mdlEliminarCategoriaGaleria($tabla, $item, $valor){

				$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

				$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

				if ($stmt->execute()) {
					
					return 'oka';

				}else{

					return 'error';
				}


				$stmt->close();
			}

			
			
			/*=====  End of ELIMNAR CATEGORIA  ======*/
			
			 public static function mdlEliminarGaleria($tabla, $datos){

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




			 public static function mdlsubirGaleriaConformidad($tabla, $datos){

				$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idventa, ruta) VALUES(:idventa, :ruta)");

				$stmt->bindParam(":idventa", $datos['idventa'], PDO::PARAM_STR);
				
				$stmt->bindParam(":ruta", $datos['imagen'], PDO::PARAM_STR);		
			


				if ($stmt->execute()) {

					return "ok";	

				}else{

					return "error";
				}


				$stmt->close();
				
				$stmt = null;

			}



			/*============================================
			=            ELIMINAR CONFORMIDAD            =
			============================================*/
			
			 public static function mdlEliminarGaleriaConformidad($tabla, $datos){

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
			
			
			/*=====  End of ELIMINAR CONFORMIDAD  ======*/
			
		
			

	} //FIN DE LA CLASE


	?>
<?php 

ob_clean();

require('fpdf.php');


class PDF extends FPDF
{
	function Header()
	{
		$this->Image('vistas/img/logoGrande.png', 15, 15, 50 );
		$this->SetFont('Arial','B',15);
		$this->Cell(30);
		$this->Ln(30);
		$this->Cell(250,10, 'Reporte De Todas Las Empresas',0,0,'C');
		$this->Ln(20);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
	}		
}



//$consulta = Consulta::mostrarCliente($id);


$pdf=new PDF('L','mm','letter');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',9);
$pdf->SetX(87);

$pdf->Cell(20,6,'ID',1,0,'C',1); 
$pdf->Cell(60,6,'EMPRESA',1,0,'C',1);
$pdf->Cell(35,6,'FECHA',1,0,'C',1);


$pdf->SetFont('Arial','',10);



		/*=================================================
		=            MOSTRAR EMPRESAS           =
		=================================================*/

		require_once 'modelos/conexion.php';

		function mdlMostrarReportes($tabla, $item, $valor){


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

		$tabla ='empresas';
		$item = null;
		$valor = null;

		$empresa = mdlMostrarReportes($tabla, $item, $valor);


		foreach ($empresa as $key => $empre)  
			 

		{

			$pdf->Ln();
			$pdf->SetX(87);
			$pdf->Cell(20,6,utf8_decode($empre['id']),1,0,'C');
			$pdf->Cell(60,6,utf8_decode($empre['empresa']),1,0,'C');	
			$pdf->Cell(35,6,$empre['fecha'],1,0,'C');

		}	

		$pdf->Output();

		?>

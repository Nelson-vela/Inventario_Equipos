<?php 
ob_clean();
require_once 'modelos/conexion.php';

$id = $_GET['idClie'];

$item = 'id';
$valor = $id;
$tabla = 'ventas';

function mdlMostrarReporte($tabla, $item, $valor){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

	$stmt -> execute();

	return $stmt -> fetchAll();


}



$servicios = mdlMostrarReporte($tabla, $item, $valor);

foreach ($servicios as $key => $servicio) {

}

$valor2 = $servicio['id'];
$item2 = 'idventa';
$tabla2 = 'galeria';



function mdlMostrarGaleria($tabla2, $item2, $valor2){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE $item2 = :$item2");

	$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

	$stmt -> execute();

	return $stmt -> fetchAll();


}



$galeria = mdlMostrarGaleria($tabla2, $item2, $valor2);

$valor3 = $servicio['id'];
$item3 = 'idventa';
$tabla3 = 'galeria_conformidad';

$galeriaConformidad = mdlMostrarGaleria($tabla3, $item3, $valor3);


$codigo = $servicio['numObra'];


$GLOBALS["codigo"] = $codigo;



require_once ('fpdf.php');


class PDF extends FPDF{

	var $widths;
	var $aligns;

	function SetWidths($w){

	//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a){

	//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data){

	//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
	//Issue a page break first if needed
		$this->CheckPageBreak($h);
	//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
		//Draw the border

			$this->Rect($x,$y,$w,$h);

			$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
	//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h){

	//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt){

	//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}


	function Header(){




		$this->Image('vistas/img/logo.jpg' , 20 ,8, 23 , 18,'JPG');
		/*$this->Image('vistas/img/plantilla/header.png', 60 ,13, 117 , 20,'PNG');*/
		/*$this->Image('vistas/img/plantilla/header.png' , 20 ,33, 22 , 21,'PNG');*/
		$this->Image('vistas/img/plantilla/header.png' , 163 ,10, 35 , 20,'PNG');

		/*$this->Ln(15);
		$this->SetFont('Arial','B',14);
		$this->Text(35,73,utf8_decode('INFORME DE TRABAJOS REALIZADOS DE LA OBRA '.$GLOBALS['codigo'].''),0,'C', 0);
		$this->SetFont('Arial','',10);*/
		/*	$this->Text(100,73,utf8_decode('Asunto: Acta de conformidad del servicio N°'.$GLOBALS['codigo'].'-2019-AMSB'),0,'C', 0);*/

		$this->Ln(27);
	}

} // FIN DE LA CLASE



$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$pdf=new PDF('P','mm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);
$pdf->Ln(27);

$pdf->SetFont('Arial','B',14);
$pdf->Text(35,73,utf8_decode('INFORME DE TRABAJOS REALIZADOS DE LA OBRA '.$GLOBALS['codigo'].''),0,'C', 0);
$pdf->SetFont('Arial','',10);

$pdf->Ln(15);

foreach ($servicios as $key => $servicio) {

	    $fechaBD = new DateTime($servicio['fechaModi']);
         $fecha =  $fechaBD->format('d-m-Y');
                    

	$pdf->SetFont('Arial','',11);
	$pdf->MultiCell(177,6, utf8_decode('Informe de los trabajos realizados en la obra '.$GLOBALS['codigo'].', realizados el día '.utf8_decode($fecha).', en la dirección  ').utf8_decode($servicio['direccion']."."),0,'J');

	/*$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");*/
	$pdf->SetFont('Arial','',8);
	$pdf->Ln(5);
	$pdf->MultiCell(177,6,utf8_decode('SE ADJUNTA'),0,'J');

	$pdf->SetFont('Arial','',8);
	$pdf->Ln(5);
	$pdf->MultiCell(177,6,utf8_decode('FOTOGRAFIAS'),0,'J');

	$pdf->SetFont('Arial','',8);
	$pdf->Ln(5);
	$pdf->MultiCell(177,6,utf8_decode('CONFORMIDAD'),0,'J');
	
	/*$pdf->MultiCell(177,6,utf8_decode('Habiendose realizado la verificación de los trabajos realizados, previo realización de las pruebas necesarias y de no haber observaciones a los trabajos realizados, hacemos constancia de que se da concluida y a la vez conformidad de la ejecución del servicio. Siendo'." ".date('d')." dias del mes de ".$meses[date('n')-1]. " de ".date('Y')."." ),0,'J');*/

	$pdf->Ln(5);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);

	$pdf->Cell(110,6,'TAREA',1,0,'C',1);	
	$pdf->Cell(20,6,'CANTIDAD',1,0,'C',1);
	$pdf->Cell(20,6,'PRECIO UNI',1,0,'C',1);
	$pdf->Cell(20,6,'PRECIO',1,0,'C',1);
/*$pdf->Cell(30,6,'CARGO',1,0,'C',1);
$pdf->Cell(25,6,'MONTO',1,0,'C',1);
$pdf->Cell(22,6,'IVA',1,0,'C',1);
$pdf->Cell(25,6,'TOTAL',1,0,'C',1);
$pdf->Cell(35,6,'FECHA',1,0,'C',1);*/


$pro = json_decode($servicio['productos'], true);
$proExtra = json_decode($servicio['productosExtras'], true);




$pdf->SetFont('Arial','',10);




foreach ($pro as $key => $value) {
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(110,6,utf8_decode($value['descripcion']),1,0,'C');
	$pdf->Cell(20,6,utf8_decode($value['cantidad']),1,0,'C');	
	$pdf->Cell(20,6,utf8_decode($value['precio']),1,0,'C');	
	$pdf->Cell(20,6,utf8_decode($value['total']),1,0,'C');	


}

if (isset($proExtra)) { // VALIDAR SI EXISTE UN SERVICIO EXTRA
	 


foreach ($proExtra as $key => $value) {
	
	$pdf->Ln();
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(110,6,utf8_decode($value['descripcion']),1,0,'C');
	$pdf->Cell(20,6,utf8_decode($value['cantidad']),1,0,'C');	
	$pdf->Cell(20,6,utf8_decode($value['precio']),1,0,'C');	
	$pdf->Cell(20,6,utf8_decode($value['total']),1,0,'C');	


	}

}


$pdf->SetFont('Arial','',8);
$pdf->Ln();
/*$pdf->SetX(105)*/;
$pdf->Cell(150,6,'TOTAL SIN IVA',1,0,'C',1);

$pdf->SetFont('Arial','',8);
/*$pdf->SetX(140);*/
$pdf->Cell(20,6,utf8_decode($servicio['neto']),1,0,'C',1);


$pdf->Ln();
$pdf->SetFont('Arial','',8);
/*$pdf->SetX(105);*/
$pdf->Cell(150,6,'TOTAL + IVA',1,0,'C',1);


$pdf->SetFont('Arial','',8);
/*$pdf->SetX(140);*/
$pdf->Cell(20,6,utf8_decode($servicio['total']),1,0,'C',1);

$pdf->Ln(20);

$pdf->SetFont('Arial','',11);
$pdf->SetFillColor(255); 

if($galeria){

$pdf->AddPage();

foreach ($galeria as $key => $img) {
    
	if ($img["ruta"] !='') {
            
        $pdf->Cell(1,150, $img['titulo'],0,'C',1);
		//$pdf->Cell(60,5, $pdf->Image(''.$img["ruta"].'', $pdf->GetX(), $pdf->GetY(), 50));
		 $pdf->Cell(100,20, $pdf->Image(''.$img["ruta"].'',$pdf->GetX()-2, $pdf->GetY()+10,75,60));
		//$pdf->Cell(60,5, $pdf->Image(''.$img["ruta"].'', 10,10,10));
		//$pdf->Cell(60,5, $pdf->Image(''.$img["ruta"].'',15,60, 100, 100));
		//$pdf->Cell(60,5, $pdf->Image(''.$img["ruta"].'',5,60,75,50));
		

		if ($key+1 ==2) {

			$pdf->Ln(75);
		 
			

		}
		
	}else{

		$pdf->Ln(40);	
	}

}

}

foreach ($galeriaConformidad as $key => $imgConformidad) {
	
	if ($imgConformidad["ruta"] !='') {

	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->Text(70,50,utf8_decode('CONFORMIDAD DE OBRA'),0,'C', 0);
	$pdf->Ln();
	$pdf->Image(''.$imgConformidad["ruta"].'',15,60, 180, 222);

	}else{

	$pdf->Ln(40);	
	
	}

}

}  
$pdf->Output();
?>
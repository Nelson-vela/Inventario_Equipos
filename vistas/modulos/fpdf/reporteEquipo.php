<?php  
include "fpdf/fpdf.php";
require_once 'modelos/conexion.php';
$idEquipo = $_GET['idEquipo'];
/*echo  $fechaI = $_GET['fechaI'];
echo  $fechaF = $_GET['fechaF'];*/

$item = 'id';
$valor =  $_GET['idEquipo'];

$tabla = 'equipos';







function mdlMostrarReporteEquipo($tabla, $item, $valor){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);	

	$stmt->execute();

	return $stmt->fetch();
	

	$stmt -> close();

	$stmt = null;
}




$equipos = mdlMostrarReporteEquipo($tabla, $item, $valor);


$valor2 = $equipos['id_cliente'];

$item2 = 'id';
$tabla2 = 'clientes';


function mdlMostrarUsuario($tabla2, $item2, $valor2){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE $item2 = :$item2");

	$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

	$stmt -> execute();

	return $stmt -> fetch();


}

$cliente = mdlMostrarUsuario($tabla2, $item2, $valor2);

$tabla3 = 'areas';
$tabla4 = 'categorias';

$item3 = 'id';

$valor3 = $equipos['id_area'];
$valor4 = $equipos['id_categoria'];


$area = mdlMostrarUsuario($tabla3, $item3, $valor3);

$categoria = mdlMostrarUsuario($tabla4, $item3, $valor4);


echo $usuario = $cliente['nombre'];

$GLOBALS["cliente"] = $usuario;

$GLOBALS["idEquipo"] = $idEquipo;

$GLOBALS["area"] = $area['area'];

$GLOBALS["categoria"] = $categoria['categoria'];



//$GLOBALS["codigo"] = $codigo;

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
		$this->Image('vistas/img/plantilla/icono .png',20 ,8, 20 ,18);
//$this->Image('vistas/img/plantilla/icono .png' , 20 ,8, 23 , 18,'PNG');
		/*$this->Image('vistas/img/plantilla/header.png', 60 ,13, 117 , 20,'PNG');*/
		/*$this->Image('vistas/img/plantilla/header.png' , 20 ,33, 22 , 21,'PNG');*/
		//$this->Image('vistas/img/plantilla/header.png' , 163 ,10, 35 , 20,'PNG');

		/*$this->Ln(15);
		$this->SetFont('Arial','B',14);
		$this->Text(35,73,utf8_decode('INFORME DE TRABAJOS REALIZADOS DE LA OBRA '.$GLOBALS['codigo'].''),0,'C', 0);
		$this->SetFont('Arial','',10);*/
		/*	$this->Text(100,73,utf8_decode('Asunto: Acta de conformidad del servicio N°'.$GLOBALS['codigo'].'-2019-AMSB'),0,'C', 0);*/
		$this->Ln(15);
		$this->SetFont('Arial','B',13);		


		$this->Text(55,20,utf8_decode('REPORTE DE INVENTARIO DE EQUIPO'),0,'C', 0); 

		$this->Ln(5);


		//$this->Ln(27);
	}



	// Pie de página
	function Footer()
	{
    // Posición: a 1,5 cm del final
		$this->SetY(-15);
    // Arial italic 8
		$this->SetFont('Arial','I',8);
    // Número de página
		$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');

		date_default_timezone_set('America/Bogota');

		$fecha = date('d-m-Y');
		$hora = date('H:i:s');

		
		$fechaActual = $fecha.' '.$hora;
		$this->SetFont('Arial','B',14);
		$this->Text(0,283,utf8_decode('______________________________________________________________________________________________________________________________________'),0,'C',0);

		$this->SetY(-15);
    // Arial italic 8
		$this->SetFont('Arial','I',8);
		$this->Cell(40,10,utf8_decode('Impreso el ').$fechaActual.' ',0,0,'C');
		$this->Cell(210,10,utf8_decode('Sistema de Inventarios desarrollado por Nvela '),0,0,'C');
	}




} // FIN DE LA CLASE



$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$pdf=new PDF('P','mm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);

/*$pdf->Ln(5);*/



$fechaBD = new DateTime($equipos['fecha']);
$fecha =  $fechaBD->format('d-m-Y H:i:s');


//$pdf->SetFont('Arial','',11);
	//$pdf->MultiCell(177,6, utf8_decode('LISTA DE VENTAS DEL CODIGO '.$servicio['codigo'].', realizados el día '.utf8_decode($fecha).''),0,'J');




/*$pdf->MultiCell(177,6,utf8_decode('Habiendose realizado la verificación de los trabajos realizados, previo realización de las pruebas necesarias y de no haber observaciones a los trabajos realizados, hacemos constancia de que se da concluida y a la vez conformidad de la ejecución del servicio. Siendo'." ".date('d')." dias del mes de ".$meses[date('n')-1]. " de ".date('Y')."." ),0,'J');*/
$pdf->SetX(100);
$pdf->Ln(10);
$pdf->SetFillColor(232,232,232);

$pdf->SetX(27);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,utf8_decode('RESPONSABLE'),1,0,'C',1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($GLOBALS["cliente"]),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);	
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,utf8_decode('ÁREA'),1,0,'C',1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($GLOBALS["area"]),1,0,'C');

$pdf->Ln();

$pdf->SetX(27);	
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,utf8_decode('ALIAS'),1,0,'C',1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($equipos['alias']),1,0,'C');

$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,utf8_decode('CATEGORÍA'),1,0,'C',1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($GLOBALS["categoria"]),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,'SERIE',1,0,'C',1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($equipos['serie']),1,0,'C');	

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,'MARCA',1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($equipos['marca']),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,'MODELO',1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($equipos['modelo']),1,0,'C');	

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,'CODIGO BARRA',1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($equipos['codbarra']),1,0,'C');	


$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(150,10,'ESPECIFICACIONES DETALLADAS',1,0,'C',1); 

$pdf->Ln();	

$pdf->SetX(27);
$pdf->Cell(75,8,utf8_decode('Característica'),1,0,'C',1);
$pdf->Cell(75,8,'Detalles',1,0,'C',1);

$pro = json_decode($equipos['detalles'], true);

foreach ($pro as $key => $value) {

	$pdf->Ln();
	
	$pdf->SetX(27);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(75,8,utf8_decode($value['caracteristicas']),1,0,'C');

	$pdf->SetFont('Arial','',11);
	$pdf->Cell(75,8,utf8_decode($value['detalles']),1,0,'C');	



}

$fechaA = new DateTime($equipos['ultimo_mantenimiento']);
$fechaI = new DateTime($equipos['fecha_ingreso']);

$fecha_mantenimientos =  $fechaA->format('d-m-Y');
$fecha_ingreso =  $fechaI->format('d-m-Y');

if ($fecha_mantenimientos == "30-11--0001") {

	$fecha_mantenimiento = 'Aún no tiene mantenimiento';
	
}else{

	$fecha_mantenimiento = $fecha_mantenimientos;
	
}



$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,Utf8_decode('FECHA REGISTRO'),1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($fecha_ingreso),1,0,'C');



$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,Utf8_decode('ÚLTIMO MANTENIMIENTO'),1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($fecha_mantenimiento),1,0,'C');


if($equipos['estado'] == 1){		

	$estado = 'EXCELENTE';

}

if($equipos['estado'] == 2){

	$estado = 'EN MANTENIMIENTO';


}

if($equipos['estado'] == 3){

	$estado = 'NECESITA CAMBIOS';


}


if($equipos['estado'] == 4){

	$estado = 'DAR DE BAJA';


}



$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(75,8,Utf8_decode('ESTADO'),1,0,'C',1); 

$pdf->SetFont('Arial','',11);
$pdf->Cell(75,8,utf8_decode($estado),1,0,'C');


if ($equipos["imagen"] != '') {
	


	$pdf->Cell(100,20, $pdf->Image(''.$equipos["imagen"].'',$pdf->GetX()-110, $pdf->GetY()+20,80,70));

	/*		$pdf->Ln();	*/	 

}


$pdf->SetFont('Arial','',8);
$pdf->Ln();
/*$pdf->SetX(105)*/;
/*$pdf->Cell(150,6,'TOTAL ',1,0,'C',1);

$pdf->SetFont('Arial','',8);
$pdf->SetX(140);
$pdf->Cell(20,6,utf8_decode('S/ ').number_format($servicio['total'],2),1,0,'C',1);*/

$pdf->Ln(15);

/*$pdf->Cell(0,2,'_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ',0,0,'C');
*/


$pdf->Ln(20);

$pdf->SetFont('Arial','',11);
$pdf->SetFillColor(255); 

//$pdf->AddPage();
//$pdf->Ln(20);

$pdf->SetFont('Arial','',11);
/*$pdf->Ln(5);
$pdf->MultiCell(177,6,utf8_decode('MONTO TOTAL DE TODAS LAS COMRAS : S/ ').number_format($totalVenta["totalV"],2),0,'J'); */
$pdf->AliasNbPages();
ob_start();
$pdf->Output(); 
?>
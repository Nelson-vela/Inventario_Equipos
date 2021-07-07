<?php  
include "fpdf/fpdf.php";
require_once 'modelos/conexion.php';
$idUsuario = $_GET['idUsuarios'];
/*echo  $fechaI = $_GET['fechaI'];
echo  $fechaF = $_GET['fechaF'];*/

$item = 'id_cliente';


$GLOBALS["cliente"] = $idUsuario;

$valor =  $_GET['idUsuarios'];

$tabla = 'equipos';







function mdlMostrarReporteEquipo($tabla, $item, $valor){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_ingreso DESC");

	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);	

	$stmt->execute();

	return $stmt->fetchAll();
	

	$stmt -> close();

	$stmt = null;
}





/*
for 

 


$valor2 = $equipos['id_cliente'];

$item2 = 'id';
$tabla2 = 'clientes';
*/

function mdlMostrarUsuario($tabla2, $item2, $valor2){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE $item2 = :$item2");

	$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

	$stmt -> execute();

	return $stmt -> fetch();


}

$valor2 = $_GET['idUsuarios'];

$item2 = 'id';
$tabla2 = 'clientes';


$cliente = mdlMostrarUsuario($tabla2, $item2, $valor2);

$GLOBALS["usuario"] = $cliente['nombre'];
$GLOBALS["email"] = $cliente['email'];
$GLOBALS["telefono"] = $cliente['telefono'];
$GLOBALS["direccion"] = $cliente['direccion'];



$valor5 = $cliente['id_area'];

$item5 = 'id';
$tabla5 = 'areas';


$areas = mdlMostrarUsuario($tabla5, $item5, $valor5);


$GLOBALS["area"] = $areas['area'];




/*$tabla3 = 'areas';
$tabla4 = 'categorias';

$item3 = 'id';

$valor3 = $equipos['id_area'];
$valor4 = $equipos['id_categoria'];


$area = mdlMostrarUsuario($tabla3, $item3, $valor3);

$categoria = mdlMostrarUsuario($tabla4, $item3, $valor4);*/


/*echo $usuario = $cliente['nombre'];

$GLOBALS["cliente"] = $usuario;

$GLOBALS["idEquipo"] = $idEquipo;

$GLOBALS["area"] = $area['area'];

$GLOBALS["categoria"] = $categoria['categoria'];*/



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
		$this->Image('vistas/img/plantilla/copy.jpg',15 ,8, 50 ,15);
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


		$this->Text(80,20,utf8_decode('REPORTE DE USUARIOS CON EQUIPOS A CARGOS'),0,'C', 0); 

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



	if ($this->PageNo() > 1 ) {

		
		$this->SetY(-192);
		
		$this->SetFillColor(232,232,232);
		$this->SetFont('Arial','B',8);
		
		$this->Cell(25,6,'CATEGORIA',1,0,'C',1);
		$this->Cell(30,6,'ALIAS',1,0,'C',1);
		$this->Cell(30,6,'MARCA',1,0,'C',1);
		$this->Cell(40,6,'MODELO',1,0,'C',1);	
		$this->Cell(15,6,'FOTO',1,0,'C',1);
		$this->Cell(30,6,'FECHA REGISTRO',1,0,'C',1);
		$this->Cell(38,6,utf8_decode('ÚLTIMO MANTENIMIENTO'),1,0,'C',1);
		$this->Cell(40,6,'ESTADO',1,0,'C',1);


	}

	


		date_default_timezone_set('America/Bogota');

		$fecha = date('d-m-Y');
		$hora = date('H:i:s');

		
		$fechaActual = $fecha.' '.$hora;
		$this->SetFont('Arial','B',14);
		$this->Text(0,200,utf8_decode('______________________________________________________________________________________________________________________________________'),0,'C',0);

		$this->SetY(-15);
    // Arial italic 8
		$this->SetFont('Arial','I',8);
		$this->Cell(40,10,utf8_decode('Impreso el ').$fechaActual.' ',0,0,'C');
		$this->Cell(370,10,utf8_decode('Sistema de Inventarios desarrollado por Nvela '),0,0,'C');
	}




} // FIN DE LA CLASE



$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$pdf=new PDF('L','mm','letter');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(15,10,10);
$pdf->Ln(10);

/*$pdf->Ln(5);*/



/*$fechaBD = new DateTime($equipos['fecha']);
$fecha =  $fechaBD->format('d-m-Y H:i:s');*/


//$pdf->SetFont('Arial','',11);
	//$pdf->MultiCell(177,6, utf8_decode('LISTA DE VENTAS DEL CODIGO '.$servicio['codigo'].', realizados el día '.utf8_decode($fecha).''),0,'J');


$pdf->SetFont('Arial','',12);

/*$pdf->MultiCell(248,6,utf8_decode('Habiendose realizado la verificación de los equipos realizados, previo realización de las pruebas necesarias y de no haber observaciones a los trabajos realizados, hacemos constancia de que se da concluida y a la vez conformidad de la ejecución del servicio. Siendo'." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')."." ),0,'J');*/


$pdf->MultiCell(248,6,utf8_decode('Area : '.$GLOBALS["area"].'' ),0,'J');
$pdf->MultiCell(248,6,utf8_decode('Usuario : '.$GLOBALS["usuario"].'' ),0,'J');
$pdf->MultiCell(248,6,utf8_decode('Dirección : '.$GLOBALS["direccion"].'' ),0,'J');

/*$pdf->SetX(100);*/
$pdf->MultiCell(248,6,utf8_decode('Email : '.$GLOBALS["email"].'' ),0,'J');

/*$pdf->SetX(100);*/
$pdf->MultiCell(248,6,utf8_decode('Teléfono : '.$GLOBALS["telefono"].'' ),0,'J');



$pdf->Ln();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',8);

$pdf->Cell(25,6,'CATEGORIA',1,0,'C',1);
$pdf->Cell(30,6,'ALIAS',1,0,'C',1);
$pdf->Cell(30,6,'MARCA',1,0,'C',1);
$pdf->Cell(40,6,'MODELO',1,0,'C',1);	
$pdf->Cell(15,6,'FOTO',1,0,'C',1);
$pdf->Cell(30,6,'FECHA REGISTRO',1,0,'C',1);
$pdf->Cell(38,6,utf8_decode('ÚLTIMO MANTENIMIENTO'),1,0,'C',1);
$pdf->Cell(40,6,'ESTADO',1,0,'C',1);

$item = 'id_cliente';

$valor =  $GLOBALS["cliente"];

$tabla = 'equipos';


$equipos = mdlMostrarReporteEquipo($tabla, $item, $valor);


foreach ($equipos as $key => $value) {

	$pdf->Ln();
	$pdf->SetFont('Arial','',8);



	$item3 = 'id';
	$valor3 = $value['id_categoria'];

	$tabla3 = 'categorias';


	$categoria = mdlMostrarUsuario($tabla3, $item3, $valor3);

	$pdf->Cell(25,10,utf8_decode($categoria['categoria']),1,0,'C');	




	$pdf->Cell(30,10,utf8_decode($value['alias']),1,0,'C');	

	$pdf->Cell(30,10,utf8_decode($value['marca']),1,0,'C');

	$pdf->Cell(40,10,utf8_decode($value['modelo']),1,0,'C');	


	if ($value["imagen"] != '') {



		/*$pdf->Cell(30,15, $pdf->Image(''.$value["imagen"].'',$pdf->GetX()-5, $pdf->GetY()-5,80,70));*/

		$pdf->Cell(15,10, $pdf->Image($value['imagen'], $pdf->GetX(), $pdf->GetY(),10,10),1);  

		/*		$pdf->Ln();	*/	 

	}

/*	$pdf->Cell(30,15,utf8_decode($value['alias']),1,0,'C');	*/




	$fechaA = new DateTime($value['ultimo_mantenimiento']);
	$fechaI = new DateTime($value['fecha_ingreso']);

	$fecha_mantenimientos =  $fechaA->format('d-m-Y');
	$fecha_ingreso =  $fechaI->format('d-m-Y');

	if ($fecha_mantenimientos == "30-11--0001") {

		$fecha_mantenimiento = 'Aún no tiene mantenimiento';

	}else{

		$fecha_mantenimiento = $fecha_mantenimientos;

	}

	$pdf->Cell(30,10,utf8_decode($fecha_ingreso),1,0,'C');

	$pdf->Cell(38,10,utf8_decode($fecha_mantenimiento),1,0,'C');



	if($value['estado'] == 1){		

		$estado = 'EXCELENTE';

	}

	if($value['estado'] == 2){

		$estado = 'EN MANTENIMIENTO';


	}

	if($value['estado'] == 3){

		$estado = 'NECESITA CAMBIOS';

	}


	if($value['estado'] == 4){

		$estado = 'DAR DE BAJA';


	}

	$pdf->Cell(40,10,utf8_decode($estado),1,0,'C');	


	


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
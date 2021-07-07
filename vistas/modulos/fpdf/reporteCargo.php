<?php  
include "fpdf/fpdf.php";
require_once 'modelos/conexion.php';
$idEquipo = $_GET['idCargo'];
/*echo  $fechaI = $_GET['fechaI'];
echo  $fechaF = $_GET['fechaF'];*/

$item = 'id'; 
  
$valor =  $_GET['idCargo'];

$tablaCargo = 'cargos';








function mdlMostrarReporteEquipo($tabla, $item, $valor){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);	

	$stmt->execute();

	return $stmt->fetch();
	

	$stmt -> close();

	$stmt = null;
}




$cargo = mdlMostrarReporteEquipo($tablaCargo, $item, $valor);

$tablaEquipo = 'equipos';
$valorEqui = $cargo['id_equipo'];

$equipos = mdlMostrarReporteEquipo($tablaEquipo, $item, $valorEqui);


$valor2 = $cargo['id_cliente'];
$valor6 = $cargo['id_clienteEntrega'];

$GLOBALS["fechaEntregaEquipo"] = $cargo['fechaEntrega'];
$GLOBALS["horaEntregaEquipo"] = $cargo['horaEntrega'];

$GLOBALS["serie"] = $cargo['serie'];
$GLOBALS["codigo"] = $cargo['codigo'];

$item2 = 'id';
$tabla2 = 'clientes';


function mdlMostrarUsuario($tabla2, $item2, $valor2){


	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE $item2 = :$item2");

	$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

	$stmt -> execute();

	return $stmt -> fetch();


}

$cliente = mdlMostrarUsuario($tabla2, $item2, $valor2);
$clienteEntrega = mdlMostrarUsuario($tabla2, $item2, $valor6);

$tabla3 = 'areas';
$tabla4 = 'categorias';

$item3 = 'id';

$valor3 = $equipos['id_area'];
$valor4 = $equipos['id_categoria'];
$valor5 = $cliente['id_area'];

$valor7 = $clienteEntrega['id_area'];


$area = mdlMostrarUsuario($tabla3, $item3, $valor3);
$areaClienteEntr = mdlMostrarUsuario($tabla3, $item3, $valor7);

$categoria = mdlMostrarUsuario($tabla4, $item3, $valor4);

$clienteAre = mdlMostrarUsuario($tabla3, $item3, $valor5);


echo $usuario = $cliente['nombre'];

$GLOBALS["cliente"] = $usuario;

$GLOBALS["dni"] =  $cliente['documentoID'];

$GLOBALS["direccion"] =  $cliente['direccion'];



$GLOBALS["clienteEntrega"] =  $clienteEntrega['nombre'];





$GLOBALS["clienteArea"] =  $clienteAre['area'];
$GLOBALS["clienteAreaEntrega"] =  $areaClienteEntr['area'];



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

		$this->SetFont('Arial','',11);	

		$this->Text(178,10,utf8_decode($GLOBALS["serie"].' - '.$GLOBALS["codigo"]));


		$this->SetFont('Arial','B',13);	
		$this->Text(55,20,utf8_decode('ACTA DE ENTREGA DE EQUIPOS INFORMÁTICOS '),0,'C', 0); 

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


function obtenerFechaEnLetra($fecha){
    $dia= conocerDiaSemanaFecha($fecha);
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $dia.' '.$num.' de '.$mes.' del '.$anno;
}
 
function conocerDiaSemanaFecha($fecha) {
    $dias = array('domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}

$pdf=new PDF('P','mm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetMargins(20,20,20);

/*$pdf->Ln(5);*/



$fechaBD = new DateTime($GLOBALS["fechaEntregaEquipo"]);
$fechaD =  $fechaBD->format('d');
$fechaM =  $fechaBD->format('m');
$fechaY =  $fechaBD->format('Y');


//$pdf->SetFont('Arial','',11);
	//$pdf->MultiCell(177,6, utf8_decode('LISTA DE VENTAS DEL CODIGO '.$servicio['codigo'].', realizados el día '.utf8_decode($fecha).''),0,'J');
$pdf->SetY(-260);
$pdf->SetFont('Arial','',12);

$timestamp = strtotime($GLOBALS["horaEntregaEquipo"]);
$hora = date("h.i A", $timestamp);

$pdf->MultiCell(178,6,utf8_decode('Por el medio del presente y habiendose realizado la verificación de los equipos, previo realización de las pruebas necesarias y de no haber observaciones, hacemos entrega a '.$GLOBALS["cliente"].', con DNI '.utf8_decode($GLOBALS["dni"]).' con domicilio '.$GLOBALS["direccion"].' y laborando en el área de '.$GLOBALS["clienteArea"].', el siguiente equipo, mencionando sus características detalladas.'),0,'J');
/*
Siendo las ".$hora." del día ".obtenerFechaEnLetra($GLOBALS["fechaEntregaEquipo"]).'*/

$pdf->SetX(100);
$pdf->Ln(10);
$pdf->SetFillColor(232,232,232);

$pdf->SetX(27);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,utf8_decode('RESPONSABLE'),1,0,'C',1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($GLOBALS["cliente"]),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);	
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,utf8_decode('ÁREA DEL EQUIPO'),1,0,'C',1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($GLOBALS["area"]),1,0,'C');

$pdf->Ln();

$pdf->SetX(27);	
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,utf8_decode('ALIAS'),1,0,'C',1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($equipos['alias']),1,0,'C');

$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,utf8_decode('CATEGORÍA'),1,0,'C',1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($GLOBALS["categoria"]),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,'SERIE',1,0,'C',1);

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($equipos['serie']),1,0,'C');	

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,'MARCA',1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($equipos['marca']),1,0,'C');

$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,'MODELO',1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($equipos['modelo']),1,0,'C');	


$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,'CODIGO BARRA',1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($equipos['codbarra']),1,0,'C');	


$pdf->Ln();	

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(150,10,'ESPECIFICACIONES DETALLADAS',1,0,'C',1); 

$pdf->Ln();	

$pdf->SetX(27);
$pdf->Cell(75,6,utf8_decode('Característica'),1,0,'C',1);
$pdf->Cell(75,6,'Detalles',1,0,'C',1);

$pro = json_decode($equipos['detalles'], true);

foreach ($pro as $key => $value) {

	$pdf->Ln();
	
	$pdf->SetX(27);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(75,6,utf8_decode($value['caracteristicas']),1,0,'C');

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(75,6,utf8_decode($value['detalles']),1,0,'C');	



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
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,Utf8_decode('FECHA REGISTRO'),1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($fecha_ingreso),1,0,'C');



$pdf->Ln();

$pdf->SetX(27);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,Utf8_decode('ÚLTIMO MANTENIMIENTO'),1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($fecha_mantenimiento),1,0,'C');


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
$pdf->SetFont('Arial','B',9);
$pdf->Cell(75,6,Utf8_decode('ESTADO'),1,0,'C',1); 

$pdf->SetFont('Arial','',9);
$pdf->Cell(75,6,utf8_decode($estado),1,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->Cell(100,6,utf8_decode("Siendo las ".$hora." del día ".obtenerFechaEnLetra($GLOBALS["fechaEntregaEquipo"])),0,0,'C');




if ($equipos["imagen"] != '') {
	


	/*$pdf->Cell(100,20, $pdf->Image(''.$equipos["imagen"].'',$pdf->GetX()-30, $pdf->GetY()+10,80,70));*/
	$pdf->Ln();
	$pdf->Cell(15,10, $pdf->Image($equipos['imagen'], $pdf->GetX()+65, $pdf->GetY(),50,50),0);  

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

$pdf->SetFont('Arial','',11);

	$pdf->Ln(5);
	$pdf->Text(145,260,utf8_decode('_____________________'),0,'C', 0);
	$pdf->Text(152,265,utf8_decode($GLOBALS["clienteEntrega"]),0,'C', 0);
	$pdf->Text(159,270,utf8_decode($GLOBALS["clienteAreaEntrega"]),0,'C', 0);

	$pdf->Text(20,260,utf8_decode('______________________'),0,'C', 0);
	$pdf->Text(25,265,utf8_decode($GLOBALS["cliente"]),0,'C', 0);
	$pdf->Text(23,270,utf8_decode($GLOBALS["clienteArea"]),0,'C', 0);

//$pdf->AddPage();
//$pdf->Ln(20);

$pdf->SetFont('Arial','',11);
/*$pdf->Ln(5);
$pdf->MultiCell(177,6,utf8_decode('MONTO TOTAL DE TODAS LAS COMRAS : S/ ').number_format($totalVenta["totalV"],2),0,'J'); */
$pdf->AliasNbPages();
ob_start();
$pdf->Output(); 
?>
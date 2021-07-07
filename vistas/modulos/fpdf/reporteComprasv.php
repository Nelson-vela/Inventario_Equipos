<?php
/*ob_clean();*/
include "fpdf/fpdf.php";
require_once 'modelos/conexion.php';


$id = $_GET['idCompras']; 

$item = 'id';
$valor = $id;
$tabla = 'tipo_documento_detalle';

function mdlMostrarReporte($tabla, $item, $valor){


    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetchAll();


}




function mdlMostrarCompras2($tabla, $item, $valor){


    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();


}




$documentoDetalle = mdlMostrarReporte($tabla, $item, $valor);

foreach ($documentoDetalle as $key => $value) {

}


$itemD = 'id';
$valorD = $value['id_tipo_documento'];

$valorU = $value['id_usuario'];

$valorP = $value['id_proveedor'];

$tablaTD = 'tipo_documento';
$TablausuarioC = 'clientes';
$Tablaproveedor = 'proveedor';


$tipoDocumento = mdlMostrarCompras2($tablaTD, $itemD, $valorD);

$usuario = mdlMostrarCompras2($TablausuarioC, $itemD, $valorU);

$proveedor = mdlMostrarCompras2($Tablaproveedor, $itemD, $valorP);








$tablaP = 'compras';
$itemP = 'id_tipodocumento_detalle';
$valorPro = $id;

$productos = mdlMostrarReporte($tablaP, $itemP, $valorPro);

foreach ($productos as $key => $valuePro) {

}


$GLOBALS["pro"] = json_decode($valuePro['productos'], true);

$GLOBALS["nombre"] = $proveedor['proveedor'];
$GLOBALS["email"] = $proveedor['email'];
$GLOBALS["ruc"] = $proveedor['ruc'];
$GLOBALS["telefono"] = $proveedor['telefono'];
$GLOBALS["direccion"] = $proveedor['direccion'];



$GLOBALS["tipoDocu"] = $tipoDocumento['tipo'];


$GLOBALS["serie"] = $value['serie'];
$GLOBALS["ntipo"] = $value['ntipo'];
$GLOBALS["total"] = $value['total'];
$GLOBALS["fechaEmision"] = $value['fecha_emision'];
$GLOBALS["fechaAlmacenamiento"] = $value['fecha_almacenamiento'];


$GLOBALS["id"] = $id;






/*$pro = json_decode($venta['productos'], true);


$num_pedido = $venta['codigo'];*/




class PDF extends FPDF{


        // Cabecera de página
      function Header(){

            // Logo
            $this->Image('vistas/img/plantilla/icono .png',5,5,25,25);

            // Salto de línea
            $this->SetY(8);
            // Movernos a la derecha
            $this->Cell(27.5);

            $this->SetDrawColor(149, 148, 148);
            // Ancho del borde (1 mm)
            $this->SetLineWidth(0.4);
            $this->Cell(0.5,28,"",'L');


            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Salto de línea
            $this->Ln(-2);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(110,10,utf8_decode(strtoupper($GLOBALS["nombre"])),0,0,'L');


            // Arial bold 15
            $this->SetFont('Arial','B',13);
            // Salto de línea
            $this->Ln(8);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(110,10,"".$GLOBALS["ruc"]." ",0,0,'L');

            // Salto de línea
            $this->Ln(6);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(110,10,"Direccion: ".utf8_decode($GLOBALS["direccion"]),0,0,'L');


            // Salto de línea
            $this->Ln(3);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(110,10,"Telefono: ".utf8_decode($GLOBALS["telefono"]),0,0,'L');




            // Salto de línea
            $this->Ln(3);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(85,10,utf8_decode('Email: '.$GLOBALS["email"].''),0,0,'L');


            // Salto de línea
            $this->Ln(3);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(85,10,utf8_decode('Web: www.copycenter.com.pe'),0,0,'L');

            //****************fondo negro
            // Arial bold 15
            $this->SetFont('Arial','B',20);
            // Salto de línea
            $this->Ln(-11.5);
            // Movernos a la derecha
            $this->Cell(112);
            $this->SetFillColor(0,0,0);
            $this->Cell(68,13,'',0,0,'C',true);
            //****************fondo negro

            // Arial bold 15
            $this->SetFont('Arial','B',20);
            // Salto de línea
            $this->Ln(-1);
            // Movernos a la derecha
            $this->Cell(111);
            // Color de fondo
            $this->SetDrawColor(0, 0, 0);
            $this->SetFillColor(255,255,255);
            // Ancho del borde (1 mm)
            $this->SetLineWidth(0.4);
            $this->Cell(68,13,utf8_decode(strtoupper($GLOBALS["tipoDocu"])),1,0,'C',true);


            // Arial bold 15
            $this->SetFont('Arial','B',18);
            // Salto de línea
            $this->Ln(21);
            // Movernos a la derecha
            $this->Cell(120);
            // Ancho del borde (1 mm)
            $this->SetLineWidth(0.4);
            $this->Cell(20,10,'',0,0,'C');


            // Salto de línea
            $this->Ln(0);
            // Movernos a la derecha
            $this->Cell(120);
            // Ancho del borde (1 mm)
            $this->SetLineWidth(0.4);
            $this->Cell(45,5,$GLOBALS["serie"].'-'.$GLOBALS["ntipo"],0,0,'L');


            //****************fondo negro
            // Arial bold 15
            $this->SetFont('Arial','B',20);
            // Salto de línea
            $this->Ln(7);
            // Movernos a la derecha
            $this->Cell(98);
            $this->SetFillColor(0,0,0);
            $this->Cell(88,1,'',0,0,'C',true);
            //****************fondo negro
// Salto de línea
            $this->Ln(12);

            $fecha =  $GLOBALS["fechaEmision"];

            $dia = substr($fecha, 8, 2);
            $mes = substr($fecha, 5, 2);
            $ano = substr($fecha, 0, 4);

            // Salto de línea
            $this->Ln(-5);
            /*// Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(30);
            $this->Cell(10,10,utf8_decode('Dia'),0,0,'L');*/

           /* // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(87);
            $this->Cell(10,10,'Mes',0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(100);
            $this->Cell(10,10,utf8_decode('Año'),0,0,'L');*/

            // Salto de línea
            $this->Ln(6);
            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(5);
            $this->Cell(10,10,'Fecha Emision: ',0,0,'L');

            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(4);
            $this->Cell(15 ,10,'',0,0,'L');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(-4);
            $this->Cell(3,10,$dia,0,0,'C');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(2);
            $this->Cell(3,10,'/ '.$mes,0,0,'C');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(4);
            $this->Cell(3,10,'/ '.$ano,0,0,'C');





            $fechaA =  $GLOBALS["fechaAlmacenamiento"];

            $diaA = substr($fechaA, 8, 2);
            $mesA = substr($fechaA, 5, 2);
            $anoA = substr($fechaA, 0, 4);



            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(20);
            $this->Cell(20,10,'Fecha Almacenamiento: ',0,0,'L');

            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(4);
            $this->Cell(20 ,10,'',0,0,'L');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(-4);
            $this->Cell(3,10,$diaA,0,0,'C');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(2);
            $this->Cell(3,10,'/ '.$mesA,0,0,'C');

            // Arial bold 15
            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(4);
            $this->Cell(3,10,'/ '.$anoA,0,0,'C');







            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(40);
            $this->Cell(15,10,'Total: ',0,0,'L');


            $this->SetFont('Arial','',8);
            // Movernos a la derecha
            $this->Cell(4);
            $this->Cell(3,10,utf8_decode('S/ ').number_format($GLOBALS["total"],2),0,0,'C');

            /*// Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(54);
            $this->Cell(20,10,'RUC / DNI',0,0,'L');

            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(10);
            $this->Cell(20,10,'Telf. - email',0,0,'L');

            //****************fondo negro
            // Salto de línea
            $this->Ln(7);

            $this->SetFillColor(0,0,0);
            $this->Cell(287,0.3,'',0,0,'L',true);
            //****************fondo negro

            // Salto de línea
            $this->Ln(-1);
            // Arial bold 15
            $this->SetFont('Arial','B',7);

            $this->Cell(160,10,utf8_decode($GLOBALS["nombre"]),0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(164);
            $this->Cell(20,10,'70600515',0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(194);
            $this->Cell(85,10,utf8_decode($GLOBALS["telefono"]). ' - '.utf8_decode($GLOBALS["email"]),0,0,'L');*/

            //****************fondo negro
           /* // Salto de línea
            $this->Ln(8);
            $this->SetFillColor(0,0,0);
            $this->Cell(287,0.3,'',0,0,'L',true);
            //****************fondo negro

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            $this->Cell(85,10,'Domicilio',0,0,'L');


            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(14);
            $this->Cell(85,10,utf8_decode($GLOBALS["direccion"]),0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(110);
            $this->Cell(15,10,utf8_decode('Contacto'),0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(126);
     // $this->Cell(59,10,utf8_decode($this->row['PERS_chCONTAC']),0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',8);
            // Movernos a la derecha
            $this->Cell(188);
            $this->Cell(28,10,utf8_decode('Condición de pago'),0,0,'L');

            // Salto de línea
            $this->Ln(0);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(222);
     /// $this->Cell(15,10,utf8_decode($this->row['PEVE_chPLAZOV']),0,0,'L');*/

            //****************fondo negro
            // Salto de línea
            $this->Ln(8);

            $this->SetFillColor(0,0,0);
            $this->Cell(287,0.3,'',0,0,'L',true);
            //****************fondo negro

            // Salto de línea
            $this->Ln(-5);
            // Arial bold 15
            $this->SetFont('Arial','B',7);
            // Movernos a la derecha
            $this->Cell(270);
            


            // Salto de línea
            $this->Ln(4);
            // Arial bold 15
           /* $this->SetFont('Arial','B',7);

           $this->Cell(35,10,utf8_decode('Código Producto'),0,0,'L');*/

            // Arial bold 15
           $this->Cell(12);
           $this->SetFont('Arial','B',10);
           $this->Cell(8,10,utf8_decode('PRODUCTO'),0,0,'L');




            // Movernos a la derecha
           $this->Cell(60);  

           $this->SetFont('Arial','B',10);
           $this->Cell(8,10,utf8_decode('CANTIDAD'),0,0,'L');



            // Arial bold 15
           $this->Cell(30);  
           $this->SetFont('Arial','B',10);
           $this->Cell(23,10,utf8_decode('PRECIO'),0,0,'R');

            // Arial bold 15
           $this->Cell(18); 
           $this->SetFont('Arial','B',10);
           $this->Cell(19,10,utf8_decode('SUBTOTAL'),0,0,'R');

           


            //****************fondo negro
            // Salto de línea
           $this->Ln(8);

           $this->SetFillColor(0,0,0);
           $this->Cell(287,0.4,'',0,1,'L',true);
            //****************fondo negro

            // Salto de línea
           $this->Ln(1);
     }

// Pie de página
     function Footer()
     {

            //****************fondo negro
            // Movernos a la Izquierda
      $this->SetY(-45);

      $this->SetFillColor(0,0,0);
      $this->Cell(287,0.4,'',0,0,'L',true);
            //****************fondo negro


            // Posición
      $this->SetY(-43);
      $this->SetFont('Arial','B',7);

      $this->Cell(110,4,utf8_decode('Los precios incluyen todos los tributos, pruebas y cualquier otro concepto que'),0,0,'L');


      $this->SetFont('Arial','B',8);
      $this->Cell(50,4,utf8_decode('Total General S/'),0,0,'R');

      $this->Cell(40,4,utf8_decode('S/ ').number_format($GLOBALS["total"],2),0,0,'C');


            // Posición
      $this->SetY(-40);
      $this->SetFont('Arial','B',7);

      $this->Cell(110,4,utf8_decode('incida sobre el costo del artículo.'),0,0,'L');

            //****************fondo negro
            // Posición
      $this->SetY(-38);
      $this->Cell(108);
      $this->SetFillColor(0,0,0);
      $this->Cell(179,0.4,'',0,0,'L',true);
            //****************fondo negro

            // Posición
      $this->SetY(-34);
      $this->SetFont('Arial','B',7);

      $this->Cell(15,4,utf8_decode('Vendedor : '),0,0,'L');

      $this->Cell(95,4,utf8_decode('XXX XXX'),0,1,'L');


      $this->SetFont('Arial','B',7);
/*
      $this->Cell(150,4,utf8_decode('Depósitos a :'),0,0,'L');*/

      $this->SetFont('Arial','BI',14);
      $this->Cell(130,4,utf8_decode(''),0,0,'R');


            // Posición
      $this->SetY(-25);
      $this->SetFont('Arial','B',7);
      /*$this->Cell(105,4,utf8_decode('BCP (Soles)'),0,0,'L');*/


      $this->SetFont('Arial','B',7);
     /* $this->Cell(45,4,utf8_decode('BBVA Continental (Soles)'),0,0,'L');*/

            // Posición
      $this->SetY(-24);
    /*  $this->SetFont('Arial','B',7);

      $this->Cell(105,8,utf8_decode('Nro. de cuenta: 390-2482786-0-37'),0,0,'L');*/


      /*$this->SetFont('Arial','B',7);
      $this->Cell(45,8,utf8_decode('Nro. de cuenta: 0011-0304-3401000482-83'),0,0,'L');*/

            // Posición
      $this->SetY(-25);

      $this->SetFont('Arial','B',17);
      $this->Cell(280,7,utf8_decode(''),0,0,'R');

            // Posición
      $this->SetY(-22);

      $this->SetFont('Arial','B',9);
            // Movernos a la Derecha


            // Posición
      $this->SetY(-18);

            // Arial italic 8
      $this->SetFont('Arial','',8);
            // Movernos a la Derecha
      $this->Cell(180);
     // $this->Cell(100,8,utf8_decode($this->row['VEND_chEMAVEN']),0,1,'R');

            //****************fondo negro

      $this->SetFillColor(0,0,0);
      $this->Cell(287,0.4,'',0,1,'L',true);
            //****************fondo negro

            // Movernos a la Izquierda
      $this->SetFont('Arial','B',7);
      $this->Cell(250,8,utf8_decode('Desarrollado por Nelson Vela'),0,0,'C');


      $this->SetFont('Arial','B',8);
      $this->Cell(37,8,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'R');
}

        // Tabla simple
function plot_table($widths, $lineheight,$i,$border=0, $aligns=array(), $fills=array(), $links=array()){

      $tablaComprasD = 'compras';

      $itemCom = 'id_tipodocumento_detalle';

      $valorCom = $GLOBALS["id"];


      function mdlMostrarCompras50($tabla, $item, $valor){


          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetch();


    }

    $compraspro = mdlMostrarCompras50($tablaComprasD,$itemCom,$valorCom);      


    $this->Ln(2);
    $this->SetFont('Arial','',8);


  //foreach ($compraspro as $key3 => $valueProdC) {  



    $comprasproCC = json_decode($compraspro['productos'], true);

    foreach ($comprasproCC as $key => $prodLis ) { 


      $this->SetX(10);

      $this->Cell(40,10,utf8_decode($prodLis["titulo"].''),0,0,'L');  

      $this->Cell(45);  
      $this->Cell(80,10,utf8_decode($prodLis["cantidad"].''),0,0,'L');

      $this->Cell(-38);
      $this->Cell(80,10,utf8_decode('S/ '.number_format($prodLis['precio'],2).''),0,0,'L');

      $this->Cell(-45);
      $this->Cell(80,10,utf8_decode('S/ '.number_format($prodLis['total'],2).''),0,0,'L');

      $this->Ln(5);
// }

}



$this->SetFont('Arial','',10);


}


}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','A4');
/*$pdf->setdatos($row);
$pdf->setnumpedido($num_pedido);*/
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true,45);
$pdf->SetMargins(5, 5, 5);
$pdf->AddPage();

$widths = array(35,14,113,28,32,23,19,18);

$lineheight = 3;
$fontsize = 5.8;
$i = 0 ;




$pdf->plot_table($widths, $lineheight, $i );

$nombrePDF = $GLOBALS["serie"].'-'.$GLOBALS["ntipo"];

ob_start();
$pdf->Output(); 
?>
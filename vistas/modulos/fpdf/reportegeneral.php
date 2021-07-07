<?php   
ob_clean(); 
require('fpdf.php');
 
class PDF extends FPDF
{
 
} // FIN Class PDF
 
$pdf = new PDF();
 
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
//======================================
// Primer bloque - 3 rectángulos      =
//======================================
//Rectángulo Azul:
//Elegir color RGB que llevará Rect al tener el parametro 'F'
//Rect(x , y, ancho, alto, 'F') F rellena con el color elegido
//Line(x1, y1, x2, y2) que sale de la esquina superior izquierda
//cada rectángulo
//Elegir la posición de la celda para colocar el texto
//Usamos una celda para poner texto
$pdf->SetFillColor(80, 150, 200);
$pdf->Rect(10, 10, 95, 20, 'F');
$pdf->Line(10, 10, 15, 15);
$pdf->SetXY(15, 15);
$pdf->Cell(15, 6, '10, 10', 0 , 1); //Celda
 
//Amarillo
$pdf->SetFillColor(255, 215, 0);
$pdf->Rect(110, 10, 45 , 20, 'F');
$pdf->Line(110, 10, 115, 15);
$pdf->SetXY(115, 15);
$pdf->Cell(15, 6, '110, 10', 0 , 1);
//Verde
$pdf->SetFillColor(0, 128, 0);
$pdf->Rect(160, 10, 40 , 20, 'F');
$pdf->Line(160, 10, 165, 15);
$pdf->SetXY(165, 15  );
$pdf->Cell(15, 6, '160, 10', 0 , 1);
//========================================
 
//========================================
//  Segundo bloque - 1 rectángulo       ==
//========================================
//Salmón
$pdf->SetFillColor(255, 99, 71);
$pdf->Rect(10, 35, 190, 140, 'F');
$pdf->Line(10, 35, 15, 40);
$pdf->SetXY(15, 40);
$pdf->Cell(15, 6, '10, 35', 0 , 1);
//========================================
 
//========================================
//  Tercer bloque - 2 rectángulos       ==
//========================================
//Rosa
$pdf->SetFillColor(255, 20, 147);
$pdf->Rect(10, 180, 90, 50, 'F');
$pdf->Line(10, 180, 15, 185);
$pdf->SetXY(15, 185);
$pdf->Cell(15, 6, '10, 180', 0 , 1);
//Café
$pdf->SetFillColor(233, 150, 122);
$pdf->Rect(110, 180, 90, 50, 'F');
$pdf->Line(110, 180, 115, 185);
$pdf->SetXY(115, 185);
$pdf->Cell(15, 6, '110, 180', 0 , 1);
//========================================
 
//========================================
//  Cuarto bloque - 6 rectángulos       ==
//========================================
//Verde
$pdf->SetFillColor(124, 252, 0);
$pdf->Rect(10, 235, 40, 25, 'F');
$pdf->Line(10, 235, 15, 240);
$pdf->SetXY(15, 240);
$pdf->Cell(15, 6, '10, 235', 0 , 1);
//Café
$pdf->SetFillColor(160 ,82, 40);
$pdf->Rect(60, 235, 40, 25, 'F');
$pdf->Line(60, 235, 65, 240);
$pdf->SetXY(65, 240);
$pdf->Cell(15, 6, '60, 235', 0 , 1);
//Marrón
$pdf->SetFillColor(128, 0 ,0);
$pdf->Rect(10, 265, 40, 25, 'F');
$pdf->Line(10, 265, 15, 270);
$pdf->SetXY(15, 270);
$pdf->Cell(15, 6, '10, 265', 0 , 1);
//Morado
$pdf->SetFillColor(153, 50, 204);
$pdf->Rect(60, 265, 40, 25, 'F');
$pdf->Line(60, 265, 65, 270);
$pdf->SetXY(65, 270);
$pdf->Cell(15, 6, '60, 265', 0 , 1);
//Azul
$pdf->SetFillColor(0, 191, 255);
$pdf->Rect(110, 235, 90, 25, 'F');
$pdf->Line(110, 235, 115, 240);
$pdf->SetXY(115, 240);
$pdf->Cell(15, 6, '110, 235', 0 , 1);
//Verde
$pdf->SetFillColor(173, 255, 47);
$pdf->Rect(110, 265, 90, 25, 'F');
$pdf->Line(110, 265, 115, 270);
$pdf->SetXY(115, 270);
$pdf->Cell(15, 6, '110, 265', 0 , 1);
 
$pdf->Output(); //Salida al navegador

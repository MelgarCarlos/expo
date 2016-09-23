<?php
require('fpdf.php');
//include '../login/login.php';
//session_start();
//if(!verificar_usuario()){
//    header("location: ../Front/login.php");
//}
class PDF extends FPDF
{
// Cabecera de página
function Header()
{   
    $this->Cell(200,262,'',1,0);//Marco
    $this->Cell(-200,0,'',1,0);//Marco
    $this->Cell(200,35,'',1,0);//Header
    $this->Cell(-90,35,'',0,0);//Marco
    $this->Cell(90,35,'',1,0);//Header
    $this->Cell(-200,0,'',0,0);//Marco
    $this->Cell(200,50,'',1,0);//Titulo
    // Logo
    $this->Image('logo.png',12,12,33);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(-160);
    // Título
    $this->Cell(0,20,'Trazos digitales',0,0);
    // Movernos a la derecha
    $this->Cell(-70);
    // Arial bold 16
    $this->SetFont('Arial','',14);
    include '../login/conexion.php'; 
                            $sql="select now()";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                                $fecha=$row[0];
                            }}
    // Fecha
    $this->Cell(0,20,'Fecha: '.$fecha,0,0);
    // Salto de línea
    $this->Ln(6);
    // Arial 16
    $this->SetFont('Arial','',16);
    // Movernos a la derecha
    $this->Cell(40);
    // Título
    $this->Cell(0,20,'Grupo publicitario',0,0);
    
    $this->Ln(6);
    // Arial bold 10 italic
    $this->SetFont('Arial','I',10);
    // Movernos a la derecha
    $this->Cell(40);
    // Título
    $this->Cell(0,20,  utf8_decode('Servicios Digitales Integrados y más'),0,0);
    // Movernos a la derecha
    $this->Cell(-73);
    // Arial 14
    $this->SetFont('Arial','',14);
    // Título
    $this->Cell(0,20,'Usuario: '.$_SESSION['user'],0,0);
    // Salto de línea
    $this->Ln(20);
    // Arial bold 16
    $this->SetFont('Arial','',16);
    // Movernos a la derecha
    // Título
    $this->Cell(0,20,'Pedidos pendientes',0,0,'C');//titulo documento
    
    
    
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AddPage('P','letter',0);
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(20,10,utf8_decode('Id'),1,0);
$pdf->Cell(80,10,utf8_decode('Fecha'),1,0);
$pdf->Cell(60,10,utf8_decode('Usuario'),1,0);
$pdf->Cell(40,10,utf8_decode('Total'),1,0);
$pdf->Ln(10);
$pdf->SetFont('Arial','',8);
include '../login/conexion.php'; 
                            $sql="SELECT `id`, `fecha`,  `usuario`,`total` FROM `pedido` WHERE estado=2";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                                $pdf->Cell(20,10,utf8_decode($row[0]),1,0);
                                $pdf->Cell(80,10,substr(utf8_decode($row[1]),0,30),1,0);
                                $pdf->Cell(60,10,substr(utf8_decode($row[2]),0,70),1,0);
                                $pdf->Cell(40,10,  number_format($row[3],2,'.',''),1,1);
                                
                            }}
$pdf->Output();
?>
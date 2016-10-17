<?php
require('fpdf.php');
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../Front/login.php");
}
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
    $this->SetFont('Arial','',10);
    
    include '../login/conexion.php'; 
                            $sql="SELECT usuario.usuario,usuario_info.nombre,usuario_info.apellido,usuario_info.correo,pedido.total from pedido, usuario, usuario_info WHERE pedido.usuario=usuario.usuario and usuario.usuario=usuario_info.usuario and"
                                    . " pedido.id=".$_SESSION['carretilla'];
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                                $usuario=$row[0];
                                $nombre=$row[1];
                                $apellido=$row[2];
                                $correo=$row[3];
                                $total=$row[4];
                            }}
    
    // Movernos a la derecha
    $this->Cell(-70);
    // Fecha
    $this->Cell(0,20,utf8_decode('Nº Pedido: '.$_SESSION['carretilla']),0,0);
    // Movernos a la derecha
    $this->Cell(-70);
    // Fecha
    $this->Cell(0,30,'Usuario: '.$usuario,0,0);
    // Movernos a la derecha
    $this->Cell(-70);
    // Fecha
    $this->Cell(0,40,'Nombre: '.$nombre,0,0);
    // Salto de línea
    // Movernos a la derecha
    $this->Cell(-70);
    // Fecha
    $this->Cell(0,50,' Correo: '.$correo,0,0);
    // Salto de línea
    $this->Cell(-70);
    // Arial bold 16
    include '../login/conexion.php'; 
                            $sql="select now()";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                                $fecha=$row[0];
                            }}
    // Fecha
    $this->Cell(0,60,'Fecha: '.$fecha,0,0);
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
    $this->Ln(20);
    // Arial bold 16
    $this->SetFont('Arial','',16);
    // Movernos a la derecha
    // Título
    $this->Cell(0,20,'Pedido de compra',0,0,'C');//titulo documento
    
    
    
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
$pdf->Cell(40,10,utf8_decode('Producto'),1,0);
$pdf->Cell(20,10,utf8_decode('Cantidad'),1,0);
$pdf->Cell(20,10,utf8_decode('Subtotal'),1,0);
$pdf->Cell(120,10,utf8_decode('Instrucciones'),1,0);
$pdf->Ln(10);
$pdf->SetFont('Arial','',8);
include '../login/conexion.php'; 
                            $sql="SELECT productos.nombre,detalle_pedido.cantidad,(productos.precio_v*detalle_pedido.cantidad)as SubTotal,detalle_pedido.detalles,usuario_info.usuario,usuario_info.nombre,usuario_info.apellido,usuario_info.correo,pedido.total FROM detalle_pedido,productos,pedido,usuario,usuario_info WHERE detalle_pedido.producto=productos.id and pedido.id=detalle_pedido.pedido and pedido.usuario=usuario.usuario and usuario.usuario=usuario_info.usuario and "
                                    . "detalle_pedido.pedido=".$_SESSION['carretilla'];
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                                $pdf->Cell(40,10,utf8_decode($row[0]),1,0);
                                $pdf->Cell(20,10,substr(utf8_decode($row[1]),0,30),1,0);
                                $pdf->Cell(20,10,substr(utf8_decode($row[2]),0,30),1,0);
                                $pdf->Cell(120,10,substr(utf8_decode($row[3]),0,120),1,1);                                
                            }}
                            
include '../login/conexion.php'; 
$sql="SELECT pedido.total from pedido WHERE "
        . " pedido.id=".$_SESSION['carretilla'];
$consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
$numRegistros=mysql_num_rows($consulta);
if($numRegistros>0) {
while($row=mysql_fetch_array($consulta)){
    $total=$row[0];
}}
$pdf->Ln(10);
$pdf->Cell(40,10,utf8_decode('Total'),1,0);
$pdf->Ln(10);
$pdf->Cell(40,10,number_format($total, 2, ',', ''),1,0);
$pdf->Output();
?>
<?php 
include '../login/login.php';
session_start();
if(verificar_usuario()){
    include '../login/tiempo.php';
}else{
    header("location: login.php");
}
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Inicio</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    if(isset($_POST['compra_btn'])){
                include '../login/conexion.php';
                $consulta="UPDATE `pedido` set fecha=(select now()),estado=2  WHERE `id`='".$_SESSION['carretilla']."' ";
                if(mysql_query($consulta,$conexion)){
                $consulta="INSERT INTO `pedido`(`fecha`, `total`, `estado`, `usuario`) VALUES ((select now()),0,1,'".$_SESSION['user']."')";
                                    mysql_query($consulta,$conexion);
                                    $sql="SELECT `id` FROM `pedido` WHERE `usuario`='".$_SESSION['user']."' and `estado`=1";
                                    $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                                    $row=mysql_fetch_array($consulta);
                                    $_SESSION['carretilla']=$row[0];
                    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se realizo el pedido exitosamente, si deseas realizar otro pedido busca en nuestros productos lo que mas te parezca"});
                }, 150);
            });
    </script>
            <?php
            }}
            if(isset($_POST['eliminar_btn'])){
                include '../login/conexion.php';
                $consulta="DELETE FROM `detalle_pedido` WHERE `producto`='".$_POST['id']."' and `pedido`='".$_SESSION['carretilla']."' and `cantidad`=".$_POST['cantidad']." and `detalles`='".$_POST['descripcion']."'";
                if(mysql_query($consulta,$conexion)){
                $consulta="UPDATE `pedido` SET `total`=(select sum(productos.precio_v*detalle_pedido.cantidad) from detalle_pedido,productos WHERE detalle_pedido.producto=productos.id and detalle_pedido.pedido='".$_SESSION['carretilla']."') WHERE id='".$_SESSION['carretilla']."'";
                if(mysql_query($consulta,$conexion)){
                    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se elimino exitosamente"});
                }, 150);
            });
    </script>
            <?php
            }}}
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 5% 8%;" >
            <?php
            if(verificar_usuario()&&$_SESSION['tipo']==3){
                ?>
            <center>
            <h3 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-barcode"></span> Productos a tu disposición</h3>
            </center>   
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Nombre producto</th>
                    <th>Descripcion del pedido</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Sub total</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="select productos.nombre,detalle_pedido.detalles,productos.precio_v,detalle_pedido.cantidad,(productos.precio_v*detalle_pedido.cantidad)as SubTotal,productos.id from productos,detalle_pedido where productos.id=detalle_pedido.producto and detalle_pedido.pedido='".$_SESSION['carretilla']."'";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                                $cont=0;
                            while($row=mysql_fetch_array($consulta)){
                                $cont++;
                            ?>
                
                <tr>
                    <td><?=$row[0]?></td>
                    <td><?=$row[1]?></td>
                    <td>$<?=$row[2]?></td>
                    <td><?=$row[3]?></td>
                    <td class="fg-green">$<?=$row[4]?></td>
                    <td style="width: 10%;"><span class="button icon mif-cancel bg-red fg-white" onclick="showDialog('eliminar_form<?=$cont?>')"></span>
                    <form action="detalle.php" method="post">
                        <input name="id" type="hidden" value="<?=$row[5]?>">
                        <input name="descripcion" type="hidden" value="<?=$row[1]?>">
                        <input name="cantidad" type="hidden" value="<?=$row[3]?>">
                        <div data-role="dialog" id="eliminar_form<?=$cont?>" data-hide="2000" class="padding20" data-close-button="true">
                        <h3>¿Esta seguro que desea desactivar este producto?</h3>
                        <button name="eliminar_btn" class="button alert">Si</button>
                        </div>
                    </form>
                    </td>
                </tr>
                
                    <?php }} ?>
                </tbody>
                <script>
                        function showDialog(id){
                            var dialog = $("#"+id).data('dialog');
                            if (!dialog.element.data('opened')) {
                                dialog.open();
                            } else {
                                dialog.close();
                            }
                        }
                </script>
            </table>
    
            <center>
            <h3 class="padding10" style="margin-top: 70px;text-align: right;">Total a pagar: <a class="fg-green" style="text-decoration: none;">$<?=$total_pagar?></a></h3>
            </center>
        <?php if(isset($cont)&&$cont>0){?>
        <form action="detalle.php" method="post">
            <button class="button bg-green fg-white" name="compra_btn">Enviar pedido <span class="icon mif-mail mif-2x mif-ani-pass mif-ani-hover-shake"></span></button>
            <a href="../fpdf/pedido_compra.php" target="_blank" class="button bg-darkBlue fg-white">Generar pedido de compra (Facturacion)</a>
        </form>
            <?php  
        }
            }
            ?>
            
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
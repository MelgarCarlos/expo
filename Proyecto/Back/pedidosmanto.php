<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../index.php");
}
include '../login/tiempo.php';
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Pedidos pendientes</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <a class="fg-cobalt" href="admin.php"><span class="mif-arrow-left mif-2x"></span> Regresar</a>
            
        <?php if(isset($_POST['eliminar_btn'])){
                $consulta="UPDATE `pedido` SET `estado`=3 WHERE `id`=".$_POST['codigo'];
		if(mysql_query($consulta,$conexion)){
                    ?>
        <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se marco como pagado exitosamente"});
                }, 150);
            });
        </script>
        <?php
                } else{ ?>
                    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al marcar como pagado"});
                }, 150);
            });
    </script>
                    <?php
        } }
            ?>
            <?php if(isset($_POST['modificarbtn'])){ ?>
        <div class="bg-darkTeal" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Pedido Nº<?=$_POST['codigo']?></h4>
        </center>
        </div>
    <div>
    <h2>Datos del cliente</h2>
    <table class="table border bordered hovered" style="width: 50%;">
        <thead>
            <th>Dato</th>
            <th>Valor</th>
        </thead>
        <tbody>
            <tr>
                <td>Usuario</td>
                <td><input type='text' id='usuario' readonly='true' style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type='text' id='nombre' readonly='true' style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><input type='text' id='apellido' readonly='true' style="width: 100%;"></td>
            </tr>
            <tr>
                <td>Correo</td>
                <td><input type='text' id='correo' readonly='true' style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>
    <h3>Total a pagar: <input class="fg-green" type='text' id='total' readonly='true' style="width: 40%;"></h3>
    <form action="pedidosmanto.php" method="post">
                    <a class="button bg-green fg-white icon mif-dollars" onclick="showDialog('eliminar_form')"> Marcar como pagado</a>
                    <input name="codigo" type="hidden" value="<?=$_POST['codigo']?>">
                    <div data-role="dialog" id="eliminar_form" data-hide="2000" class="padding20" data-close-button="true">
                        <h3>¿Esta seguro que desea marcar como vendido?</h3>
                        <button name="eliminar_btn" class="button success">Si</button>
                    </div>
    </form>
    </div>
    
    <h2>Detalle del pedido</h2>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Instrucciones de pedido</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="SELECT productos.nombre,detalle_pedido.cantidad,(productos.precio_v*detalle_pedido.cantidad)as SubTotal,detalle_pedido.detalles,usuario_info.usuario,usuario_info.nombre,usuario_info.apellido,usuario_info.correo,pedido.total FROM detalle_pedido,productos,pedido,usuario,usuario_info WHERE detalle_pedido.producto=productos.id and pedido.id=detalle_pedido.pedido and pedido.usuario=usuario.usuario and usuario.usuario=usuario_info.usuario and detalle_pedido.pedido=".$_POST['codigo'];
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                
                    <td><?=$row[0]?><input name="codigo" type="hidden" value="<?=$row[0]?>"></td>
                    <td><?=$row[1]?></td>
                    <td><?=  number_format($row[2],2,".","")?></td>
                    <td><?=$row[3]?></td>
                    <?php $user=$row[4]; ?>
                    <?php $nombre=$row[5]; ?>
                    <?php $apellido=$row[6]; ?>
                    <?php $correo=$row[7]; ?>
                    <?php $total=$row[8]; ?>
                </tr>
                    <?php }
                   
                
                
                            } ?>
                </tbody>
                <script>
                    document.getElementById("usuario").value="<?=$user?>";
                    document.getElementById("nombre").value="<?=$nombre?>";
                    document.getElementById("apellido").value="<?=$apellido?>";
                    document.getElementById("correo").value="<?=$correo?>";
                    document.getElementById("total").value=" $<?=number_format($total,2,".","")?>";
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
        <?php } ?>
    
        <div class="bg-grayLighter" style="margin: 100px 0px 0px 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de pedidos</h4>
        </center>
        </div>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha y Hora</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Pedido</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="SELECT `id`, `fecha`, `total`, `estado`, `usuario` FROM pedido WHERE `estado`=2 order by `fecha` ASC ";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                <form action="pedidosmanto.php" method="post">
                    <td><?=$row[0]?><input name="codigo" type="hidden" value="<?=$row[0]?>"></td>
                    <td><?=$row[1]?></td>
                    <td><?=$row[4]?></td>
                    <td><?=  number_format($row[2],2,".","")?></td>
                    <td style="width: 16%;"><button name="modificarbtn" class="button icon mif-pencil bg-darkBlue fg-white"> Ver pedido</button></td>
                </form>
                </tr>
                
                    <?php }} ?>
                </tbody>
                
            </table>
        </div>
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
</body>
</html>
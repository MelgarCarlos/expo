<?php 
include '../login/login.php';
session_start();
if(verificar_usuario()){
    include '../login/tiempo.php';
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
    if(isset($_POST['comprar_btn'])){
        include '../login/conexion.php';
        $sql="SELECT COUNT(*) FROM `detalle_pedido` WHERE `detalles`='".$_POST['descripcion_txt']."' and `cantidad`=".$_POST['cantidad_txt']." and `pedido`='".$_SESSION['carretilla']."' and `producto`='".$_POST['id_txt']."'";
                                    $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                                    $row=mysql_fetch_array($consulta);
                                    $cantidad=$row[0];
                                    if(!($cantidad>0)){
         $consulta="INSERT INTO `detalle_pedido`(`pedido`, `producto`, `cantidad`, `detalles`) VALUES ('".$_SESSION['carretilla']."','".$_POST['id_txt']."',".$_POST['cantidad_txt'].",'".$_POST['descripcion_txt']."')";
                if(mysql_query($consulta,$conexion)){
                    $consulta="UPDATE `pedido` SET `total`=(select sum(productos.precio_v*detalle_pedido.cantidad) from detalle_pedido,productos WHERE detalle_pedido.producto=productos.id and detalle_pedido.pedido='".$_SESSION['carretilla']."') WHERE id='".$_SESSION['carretilla']."'";
                if(mysql_query($consulta,$conexion)){
                    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se añadio al carrito exitosamente"});
                }, 150);
            });
    </script>
                <?php
                }
                }
                }else{
                    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Ya se realizo un pedido con dichas indicaciones y misma cantidad de este producto"});
                }, 150);
            });
    </script>
                <?php
                }
    }
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 5% 8%;" >
            <?php 
            if(verificar_usuario()&&$_SESSION['tipo']==3){
                ?>
            <center>
            <h3 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-barcode"></span> Productos a tu disposición</h3>
            </center>   
        <?php if(isset($_POST['modificarbtn'])){ ?>
        <form action="index.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000" enctype="multipart/form-data">
        <input name="id_txt" value="<?=$_POST['codigo']?>" type="hidden">
        <div style="padding: 1% 30% 1% 30%;">
                <label> Nombre</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="titulo_txt"  autocomplete="off"  value="<?=$_POST['titulo']?>"  maxlength="40" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Titulo" data-validate-hint="Llene el campo del tipo(solo letras)" readonly="true">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Precio de venta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="precioventa_txt" value="<?=$_POST['precioventa']?>"  maxlength="12"  type="text" data-validate-func="pattern" data-validate-arg="^\d+(\.\d{1,2})?$" placeholder="Precio de venta" data-validate-hint="Llene el campo del precio(solo decimales)" readonly="true">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Instrucciones de compra </label>
                <br>
                <label> (detalla como deseas tu producto) </label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" maxlength="300" name="descripcion_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Descripción" data-validate-hint="Llene el campo de descripciòn(solo letras)"></textarea>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Cantidad a comprar</label>
                <br>
                <div class="input-control select" style="width:100%;">
                    <select  name="cantidad_txt" style="padding-left: 30px;" data-validate-func="required" data-validate-hint="Seleccione una opcion">
                        <?php
                        for($j=1;$j<=10;$j++){
                            ?>
                        <option value="<?=$j?>"><?=$j?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;alignment-adjust: central;">
                <label> Imagen ilustrativa:</label>
                <br><br>
                <img src="<?=$_POST['imagen']?>" style="width: 50%;">
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="comprar_btn" class="button fg-white bg-orange block-shadow-success text-shadow">Comprar <span class="icon mif-cart"></span></button>
            </div>
        </form>
        <?php } ?>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Comprar</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from productos where estado=1";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                <form action="index.php" method="post">
                    <input type="hidden" name="codigo" value="<?=$row[0]?>" readonly="">
                    <td><?=$row[1]?><input name="titulo" type="hidden" value="<?=$row[1]?>"></td>
                    <td><?=$row[2]?><input name="descripcion" type="hidden" value="<?=$row[2]?>"></td>
                    <td><?=$row[4]?><input name="precioventa" type="hidden" value="<?=$row[4]?>"></td>
                    <td style="width: 40%;"><img src="<?=$row[5]?>"><input name="imagen" type="hidden" value="<?=$row[5]?>"></td>
                    <td><button name="modificarbtn" class="button icon mif-cart bg-darkOrange fg-white"> Comprar</button></td>
                </form>
                </tr>
                
                    <?php }} ?>
                </tbody>
            </table>
             <?php   
            }else{
            ?>
            <center>
                <h3 class="bg-grayLighter fg-black padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><img src="../img/logo/logo.png" style="width: 20%;"> Trazos Digitales - Bienvenido</h3>
            </center>
            <div class="bg-grayLighter" style="overflow: hidden;">
                <div class="carousel place-left" data-role="carousel" data-height="380px" data-width="100%" data-controls="false" data-period="3000">
                    <?php
                    $path='../img/slide/';
                    $dir = opendir($path);
                    $files = array();
                    while ($current = readdir($dir)){
                        if( $current != "." && $current != "..") {
                            if(is_dir($path.$current)) {
                                showFiles($path.$current.'/');
                            }
                            else {
                                $files[] = $current;
                            }
                        }
                    }
                    if(count( $files )>0){
                    for($i=0; $i<count( $files ); $i++){
                        ?>
                   <     <div class="slide">
                        <img src="../img/slide/<?=$files[$i]?>" data-role="fitImage" data-format="fill">
                        </div>
                    <?php
                    }
                    }else{
                    ?>
                    <div class="slide">
                        <img src="../img/aux_slide/img_slide_1.png" data-role="fitImage" data-format="fill">
                    </div>
                   <div class="slide">
                        <img src="../img/aux_slide/img_slide_2.png" data-role="fitImage" data-format="fill">
                    </div>
                   <div class="slide">
                        <img src="../img/aux_slide/img_slide_3.png" data-role="fitImage" data-format="fill">
                    </div>
                        <?php } ?>
                </div>
                <div class="place-right" style="width: 100%;padding-bottom: 2%;">
                    <div style="padding: 1% 2% 0 2%;line-height: 18px;">
                        <h2>EL EQUIPAMIENTO MÁS COMPLETO</h2>
                        <p class="align-justify" style="margin: 0;padding: 0;">
                Estamos comprometidos a ofrecer siempre lo mejor a buen precio,  calidad, rapidez, precios competitivos y atención personalizada, además brindarles  asesoría en cuanto a lo que usted necesita. Sabemos que el mercado demanda de muchos productos innovadores, por lo que nosotros nos sujetamos a esas demandas, ofreciéndole herramientas publicitarias  para promover su empresa o institución.
                        </p>
                    </div>
                </div>
            </div>
                <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from servicios limit 3";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                                ?>
            <div class="grid" style="margin-top: 5%;">
            <?php
                                if($numRegistros<3){
                            echo  '<div class="row cells'.$numRegistros.'">';       
                                }else{
                            echo  '<div class="row cells3">';
                                }
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                    <div class="cell align-center padding10">
                        <div>
                            <span class="<?=$row[3]?> bg-darkOrange fg-white" style="padding:10%;font-size: 120px;border-radius: 50%;"></span>
                        </div>
                        <h5><?=$row[1]?></h5>
                        <p class="align-justify">
                            <?=$row[2]?>
                        </p>
                    </div>
                            <?php }
                            echo "</div>";
                            ?>
            <div class="align-center">
                <a href="quienes.php" class="button bg-darkOrange fg-white"><span class="icon mif-info" style="padding-bottom: 2px;"></span> Ver mas...</a>
            </div>
        </div>
            <?php
            }} ?>
            
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
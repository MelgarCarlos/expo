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
    <title>Promocion mantenimiento</title>
</head>
<body style="background-color: #fffff9;">
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <a class="fg-cobalt" href="productosagregar.php"><span class="mif-arrow-left mif-2x"></span> Regresar</a>
            <?php
            if(isset($_POST['eliminar_btn'])){
                $consulta="update productos set estado=0 where id=('".$_POST['codigo']."')";
		if(mysql_query($consulta,$conexion)){
                    ?>
        <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se desactivo exitosamente"});
                }, 150);
            });
        </script>
        <?php
                }else{ ?>
                    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al desactivar"});
                }, 150);
            });
    </script>
                    <?php
                }
            }
            ?>
        <?php if(isset($_POST['modificar_btn'])){
		$id=$_POST["id_txt"];
		$ti=$_POST["titulo_txt"];
                $des=$_POST["descripcion_txt"];
                $prep=$_POST["precio_txt"];
                $prev=$_POST["precioventa_txt"];
                $estado=isset($_POST['estado'])?1:0;
                $dir_subida = '../img/pro/';
                $nombre="img_pro_".$id.".png";
                
                if(strlen($_FILES['img']['tmp_name'])>0){
                $fichero_subido = $dir_subida .$nombre;
                unlink($fichero_subido);
                move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido);
                }
                $consulta="update productos set nombre='".$ti."',descripcion='".$des."',estado='".$estado."',precio_n=".$prep.",precio_v=".$prev." where id=".$id;
		if(mysql_query($consulta,$conexion)){
                    ?>
        <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se modifico exitosamente"});
                }, 150);
            });
        </script>
        <?php
                } else{ ?>
                    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al modificar"});
                }, 150);
            });
    </script>
                    <?php
        } }
            ?>
            <?php if(isset($_POST['modificarbtn'])){ ?>
    <form action="productosmanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000" enctype="multipart/form-data">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt" value="<?=$_POST['codigo']?>" maxlength="11" type="text" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id del servicio(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Nombre</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="titulo_txt"  autocomplete="off"  value="<?=$_POST['titulo']?>"  maxlength="40" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Titulo" data-validate-hint="Llene el campo del tipo(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Descripcion</label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" maxlength="200" name="descripcion_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Descripciòn" data-validate-hint="Llene el campo de descripciòn(solo letras)"><?=$_POST['descripcion']?></textarea>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Precio de produccion</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="precio_txt" value="<?=$_POST['precioprep']?>"  maxlength="12"  type="text" data-validate-func="pattern" data-validate-arg="^\d+(\.\d{1,2})?$" placeholder="Precio de produccion" data-validate-hint="Llene el campo del precio(solo decimales)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Precio de venta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="precioventa_txt" value="<?=$_POST['precioventa']?>"  maxlength="12"  type="text" data-validate-func="pattern" data-validate-arg="^\d+(\.\d{1,2})?$" placeholder="Precio de venta" data-validate-hint="Llene el campo del precio(solo decimales)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Estado:</label>
                <br>
                <label class="switch" style="padding: 3px;">
                    <input type="checkbox" name="estado" <?php if($_POST['estado']==1){echo "checked";} ?>>
                    <span class="check"></span>
                </label>
            </div>
            
            <div style="padding: 1% 30% 1% 30%;alignment-adjust: central;">
                <label> Imagen nueva: (Opcional)</label>
                <br><br>
                <div class="input-control file" data-role="input" style="width: 100%;">
                    <input type="file" name="img" accept="image/png">
                    <button class="button"><span class="mif-folder"></span></button>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;alignment-adjust: central;">
                <label> Imagen actual:</label>
                <br><br>
                <img src="<?=$_POST['imagen']?>" style="width: 40%;">
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="modificar_btn" class="button fg-white bg-darkBlue block-shadow-success text-shadow"> Modificar</button>
            </div>
        </form>
        <?php } ?>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de productos</h4>
        </center>
        </div>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>$ Produccion</th>
                    <th>$ Venta</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from productos order by estado desc";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                <form action="productosmanto.php" method="post">
                    <input type="hidden" name="codigo" value="<?=$row[0]?>" readonly="">
                    <td><?=$row[1]?><input name="titulo" type="hidden" value="<?=$row[1]?>"></td>
                    <td><?=$row[2]?><input name="descripcion" type="hidden" value="<?=$row[2]?>"></td>
                    <td><?=$row[3]?><input name="precioprep" type="hidden" value="<?=$row[3]?>"></td>
                    <td><?=$row[4]?><input name="precioventa" type="hidden" value="<?=$row[4]?>"></td>
                    <td style="width: 10%;"><?php if($row[6]==1){echo "Activo";}else{echo "Inactivo";} ?><input name="estado" type="hidden" value="<?=$row[6]?>"></td>
                    <td style="width: 20%;"><img src="<?=$row[5]?>"><input name="imagen" type="hidden" value="<?=$row[5]?>"></td>
                    <td><button name="modificarbtn" class="button icon mif-pencil bg-darkBlue fg-white"></button></td>
                </form>
                <form action="productosmanto.php" method="post">
                    <td><span class="button icon mif-cancel bg-red fg-white" onclick="showDialog('eliminar_form')"></span></td>
                    <input name="codigo" type="hidden" value="<?=$row[0]?>">
                    <div data-role="dialog" id="eliminar_form" data-hide="2000" class="padding20" data-close-button="true">
                        <h3>¿Esta seguro que desea desactivar este producto?</h3>
                        <button name="eliminar_btn" class="button alert">Si</button>
                    </div>
                </form>
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
                    
        </div>
</body>
</html>
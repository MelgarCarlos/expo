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
    <title>Agregar producto</title>
</head>
<body style="background-color: #fffff9;">    
    <div>
        <div class="bg-grayLighter" style="overflow: hidden;">
        <?php
        include '../login/conexion.php';
	$valor=1;
        $guardaru=null;
	if (isset($_POST["enviar_btn"]))
	{ 
                $guardaru=false;
		$id=$_POST["id_txt"];
		$ti=$_POST["titulo_txt"];
                $des=$_POST["descripcion_txt"];
                $nombre="img_pro_".$id.".png";
                $dir_subida = '../img/productos/';
                $fichero_subido = $dir_subida .$nombre;
                if (move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido)) {
                    $guardaru=true;
                } else {
                    $guardaru=false;
                }
                
		$consulta="INSERT INTO productos VALUES(".$id.",'".$ti."','".$des."','".$fichero_subido."',1)";
                if(mysql_query($consulta,$conexion)){
                    $guardaru=true;
                }else{
                     $guardaru=false;
                     unlink($fichero_subido);
                }
	}
?>
            <?php
    if(isset($_POST["enviar_btn"])){
        if($guardaru==true){
    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se guardo exitosamente"});
                }, 150);
            });
    </script>
    
    <?php
        }else{
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al guardar"});
                }, 150);
            });
    </script>
            <?php
        }
    }
    include 'menu.php';
    ?>
    
    <table style="width: 60%;margin: 0px;padding: 0px;">
        <tr>
            <td style="width: 50%;padding-top:5px;">
                <a href="productosagregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar productos</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="productosmanto.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-barcode" ></span> Agregar productos</h4>
        </center>
        </div>
    <form action="productosagregar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000" enctype="multipart/form-data">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt"  maxlength="11" type="text" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id del servicio(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Nombre</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="titulo_txt"  maxlength="40" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Titulo" data-validate-hint="Llene el campo del tipo(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Descripcion</label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" maxlength="200" name="descripcion_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Descripciòn" data-validate-hint="Llene el campo de descripciòn(solo letras)"></textarea>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>        
        <div style="padding: 1% 30% 1% 30%;alignment-adjust: central;">
                <label> Imagen por agregar:</label>
                <br><br>
                <div class="input-control file" data-role="input" style="width: 100%;">
                    <input type="file" name="img" accept="image/png" data-validate-func="required" data-validate-hint="Ingrese una imagen">
                    <button class="button"><span class="mif-folder"></span></button>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="enviar_btn" class="button success block-shadow-success text-shadow"> Guardar</button>
            </div>
        </form>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>

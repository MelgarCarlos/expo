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
    <title>Agregar imagen</title>
</head>
<body style="background-color: #fffff9;">
    <div>
        <div class="bg-grayLighter" style="overflow: hidden;">
        <?php
        $count=0;
	if (isset($_POST["enviar_btn"]))
	{ 
            $path='../img/slide/.';
            $dir = opendir($path);
            $files = array();
            while ($current = readdir($dir)){
                if( $current != "." && $current != "..") {
                    if(is_dir($path.$current)) {
                        showFiles($path.$current.'/');
                        $count++;
                    }
                    else {
                        $files[] = $current;
                    }
                }
            }
        $nombre="img_slide_".(count( $files )+1).".png";
        $dir_subida = '../img/slide/';
        $fichero_subido = $dir_subida .$nombre;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $fichero_subido)) {
            $guardaru=true;
        } else {
            $guardaru=false;
        }
	}
        $path='../img/slide/.';
            $dir = opendir($path);
            while ($current = readdir($dir)){
                if( $current != "." && $current != "..") {
                    if(is_dir($path.$current)) {
                        showFiles($path.$current.'/');
                    }
                    else {
                        $count++;
                    }
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
                <a href="slideragregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar usuario</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-file-image" ></span> Agregar imagen a slider</h4>
        </center>
        </div>
    <?php if($count<5){ ?>
    <form method="post" action="slideragregar.php" enctype="multipart/form-data">
        <div style="padding: 5% 30% 1% 30%;alignment-adjust: central;">
            <label> Imagen por agregar:</label>
            <br><br>
            <div class="input-control file" data-role="input" style="width: 100%;">
                <input type="file" name="img" accept="image/png" required="">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
        </div>
        <div style="padding: 1% 30% 1% 30%;">
            <button name="enviar_btn" class="button success block-shadow-success text-shadow"><span class="mif-checkmark" style="padding-bottom: 5px;"></span> Guardar</button>
        </div>
    </form>
    <?php }else{ ?>
    <h3>Se alcanzo el limite de imagenes para el slider</h3>
    <?php }?>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
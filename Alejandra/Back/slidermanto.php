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
    <title>Slider mantenimiento</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    if(isset($_POST['eliminar_btn'])){
        if(unlink($_POST['image'])){
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se elimino exitosamente"});
                }, 150);
            });
    </script>
    <?php
        }
    }
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <a class="fg-cobalt" href="slideragregar.php"><span class="mif-arrow-left mif-2x"></span> Regresar</a>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de imagenes</h4>
        </center>
        </div>
    <table class="table border bordered hovered">
                <thead>
                <tr>
                    <th>Numero imagen</th>
                    <th>Imagen</th>
                    <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
            $path='../img/slide/';
            $dir = opendir($path);
            $count=0;
            while ($current = readdir($dir)){
                if( $current != "." && $current != "..") {
                    if(is_dir($path.$current)) {
                        showFiles($path.$current.'/');
                    }
                    else {
                        $count++;
                        ?>
                <tr>
                <form action="slidermanto.php" method="post">
                     <td style="width: 15%;"><?=$count?></td>
                     <td style="width:65%;"><img src="<?=$path.$current?>"></td>
                     <td style="width: 20%;">
                         <input name="image" type="hidden" value="<?=$path.$current?>">
                         <div class="button bg-red fg-white" onclick="showDialog('eliminar_form')"><span style="padding-bottom: 5px;" class="mif-cancel"></span></div>
                     </td>
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
                    <div data-role="dialog" id="eliminar_form" data-hide="2000" class="padding20" data-close-button="true">
                        <h3>¿Esta seguro que desea eliminar?</h3>
                        <button name="eliminar_btn" class="button alert">Si</button>
                    </div>
                </form>
                </tr>   
                    <?php
                    }
                }
            
                            ?>
                
                    <?php }
                    if($count<1){
                    ?>
                <tr>
                    <td>No se encontraron resultados</td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</body>
</html>
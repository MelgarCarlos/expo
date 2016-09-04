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
    <title>Preguntas mantenimiento</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <a class="fg-cobalt" href="preguntasagregar.php"><span class="mif-arrow-left mif-2x"></span> Regresar</a>
            <?php
            if(isset($_POST['eliminar_btn'])){
                $consulta="delete from preguntas where id=('".$_POST['codigo']."')";
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
                }else{ ?>
                    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al eliminar"});
                }, 150);
            });
    </script>
                    <?php
                }
            }
            ?>
        <?php if(isset($_POST['modificar_btn'])){
                $consulta="update preguntas set pregunta=('".$_POST['pregunta_txt']."') where id='".$_POST['id_txt']."'";
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
        <form action="preguntasmanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt" type="text" value="<?=$_POST['codigo']?>" readonly="" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id de pregunta(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Pregunta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="pregunta_txt" value="<?=$_POST['pregunta']?>" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ñ])+$" placeholder="Pregunta" data-validate-hint="Llene el campo de pregunta(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div> 
            <div style="padding: 1% 30% 1% 30%;">
                <button name="modificar_btn" class="button bg-darkBlue fg-white block-shadow-success text-shadow"> Modificar</button>
                <a style="padding:2%;" href="preguntasmanto.php" class="link">Cancelar</a>
            </div>
        </form>
        <?php } ?>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de preguntas</h4>
        </center>
        </div>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from preguntas";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                <form action="preguntasmanto.php" method="post">
                    <td><?=$row[0]?><input name="codigo" type="hidden" value="<?=$row[0]?>"></td>
                    <td><?=$row[1]?><input name="pregunta" type="hidden" value="<?=$row[1]?>"></td>
                    <td><button name="modificarbtn" class="button icon mif-pencil bg-darkBlue fg-white"></button></td>
                </form>
                <form action="preguntasmanto.php" method="post">
                    <td><span class="button icon mif-cancel bg-red fg-white" onclick="showDialog('eliminar_form')"></span></td>
                    <input name="codigo" type="hidden" value="<?=$row[0]?>">
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
                
                    <?php }} ?>
                </tbody>
            </table>
        </div>
</body>
</html>
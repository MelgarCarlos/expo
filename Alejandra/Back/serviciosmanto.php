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
    <title>Servicio mantenimiento</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <a class="fg-cobalt" href="serviciosagregar.php"><span class="mif-arrow-left mif-2x"></span> Regresar</a>
            <?php
            if(isset($_POST['eliminar_btn'])){
                $consulta="delete from servicios where id=('".$_POST['codigo']."')";
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
                $id=$_POST["id_txt"];
		$ti=$_POST["titulo_txt"];
                $des=$_POST["descripcion_txt"];
                $ico=$_POST["comboicono"];
                $consulta="UPDATE `servicios` SET `titulo`='".$ti."',`descripcion`='".$des."',`icono`='".$ico."' WHERE `id`=".$id;
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
        <form action="serviciosmanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt" value="<?=$_POST['codigo']?>" readonly="" type="text" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id del servicio(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label>Titulo</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="titulo_txt"  autocomplete="off"  maxlength="30" value="<?=$_POST['titulo']?>" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Titulo" data-validate-hint="Llene el campo del tipo(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Descripcion</label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" maxlength="300" name="descripcion_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ,.ñ])+$" placeholder="Descripciòn" data-validate-hint="Llene el campo de descripciòn(solo letras)"><?=$_POST['descripcion']?></textarea>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label>Icono - <a class="fg-cobalt" href="iconos.php" target="_black">Ver todos</a></label>
                <br>
                <div class="input-control select" style="width:100%;">
                    <select id="select_icon" onchange="onChange()"  name="comboicono" style="padding-left: 30px;" data-validate-func="required" data-validate-hint="Seleccione una opcion">
                        <option value="">Seleccione una opcion</option>                
                        <?php 
                        include '../login/conexion.php';  
                        $sql="select * from iconos";
                        $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                        $numRegistros=mysql_num_rows($consulta);
                        if($numRegistros>0) {
                            while($resultado=mysql_fetch_array($consulta)){
                            ?>
                        <option value="<?=$resultado[1]?>" <?php if($resultado[1]==$_POST['icono']) echo "selected"; ?>><?=$resultado[0]?></option>
                            <?php }}?>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
                <div>
                    <span id="icono_select" class="icon <?=$_POST['icono']?> mif-3x" style="padding: 20px;"></span>
                </div>
                <script>
                            function onChange(){
                            var s=document.getElementById("select_icon");
                            var span=document.getElementById("icono_select");
                            span.setAttribute("class","");
                            span.setAttribute("class",s.value+" mif-3x");
                            }
                        </script>
            </div>  
            <div style="padding: 1% 30% 1% 30%;">
                <button name="modificar_btn" class="button bg-darkBlue fg-white block-shadow-success text-shadow"><span class="mif-checkmark" style="padding-bottom: 5px;"></span> Modificar</button>
                <a style="padding:2%;" href="serviciosmanto.php" class="link">Cancelar</a>
            </div>
        </form>
        <?php } ?>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de servicios</h4>
        </center>
        </div>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Icono</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from servicios";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                <tr>
                <form action="serviciosmanto.php" method="post">
                    <input name="codigo" type="hidden" value="<?=$row[0]?>">
                    <td><?=$row[1]?><input name="titulo" type="hidden" value="<?=$row[1]?>"></td>
                    <td><?=$row[2]?><input name="descripcion" type="hidden" value="<?=$row[2]?>"></td>
                    <td><span class="icon <?=$row[3]?> mif-2x"></span><input name="icono" type="hidden" value="<?=$row[3]?>"></td>
                    <td><button name="modificarbtn" class="button icon mif-pencil bg-darkBlue fg-white"></button></td>
                </form>
                <form action="serviciosmanto.php" method="post">
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
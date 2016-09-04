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
    <title>Agregar servicio</title>
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
                $guardaru=FALSE;
		$id=$_POST["id_txt"];
		$ti=$_POST["titulo_txt"];
                $des=$_POST["descripcion_txt"];
                $ico=$_POST["comboicono"];
		$consulta="INSERT INTO servicios VALUES('".$id."','".$ti."','".$des."','".$ico."')";
		if(mysql_query($consulta,$conexion)){
                    $guardaru=true;
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
                <a href="serviciosagregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar servicio</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="serviciomanto.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Agregar servicio</h4>
        </center>
        </div>
    <form action="serviciosagregar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt" type="text" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id del servicio(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label>Titulo</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="titulo_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Titulo" data-validate-hint="Llene el campo del tipo(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <label> Descripcion</label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" name="descripcion_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ,.ñ])+$" placeholder="Descripciòn" data-validate-hint="Llene el campo de descripciòn(solo letras)"></textarea>
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
                        <option value="<?=$resultado[1]?>"><?=$resultado[0]?></option>
                            <?php }}?>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
                <div>
                    <span id="icono_select" class="" style="padding: 20px;"></span>
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

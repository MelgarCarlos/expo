<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../index.php");
}
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Agregar pregunta</title>
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
		$pre=$_POST["pregunta_txt"];
		$consulta="INSERT INTO preguntas VALUES('".$id."','".$pre."')";
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
                <a href="preguntasagregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar pregunta</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="preguntamanto.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-darkGray fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Agregar pregunta</h4>
        </center>
        </div>
    <form action="preguntasagregar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Id</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="id_txt" type="text" data-validate-func="pattern" data-validate-arg="^[0-9]+$" placeholder="Id" data-validate-hint="Llene el id de pregunta(solo numeros)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Pregunta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="pregunta_txt" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Pregunta" data-validate-hint="Llene el campo de pregunta(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div> 
            <div style="padding: 1% 30% 1% 30%;">
                <button name="enviar_btn" class="button success block-shadow-success text-shadow"><span class="mif-checkmark" style="padding-bottom: 5px;"></span> Guardar</button>
            </div>
        </form>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>

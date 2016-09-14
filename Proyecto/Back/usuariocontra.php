<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    if($_SESSION['tipo']!=1){
    header("location: ../index.php");
    }
}
include '../login/tiempo.php';
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Modificar contraseña</title>
</head>
<body style="background-color: #fffff9;">
    <!----Validacion de contraseñas--->
    <script>
    var validacion = false;
	function myFunction() {
            var elemento = document.querySelector('#Pass2');
    var PS1 = document.getElementById("Pass1").value;
    var PS2 = document.getElementById("Pass2").value;
    elemento.setAttribute("data-validate-arg", "["+PS1+"]");
    if (PS1 != PS2) {
        document.getElementById("Pass1").style.borderColor = "#E34234";
        document.getElementById("Pass2").style.borderColor = "#E34234";
		validacion = false;
    }
    else {
	document.getElementById("Pass1").style.borderColor = "#0CDE01";
        document.getElementById("Pass2").style.borderColor = "#0CDE01";
		validacion = true;
    }
    
    }
    
    </script>
    <div>
        <div class="bg-grayLighter" style="overflow: hidden;">
        <?php
        include '../login/conexion.php';
        $guardaru=null;
	if (isset($_POST["enviar_btn"]))
	{ 
                $guardaru=false;
		$password=$_POST["contrasenia_txt"];
                $password2=$_POST["contrasenia2_txt"];
                $mensaje="";
                if(strcmp($_SESSION['user'],$password)!=0){
                    $sql="select contrasena from usuario where usuario='".$_SESSION['user']."'";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                               $contra=$row[0]; 
                            }
                            }
            include '../login/encriptar.php';
            if(strcmp($contra, encriptar(md5($password)))!=0){
                if(strcmp($password, $password2)==0){
                    $consulta="update usuario set contrasena='".  encriptar(md5($password))."' where usuario='".$_SESSION['user']."'";
		if(mysql_query($consulta,$conexion)){
                            $guardaru=true;
                }
                }else{
                    $mensaje=": Las contraseñas no coinciden";
                }
                }else{
                    $mensaje=": Las contraseña no debe ser igual a la anterior";
                }
                }else{
                    $mensaje=": Las contraseña no debe ser igual al usuario";
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
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se modifico exitosamente"});
                }, 150);
            });
    </script>
    
    <?php
        }else{
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al guardar<?=$mensaje?>"});
                }, 150);
            });
    </script>
            <?php
        }
    }
    include 'menu2.php';
    ?>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Modificar mi contraseña (usuario: <?=$_SESSION['user']?>)</h4>
        </center>
        </div>
    <form action="usuariocontra.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Contraseña</label>
                <br>
                <div class="input-control text" style="width:100%;">
                    <span class="mif-lock prepend-icon"></span>
                    <input name="contrasenia_txt"  maxlength="10" id="Pass1" onkeyup="myFunction()" type="password" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9]){6,10}" placeholder="Contraseña" data-validate-hint="Llene el campo contraseña (solo digitos min:6 max:10)" maxlength="10">
                    <span class="input-state-error mif-warning"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Repetir Contraseña</label>
                <br>
                <div class="input-control text" style="width:100%;">
                    <span class="mif-lock prepend-icon"></span>
                    <input name="contrasenia2_txt" maxlength="10" id="Pass2" onkeyup="myFunction()" type="password" data-validate-func="pattern" data-validate-arg="" placeholder="Contraseña" data-validate-hint="Las contraseñas no coinciden" maxlength="10">
                    <span class="input-state-error mif-warning"></span>
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
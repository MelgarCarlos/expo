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
    <title>Agregar usuario</title>
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
        $valor=1;
        $guardaru=null;
	if (isset($_POST["enviar_btn"]))
	{ 
                $guardaru=false;
		if($_POST["tipo_sl"]=='Administrador')
		{
			$valor=1;
		} else if($_POST["tipo_sl"]=='Empleado')
		{
			$valor=2;
		} else if($_POST["tipo_sl"]=='Cliente')
		{
			$valor=3;
		}
		$usua=$_POST["usuario_txt"];
		$password=$_POST["contrasenia_txt"];
                $password2=$_POST["contrasenia2_txt"];
                $mensaje="";
                if(strcmp($usua, $password)){
                if(strcmp($password, $password2)==0){
                    $consulta="INSERT INTO usuario VALUES('".$usua."','".md5($password)."',".$valor.",1)";
		if(mysql_query($consulta,$conexion)){
                        $nombre=$_POST["nombre_txt"];
                        $apellido=$_POST["apellido_txt"];
                        $correo=$_POST["email_txt"];
                        $pregunta=$_POST["pregunta_cb"];
                        $respuesta=$_POST["respuesta_txt"];
                        $consulta="INSERT INTO usuario_info VALUES('".$usua."','".$nombre."','".$apellido."'"
                                . ",'".$correo."',".$pregunta.",'".$respuesta."')";
                        if(mysql_query($consulta,$conexion)){
                            $guardaru=true;
                        }
                }
                }else{
                    $mensaje=": Las contraseñas no coinciden";
                }
                }else{
                    $mensaje=": La contraseña debe ser diferente al usuario";
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
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al guardar<?=$mensaje?>"});
                }, 150);
            });
    </script>
            <?php
        }
    }
    include 'menu2.php';
    ?>
    
    <table style="width: 60%;margin: 0px;padding: 0px;">
        <tr>
            <td style="width: 50%;padding-top:5px;">
                <a href="usuarioagregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar usuario</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="usuariomanto.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Agregar usuario</h4>
        </center>
        </div>
        <form action="usuarioagregar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label> Nombre</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="nombre_txt" autocomplete="off" maxlength="100" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Nombre" data-validate-hint="Llene el campo nombre (Solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Apellido</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="apellido_txt" autocomplete="off"  maxlength="100" type="text" data-validate-func="pattern" data-validate-arg="^([a-zA-Z ])+$" placeholder="Apellido" data-validate-hint="Llene el campo apellido (Solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Usuario</label>
                <br>
                <div style="width: 100%;" maxlength="40" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario" autocomplete="off">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div  style="padding: 1% 30% 1% 30%;">                
                <label> Email</label>
                <br>
                <div  style="width: 100%;" class="input-control text" data-role="input">
                    <input name="email_txt" maxlength="100" type="text" data-validate-func="email" placeholder="Su email" data-validate-hint="Llene el campo con un email valido"  autocomplete="off">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
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
                <label> Pregunta de seguridad</label>
                <br>
                <div class="input-control select" style="width:100%;">
                    <select name="pregunta_cb" style="padding-left: 30px;" data-validate-func="required" data-validate-hint="Seleccione una opcion">
                        <option value="">Seleccione una opcion</option>                
                        <?php 
                        include '../login/conexion.php';  
                        $sql="select * from preguntas";
                        $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                        $numRegistros=mysql_num_rows($consulta);
                        if($numRegistros>0) {
                            while($resultado=mysql_fetch_array($consulta)){
                            ?>
                        <option value="<?=$resultado[0]?>"><?=$resultado[1]?></option>
                            <?php }}?>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Respuesta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="respuesta_txt"  maxlength="50" type="text"  autocomplete="off" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Respuesta" data-validate-hint="Llene el campo de respuesta(solo letras)">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Tipo</label>
                <br>
                <div class="input-control select" style="width:100%;">
                    <select  name="tipo_sl" style="padding-left: 30px;" data-validate-func="required" data-validate-hint="Seleccione una opcion">
                        <option value="">Seleccione una opción</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                        <option value="Cliente">Cliente</option>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
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
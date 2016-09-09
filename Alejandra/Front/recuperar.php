<?php 
include '../login/login.php';
session_start();
if(verificar_usuario()){
    include '../login/tiempo.php';
}
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Recuperar contraseña</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'menu.php';
    if(isset($_POST['modificar_btn'])){
            include '../login/conexion.php';
            $consulta="update usuario set contrasena='".  md5($_POST['contrasenia_txt'])."' where usuario='".$_POST['usuario']."'  and usuario_info.pregunta=preguntas.id";
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
                        }
        ?>
    
    <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" autocomplete="off" maxlength="40" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="comprobar_btn" class="button success block-shadow-success text-shadow"> Comprobar</button>
            </div>
        </form>
    </div>
    <?php
        
    }
    if(isset($_POST['enviar_btn'])){//cuando ya se confirmo el correo y la respuesta
        $r1=$_POST['resp_txt'];
        $r2=md5($_POST['respuesta_txt']);
        $e1=md5($_POST['email_txt']);
        $e2=$_POST['email_txt2'];
        if(strcmp($r1, $r2)==0){
            if(strcmp($e1, $e2)==0){
                ?>
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
    <div style="padding: 8% 8% 15% 8%;" >
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <div style="padding: 1% 30% 1% 30%;">
            <input type="hidden" name="usuario" value="<?=$_POST['usuario_txt']?>">
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
                    <input name="contrasenia_txt2" maxlength="10" id="Pass2" onkeyup="myFunction()" type="password" data-validate-func="pattern" data-validate-arg="" placeholder="Contraseña" data-validate-hint="Las contraseñas no coinciden" maxlength="10">
                    <span class="input-state-error mif-warning"></span>
                </div>
            </div>
        <div style="padding: 1% 30% 1% 30%;">
                <button name="modificar_btn" class="button fg-white bg-darkBlue text-shadow"> Modificar contraseña</button>
        </div>
        </form>
    </div>
            <?php
            }else{
                ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "El email ingresado no coincide con el del usuario a recuperar"});
                }, 150);
            });
    </script>
    <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario por recuperar</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario" value="<?=$_POST['usuario_txt']?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div  style="padding: 1% 30% 1% 30%;">                
                <label> Email del usuario</label>
                <br>
                <div  style="width: 100%;" class="input-control text" data-role="input">
                    <input name="email_txt" autocomplete="off" maxlength="100" type="text" data-validate-func="email" placeholder="Email enlazado con usuario" data-validate-hint="Llene el campo con un email valido">
                    <input name="email_txt2" type='hidden' value="<?=$_POST['email_txt2']//email encriptado?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 2% 30% 1% 30%;">
                <label> Pregunta de seguridad</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="pregunta_txt" type="text" data-validate-func="required" value="<?=$_POST['pregunta_txt']?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Respuesta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="respuesta_txt" autocomplete="off" type="text" maxlength="50" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Respuesta" data-validate-hint="Llene el campo de respuesta(solo letras)">
                    <input name="resp_txt" type='hidden' value="<?=$_POST['resp_txt']//respuesta encriptada?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="enviar_btn" class="button success block-shadow-success text-shadow"> Recuperar</button>
            </div>
        </form>
    </div>
    <?php
            }
        }else{
          ?>  
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "La respuesta a la pregunta de seguridad es incorrecta"});
                }, 150);
            });
    </script>
    <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario por recuperar</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario" value="<?=$_POST['usuario_txt']?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div  style="padding: 1% 30% 1% 30%;">                
                <label> Email del usuario</label>
                <br>
                <div  style="width: 100%;" class="input-control text" data-role="input">
                    <input name="email_txt" autocomplete="off" maxlength="100" type="text" data-validate-func="email" placeholder="Email enlazado con usuario" data-validate-hint="Llene el campo con un email valido">
                    <input name="email_txt2" type='hidden' value="<?=$_POST['email_txt2']//email encriptado?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 2% 30% 1% 30%;">
                <label> Pregunta de seguridad</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="pregunta_txt" type="text" data-validate-func="required" value="<?=$_POST['pregunta_txt']?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Respuesta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="respuesta_txt" autocomplete="off" type="text" maxlength="50" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Respuesta" data-validate-hint="Llene el campo de respuesta(solo letras)">
                    <input name="resp_txt" type='hidden' value="<?=$_POST['resp_txt']//respuesta encriptada?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="enviar_btn" class="button success block-shadow-success text-shadow"> Recuperar</button>
            </div>
        </form>
    </div>
          <?php  
        }
    }
    if(isset($_POST['comprobar_btn'])){
    $usuario = isset($_POST['usuario_txt']) ? $_POST['usuario_txt'] :null;
    include '../login/conexion.php';
        $sql="select preguntas.pregunta,usuario_info.respuesta,usuario_info.correo from usuario_info,preguntas where usuario_info.usuario='".$usuario."'";
        $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
        $resultado=mysql_fetch_array($consulta);
        $numRegistros=mysql_num_rows($consulta);
        if($numRegistros==0) {
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "No se encontro ningun registro vinculado a ese usuario"});
                }, 150);
            });
    </script>
           <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt"  autocomplete="off" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="comprobar_btn" class="button success block-shadow-success text-shadow"> Comprobar</button>
            </div>
        </form>
    </div> 
    <?php
        }else if($numRegistros==1){
            ?>
    <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario por recuperar</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario" value="<?=$usuario?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div  style="padding: 1% 30% 1% 30%;">                
                <label> Email del usuario</label>
                <br>
                <div  style="width: 100%;" class="input-control text" data-role="input">
                    <input name="email_txt" autocomplete="off" maxlength="100" type="text" data-validate-func="email" placeholder="Email enlazado con usuario" data-validate-hint="Llene el campo con un email valido">
                    <input name="email_txt2" type='hidden' value="<?=md5($resultado[2])//email encriptado?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 2% 30% 1% 30%;">
                <label> Pregunta de seguridad</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="pregunta_txt" type="text" data-validate-func="required" value="<?=$resultado[0]?>" readonly="">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label> Respuesta</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input name="respuesta_txt" autocomplete="off" type="text" maxlength="50" data-validate-func="pattern" data-validate-arg="^([a-zA-Z0-9 ,.ñ])+$" placeholder="Respuesta" data-validate-hint="Llene el campo de respuesta(solo letras)">
                    <input name="resp_txt" type='hidden' value="<?=md5($resultado[1])//respuesta encriptada?>">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="enviar_btn" class="button success block-shadow-success text-shadow"> Recuperar</button>
            </div>
        </form>
    </div>
    <?php
        }
    }
    if(!($_POST)){
     ?>   
    
    <div style="padding: 8% 8% 15% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-lock"></span> Recuperar contraseña</h3>
        </center>
        <form action="recuperar.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 2% 30% 1% 30%;">
                <label> Usuario</label>
                <br>
                <div style="width: 100%;" autocomplete="off" class="input-control text" data-role="input" >
                    <input name="usuario_txt" autocomplete="off" maxlength="40" type="text" data-validate-func="pattern" data-validate-arg="^([A-Za-z0-9])+$" placeholder="Usuario" data-validate-hint="Llene el campo usuario">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button name="comprobar_btn" class="button success block-shadow-success text-shadow"> Comprobar</button>
            </div>
        </form>
    </div>
    <?php
            }
    ?>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
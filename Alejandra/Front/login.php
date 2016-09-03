<?php 
session_start();
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Iniciar Sesión</title>
</head>
<body style="background-color: #fffff9;" id="cuerpo">
    
    <?php
    include 'menu.php';
    if(verificar_usuario()){
        header("Location: index.php");
    }
    
    $url= $_SERVER["REQUEST_URI"];
    $cont=0;
    $user="";
    for($i=0;$i<strlen($url);$i++){ 
    if($url[$i]=='?'){
        $cont++;
        $var="";
    }
    if($cont==1 && $url[$i]!='?'){
            $user=$user.$url[$i];
        }
    if($cont>1 && $url[$i]!='?'){
            $var=$var.$url[$i];
        }
    }
    if(!empty($var)){
        $var=intval(base64_decode($var));
    }else {
        $var=-1;
    }
    $user=base64_decode($user);
    if(0==$var){
    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Usuario o contraseña incorrectas"});
                }, 150);
            });
    </script>
    <?php
    }
    if(2==$var){
    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Se cerro la cuenta por inactividad"});
                }, 150);
            });
    </script>
    <?php
    }
    ?>
    
    <div style="padding: 8% 20% 8% 20%;margin: 20px 0px 10px 0px;" >
        <div class="login-form padding20" style="margin: 10px;-webkit-box-shadow: -1px 0px 25px -5px rgba(89,87,89,1);
        -moz-box-shadow: -1px 0px 25px -5px rgba(89,87,89,1);
        box-shadow: -1px 0px 25px -5px rgba(89,87,89,1);">
        <form action="../login/login.php" method="post" style="padding: 1% 12% 10% 12%;" data-role="validator" data-hide-error="5000" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" onsubmit="false">
            <h2 class="text-light">Iniciar sesión</h2>
            <hr class="thin"/>
            <br />
            <div style="padding:2% 10% 2% 10%;">
                <div class="input-control modern text iconic" data-role="input" style="width: 100%;">
                <input name="user_login" type="text" data-validate-func="required" data-validate-hint="Llene el campo usuario" maxlength="40" <?php if($var==0){?> value="<?=$user?>" <?php } ?> >
                <span class="label">Usuario</span>
                <span class="informer">Ingrese su usuario</span>
                <span class="placeholder">Usuario</span>
                <span class="icon mif-user"></span>
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
            </div>                
            </div>
            
            <div style="padding:2% 10% 2% 10%;">
            <div class="input-control modern password iconic" data-role="input" style="width: 100%;">
                <input name="user_password" type="password" data-validate-func="required" data-validate-hint="Llene el campo contraseña" maxlength="40">
                <span class="label">Contraseña</span>
                <span class="informer">Ingrese su contraseña</span>
                <span class="placeholder">Contraseña</span>
                <span class="icon mif-lock"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
            </div>
            </div>
            <div class="form-actions"  style="padding:2% 10% 2% 6%;">
                <button name="login" class="button bg-darkBlue fg-white"><span style="padding-bottom: 4px;" class="mif-switch"></span> Iniciar sesión</button>
                <div name="login" class="button link">Registrarme</div>
            </div>
        </form>
        </div>
    </div>
    
    <?php
    include 'footer.php';
    ?>
</body>
</html>
<?php 
session_start();
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Contacto</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 1% 8%;" >
        <div class="bg-grayLighter">
            <center>
                <h3 class="bg-darkGreen fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-lamp" ></span> Contacto</h3>
            </center>
            <form data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding: 1% 30% 1% 30%;">
                <label><span class="mif-user" style="padding-bottom: 5px;"></span> Nombre</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input type="text" data-validate-func="required" placeholder="Nombre" data-validate-hint="Llene el campo">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div  style="padding: 1% 30% 1% 30%;">                
                <label><span class="mif-mail" style="padding-bottom: 5px;"></span> Email</label>
                <br>
                <div  style="width: 100%;" class="input-control text" data-role="input">
                    <input type="text" data-validate-func="email" placeholder="Su email" data-validate-hint="Llene el campo con un email valido">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label><span class="mif-pencil" style="padding-bottom: 5px;"></span> Asunto</label>
                <br>
                <div style="width: 100%;" class="input-control text" data-role="input" >
                    <input type="text" data-validate-func="required" placeholder="Asunto" data-validate-hint="Llene el campo">
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <label><span class="mif-mail-read" style="padding-bottom: 5px;"></span> Mensaje</label>
                <br>
                <div style="width: 100%;" class="input-control textarea" data-role="input" >
                    <textarea style="resize:none;" data-validate-func="required" placeholder="Mensaje" data-validate-hint="Llene el campo"></textarea>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>
            </div>
            <div style="padding: 1% 30% 1% 30%;">
                <button class="button success block-shadow-success text-shadow"><span class="mif-checkmark" style="padding-bottom: 5px;"></span> Enviar</button>
            </div>
        </form>
        </div>
        </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
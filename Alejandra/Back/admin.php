<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../Front/login.php");
}
include '../login/tiempo.php'; 
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Administrador</title>
</head>
<body class="bg-grayLighter">
    <div style="overflow: hidden;">
       <?php
       include 'menu.php';
       ?>
        <div class="bg-grayLighter" style="margin: 0px;">
                    <center>
                        <h3 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-wrench" ></span> Parte administrativa</h3>
                    </center>
        </div>
        <div style="padding: 20px;">
            <div class="bg-grayLighter" style="overflow: hidden;">
                <div class="place-right" style="width: 100%;padding-bottom: 2%;">
                    <div style="padding: 1% 2% 0 2%;line-height: 18px;">
                        <h2>Recomendaciones para tu día</h2>
                        <p class="align-justify" style="margin: 0;padding: 0;">
                Una actitud de vanguardia reflejada en cada detalle. Aulas de diseño provistas con el software y el hardware de última generación. En Trazos encontrarás lo más puntero en tecnología audiovisual, así como un plató para fotografía y cine digital. Ponemos a tu disposición toda la potencia del medio digital para que lo único que necesites sea una gran idea
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
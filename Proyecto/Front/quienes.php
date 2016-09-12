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
    <title>Que ofrecemos</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 1% 8%;" >
        <div class="bg-grayLighter">
            <center>
                <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-cog" ></span> Trazos Digitales - Servicios</h3>
            </center>
            <p style="padding: 0px 2% 1% 2%;">
                Estamos comprometidos a ofrecer siempre lo mejor a buen precio,  calidad, rapidez, precios competitivos y atención personalizada, además brindarles  asesoría en cuanto a lo que usted necesita. Sabemos que el mercado demanda de muchos productos innovadores, por lo que nosotros nos sujetamos a esas demandas, ofreciéndole herramientas publicitarias  para promover su empresa o institución.
            </p>
        </div>
         <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from servicios";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                                ?>
            <div class="grid" style="margin-top: 5%;">
            <?php
                                if($numRegistros<3){
                            echo  '<div class="row cells'.$numRegistros.'">';       
                                }else{
                            echo  '<div class="row cells3">';
                                }
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                    <div class="cell align-center padding10">
                        <div>
                            <span class="<?=$row[3]?> bg-darkOrange fg-white" style="padding:10%;font-size: 120px;border-radius: 50%;"></span>
                        </div>
                        <h5><?=$row[1]?></h5>
                        <p class="align-justify">
                            <?=$row[2]?>
                        </p>
                    </div>
                            <?php }
                            echo "</div>";
                            ?>
        </div>
            <?php
                            } 
                            ?>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
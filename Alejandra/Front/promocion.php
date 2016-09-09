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
    <title>Promociones</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 1% 8%;" >
        <center>
            <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span class="icon mif-dollars"></span> Promociones actuales</h3>
            </center>
    
    <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from promociones where vigencia>='".date("Y-m-d")."'";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros>0) {
                                ?>
                            <div class="grid">
                            <?php
                                if($numRegistros<3){
                            echo  '<div class="row cells'.$numRegistros.'">';       
                                }else{
                            echo  '<div class="row cells3">';
                                }
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                
                    <div class="cell align-center padding10">
                        <div class="image-container">
                            <div class="frame"><img src="<?=$row[3]?>"></div>
                            <div class="image-overlay op-green">
                                <h2><?=$row[1]?></h2>
                                <p>
                                <?=$row[2]?>
                                </p>
                            </div>
                        </div>
                    </div>
                            <?php }
                            echo "</div>";
                            ?>
                    </div>
            <?php
                            }else{ ?>
        <h4 style="padding: 5%;">Por el momento no contamos con ninguna promcion disponible, mantente pendiente para futuras promociones.</h4> 
        <img src="../img/recursos/aviso.jpg">
                        <?php
                            } 
                            ?>
        </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
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
    <title>Inicio</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'menu.php';
    ?>
    
    <div style="padding: 5% 8% 1% 8%;" >
            <?php 
            if(verificar_usuario()&&$_SESSION['tipo']==3){
                ?>
        
             <?php   
            }else{
            ?>
            <center>
                <h3 class="bg-grayLighter fg-black padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><img src="../img/logo/logo.png" style="width: 20%;"> Trazos Digitales - Bienvenido</h3>
            </center>
            <div class="bg-grayLighter" style="overflow: hidden;">
                <div class="carousel place-left" data-role="carousel" data-height="380px" data-width="100%" data-controls="false" data-period="3000">
                    <?php
                    $path='../img/slide/';
                    $dir = opendir($path);
                    $files = array();
                    while ($current = readdir($dir)){
                        if( $current != "." && $current != "..") {
                            if(is_dir($path.$current)) {
                                showFiles($path.$current.'/');
                            }
                            else {
                                $files[] = $current;
                            }
                        }
                    }
                    if(count( $files )>0){
                    for($i=0; $i<count( $files ); $i++){
                        ?>
                   <     <div class="slide">
                        <img src="../img/slide/<?=$files[$i]?>" data-role="fitImage" data-format="fill">
                        </div>
                    <?php
                    }
                    }else{
                    ?>
                    <div class="slide">
                        <img src="../img/aux_slide/img_slide_1.png" data-role="fitImage" data-format="fill">
                    </div>
                   <div class="slide">
                        <img src="../img/aux_slide/img_slide_2.png" data-role="fitImage" data-format="fill">
                    </div>
                   <div class="slide">
                        <img src="../img/aux_slide/img_slide_3.png" data-role="fitImage" data-format="fill">
                    </div>
                        <?php } ?>
                </div>
                <div class="place-right" style="width: 100%;padding-bottom: 2%;">
                    <div style="padding: 1% 2% 0 2%;line-height: 18px;">
                        <h2>EL EQUIPAMIENTO MÁS COMPLETO</h2>
                        <p class="align-justify" style="margin: 0;padding: 0;">
                Estamos comprometidos a ofrecer siempre lo mejor a buen precio,  calidad, rapidez, precios competitivos y atención personalizada, además brindarles  asesoría en cuanto a lo que usted necesita. Sabemos que el mercado demanda de muchos productos innovadores, por lo que nosotros nos sujetamos a esas demandas, ofreciéndole herramientas publicitarias  para promover su empresa o institución.
                        </p>
                    </div>
                </div>
            </div>
                <?php 
                            include '../login/conexion.php'; 
                            $sql="select * from servicios limit 3";
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
            <div class="align-center">
                <a href="quienes.php" class="button bg-darkOrange fg-white"><span class="icon mif-info" style="padding-bottom: 2px;"></span> Ver mas...</a>
            </div>
        </div>
            <?php
            }} ?>
            
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
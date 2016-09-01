<?php 
session_start();
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
        <div>
            <center>
                <h3 class="bg-lightOlive fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"> Trazos Digitales - Bienvenido</h3>
            </center>
            <div class="bg-grayLighter" style="overflow: hidden;">
                <div class="carousel place-left" data-role="carousel" data-height="380px" data-width="100%" data-controls="false" data-period="3000">
                    <?php
                    $path='../img/slide/.';
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
        </div>
        <div class="grid" style="margin-top: 5%;">
                <div class="row cells3">
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-users bg-darkOrange fg-white" style="padding:10%;font-size: 120px;border-radius: 50%;"></span>
                        </div>
                        <h5>Integridad</h5>
                        <p class="align-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis ex ut libero maximus facilisis. Vestibulum fringilla elit fringilla, euismod turpis luctus, viverra erat. Quisque finibus non justo in placerat. Mauris vehicula interdum metus a auctor. Aliquam egestas non felis porttitor rhoncus. Vestibulum non semper eros, id tincidunt ipsum. Fusce rhoncus pharetra lorem. Nullam dignissim porta augue quis consequat. Morbi euismod at lectus vel luctus. Mauris finibus sem eget mi rhoncus, a imperdiet nunc feugiat. Proin nec molestie ligula. Duis eu pulvinar augue. Vivamus neque nisl, aliquam eu dolor at, lacinia accumsan arcu. Fusce condimentum erat eget leo faucibus ultrices.
                        </p>
                    </div>
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-broadcast bg-darkOrange fg-white" style="padding:10%;font-size: 120px;border-radius: 50%;"></span>
                        </div>
                        <h5>Comunicación</h5>
                        <p class="align-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis ex ut libero maximus facilisis. Vestibulum fringilla elit fringilla, euismod turpis luctus, viverra erat. Quisque finibus non justo in placerat. Mauris vehicula interdum metus a auctor. Aliquam egestas non felis porttitor rhoncus. Vestibulum non semper eros, id tincidunt ipsum. Fusce rhoncus pharetra lorem. Nullam dignissim porta augue quis consequat. Morbi euismod at lectus vel luctus. Mauris finibus sem eget mi rhoncus, a imperdiet nunc feugiat. Proin nec molestie ligula. Duis eu pulvinar augue. Vivamus neque nisl, aliquam eu dolor at, lacinia accumsan arcu. Fusce condimentum erat eget leo faucibus ultrices.
                        </p>
                    </div>
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-security bg-darkOrange fg-white" style="padding:10%;font-size: 120px;border-radius: 50%;"></span>
                        </div>
                        <h5>Disciplina</h5>
                        <p class="align-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis ex ut libero maximus facilisis. Vestibulum fringilla elit fringilla, euismod turpis luctus, viverra erat. Quisque finibus non justo in placerat. Mauris vehicula interdum metus a auctor. Aliquam egestas non felis porttitor rhoncus. Vestibulum non semper eros, id tincidunt ipsum. Fusce rhoncus pharetra lorem. Nullam dignissim porta augue quis consequat. Morbi euismod at lectus vel luctus. Mauris finibus sem eget mi rhoncus, a imperdiet nunc feugiat. Proin nec molestie ligula. Duis eu pulvinar augue. Vivamus neque nisl, aliquam eu dolor at, lacinia accumsan arcu. Fusce condimentum erat eget leo faucibus ultrices.
                        </p>
                    </div>
                </div>
            <div class="align-center">
                <a href="" class="button bg-darkOrange fg-white"><span class="icon mif-info" style="padding-bottom: 2px;"></span> Ver mas...</a>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
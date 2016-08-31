<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../Front/login.php");
}
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Administrador</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'nav.php';
    ?>
    
    <div style="padding: 4% 0% 0% 0%;" >
        <div  style="position: relative;">
        <?php
       include 'menu.php';
       ?>
        </div>
        <div class="bg-grayLighter" style="margin: 0px;">
                    <center>
                        <h3 class="bg-darkGray fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-folder" ></span> Parte administrativa</h3>
                    </center>
        </div>
        <div class="grid" style="margin-top: 5%;position: static" >
                <div class="row cells4">
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-users bg-darkOrange fg-white" style="padding:10%;font-size: 100px;border-radius: 50%;"></span>
                        </div>
                        <h5>Integridad</h5>
                        <p class="align-justify">
                            Posee una sólida y definida identidad personal: es una persona madura, conciente de su dignidad, del valor y responsabilidad inherentes a su vida, a su naturaleza racional, libre y trascendente.
                            Tiene un auto concepto equilibrado de sí mismo en todas sus dimensiones: racional, psicológica y emocional; es conciente y de sus limitaciones. Mantiene una visión positiva y optimista de sí mismo, de las demás personas y de la historia.
                            Manifiesta apertura de los valores y posee una conciencia ética que le orienta y posibilita la formulación de un proyecto de vida, personal profesional y social.
                        </p>
                    </div>
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-broadcast bg-darkOrange fg-white" style="padding:10%;font-size: 100px;border-radius: 50%;"></span>
                        </div>
                        <h5>Comunicación</h5>
                        <p class="align-justify">
                            Manifiesta apertura ala verdad científica, filosófica y religiosa.
                            Posee una visión global del mundo y de la sociedad en que vive.
                            Es capaz de ampliar y gestionar cooperativamente sus procesos de aprendizaje y de seguir formándose constantemente durante su vida.
                            Es crítico, creativo y flexible en el desarrollo de nuevas respuestas a los desafíos que le plantea el ambiente natural y humano.
                        </p>
                    </div>
                    <div class="cell align-center padding10">
                        <div>
                            <span class="mif-security bg-darkOrange fg-white" style="padding:10%;font-size: 100px;border-radius: 50%;"></span>
                        </div>
                        <h5>Disciplina</h5>
                        <p class="align-justify">
                            Está profesional o técnicamente capacitado en su campo de formación. Posee habilidades básicas especiales y técnicas.
                            Es capaz de integrar conocimientos teórico y habilidades prácticas, de aplicar la metodología investigativa a la búsqueda de soluciones a los problemas en las áreas de su desempeño laboral y profesional.
                            Evidencia un espíritu emprendedor, manifiesta capacidad de iniciativa, de planificación y de una gestión de calidad de los procesos humanos y productos. Posee un elevado sentido de trabajo y de la responsabilidad social que de él deriva.
                        </p>
                    </div>
                </div>
        </div>
   
        </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
<?php
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    
    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >=600) {
     //si pasaron 10 minutos o más
      session_destroy(); // destruyo la sesión
      header("Location: ../Front/login.php??".base64_encode("2")); //envío al usuario a la pag. de autenticación
      //sino, actualizo la fecha de la sesión
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
    }
?>
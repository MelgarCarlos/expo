<?php
function encriptar($cadena){
                        $key='expo_2016?_';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
                        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
                        return $encrypted; //Devuelve el string encriptado

                    }
                    ?>
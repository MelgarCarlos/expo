<?php 
include '../login/login.php';
session_start();
if(!verificar_usuario()){
    header("location: ../index.php");
}
?>
<!doctype html>
<html>
<head>
    <?php
    include 'librerias.php';
    ?>
    <title>Agregar usuario</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
    <table class="dataTable border bordered hovered cell-hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Prueba</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Mi primera prueba</td>
                    <td>Resultado de prueba uno</td>
                    <td>Tercera columna primera prueba</td>
                </tr>
                <tr>
                    <td>Mi segunda prueba</td>
                    <td>Resultado de prueba dos</td>
                    <td>Tercera columna segunda prueba</td>
                </tr>
                <tr>
                    <td>Mi tercera prueba</td>
                    <td>Resultado de prueba tres</td>
                    <td>Tercera columna tercera prueba</td>
                </tr>
                </tbody>
            </table>
        </div>
</body>
</html>
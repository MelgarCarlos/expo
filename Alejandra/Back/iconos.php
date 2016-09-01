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
    <title>Iconos</title>
</head>
<body style="background-color: #fffff9;">¿
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 5% 5% 5% 5%;">
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-teal fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-list2" ></span> Listado de iconos</h4>
        </center>
        </div>
    <table class="dataTable border bordered hovered" data-role="datatable" data-searching="true">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Icono</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                                $db = mysql_connect("localhost", "root", "") or die ("No conecto con el servidor");
                                    mysql_select_db("expo") or die ("No se pudo seleccionar la base de datos");
                                    $sql="select * from iconos";
                                    $consulta=mysql_query($sql,$db) or die ("error ".mysql_error());
                                    $numRegistros=mysql_num_rows($consulta);
                                    if($numRegistros>0) {
                            while($row=mysql_fetch_array($consulta)){
                            ?>
                <tr>
                    <td><?=$row[0]?></td>
                    <td><span style="padding-bottom: 5px;" class="<?=$row[1]?> mif-2x" ></span></td>
                </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
</body>
</html>
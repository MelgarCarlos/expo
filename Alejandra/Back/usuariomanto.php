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
    <title>Usuario</title>
</head>
<body style="background-color: #fffff9;">
    
    <?php
    include 'nav.php';
    ?>
    <div style="padding: 4% 0% 0% 0%;" >
        <div class="bg-white" style="overflow: hidden;">
            <?php
    include 'menutablas.php';
    ?>
    
    <table style="width: 60%;margin: 0px;padding: 0px;">
        <tr>
            <td style="width: 50%;padding-top:5px;">
                <a href="usuarioagregar.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Agregar usuario</h5>
                </a>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td style="width: 50%;padding-top:5px;">
                <a href="usuariomanto.php">
                <h5 class="align-center fg-blue" style="text-decoration: underline;padding-top: 10px;border-style: solid;border-width: 2px 1px 0px 1px;border-color: #990000;">Mantenimientos</h5>
                </a>
            </td>
        </tr>
    </table>
        <div class="bg-grayLighter" style="margin: 0px;">
        <center>
            <h4 class="bg-darkGray fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Mantenimiento a usuarios</h4>
        </center>
        </div>
        <form action="usuariomanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
            <div style="padding:0% 10% 2% 10%;">
                <div class="input-control modern text iconic" data-role="input" style="width: 80%;">
                    <input name="busqueda" type="text"  maxlength="40">
                    <span class="label">Busqueda</span>
                    <span class="informer">Ingrese su busqueda</span>
                    <span class="placeholder">Busqueda</span>
                    <span class="icon mif-search"></span>
                    <span class="input-state-error mif-warning"></span>
                    <span class="input-state-success mif-checkmark"></span>
                </div>                
            </div>
            <label style="padding: 1%;">Filtrar por:</label>
            <label class="switch">
                <span class="caption" style="padding-right: 5px;">Usuario</span>
                <input name="usuario_filtro" type="checkbox">
                <span class="check"></span>
            </label>
            <label class="switch">
                <span class="caption" style="padding-right: 5px;">Nombre</span>
                <input name="nombre_filtro" type="checkbox">
                <span class="check"></span>
            </label>
            <label style="padding: 1%;">Tipo</label>
                <div class="input-control select" style="width:20%;">
                    <select  name="tipo_filtro" style="padding-left: 25px;" data-validate-hint="Seleccione una opcion">
                        <option value="">Seleccione una opción</option>
                        <option value="1">Administrador</option>
                        <option value="2">Profesor</option>
                        <option value="3">Estudiante</option>
                    </select>
                    <span class="mif-arrow-down prepend-icon"></span>
                </div>
            <input id="valor" name="valor" type='hidden' value="0">
                <button name="enviar_btn" onclick="funcion()" class="button bg-darkBlue fg-white text-shadow"><span class="mif-search" style="padding-bottom: 5px;"></span> Buscar</button>
                <button name="enviar_btn2" onclick="funcion2()" class="button bg-darkGreen fg-white text-shadow"><span class="mif-stack" style="padding-bottom: 5px;"></span> Mostrar todo</button>
                <script>
                    function funcion2(){
                    document.getElementById("valor").value=1;
                    }
                    function funcion(){
                    document.getElementById("valor").value=2;
                    }
                </script>
        </form>
            <table class="table border bordered hovered cell-hovered" style="width: 70%;">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <?php if (isset($_POST["enviar_btn"])||isset($_POST["enviar_btn2"])){ 
                    $db = mysql_connect("localhost", "root", "") or die ("No conecto con el servidor");
                    mysql_select_db("sistema_conductual") or die ("No se pudo seleccionar la base de datos");
                    if($_POST['valor']==1){
                    $sql="SELECT usuario,nombre,tipo FROM usuario ";
		    $consulta=mysql_query($sql,$db) or die ("error ".mysql_error());
		    $numRegistros=mysql_num_rows($consulta);
                    if($numRegistros==0) {
                        ?>
                <tbody>
                <tr>
                    <td>No</td>
                    <td>hay</td>
                    <td>resultados</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                </tbody>
                    <?php
		    }else if($numRegistros>=1){
                        $cont=0;
                        while($resultado=mysql_fetch_array($consulta)){
                            $cont++;
                            ?>
                <tr>
                    <td><?=$resultado[0]?><input id="usuario_<?=$cont?>" type="hidden" value="<?=$resultado[0]?>"></td>
                    <td><?=$resultado[1]?><input id="usuario2_<?=$cont?>" type="hidden" value="<?=$resultado[1]?>"></td>
                    <td><?php if($resultado[2]==1){echo "Administrador";}else if($resultado[2]==2){echo "Profesor";}else if($resultado[2]==3){echo "Estudiante";} ?></td>
                    <td><button name="enviar_btn_modificar" onclick="showDialog('modificar1','usuario_<?=$cont?>','usuario2_<?=$cont?>')" class="button bg-darkBlue fg-white text-shadow"><span class="mif-pencil" style="padding-bottom: 5px;"></span> Modificar</button></td>
                    <td><button name="enviar_btn_eliminar" onclick="showDialog2('eliminar1','usuario_<?=$cont?>')" class="button bg-red fg-white text-shadow"><span class="mif-cross" style="padding-bottom: 5px;"></span> Eliminar</button></td>
                </tr>
                            
                            <?php
                        }
                    }
                    }else if($_POST['valor']==2){
                    $busqueda= isset($_POST['busqueda']) ? $_POST['busqueda'] :null;
                    $filtro1 = isset($_POST['usuario_filtro']) ? 1 :0;
                    $filtro2 = isset($_POST['nombre_filtro']) ? 1:0;
                    $filtro3 = isset($_POST['tipo_filtro']) ? $_POST['tipo_filtro']:0;
                    $sql="SELECT usuario,nombre,tipo FROM usuario u";
                    if($filtro1==1){
                        $sql=$sql." where (";
                        $sql=$sql." u.usuario like '%".$busqueda."%' ";
                        if($filtro2==1){
                        $sql=$sql." or u.nombre like '%".$busqueda."%' ";
                        if($filtro3!=0){
                            $sql=$sql."and u.tipo=".$_POST['tipo_filtro'];
                        }
                        }else{
                            if($filtro3!=0){
                            $sql=$sql."and u.tipo=".$_POST['tipo_filtro'];
                            }
                        }
                        $sql=$sql." )";
                    }else{
                        $sql=$sql." where (";
                        if($filtro2==1){
                        $sql=$sql." u.nombre like '%".$busqueda."%' ";
                        if($filtro3!=0){
                            $sql=$sql."and u.tipo=".$_POST['tipo_filtro'];
                        }
                        }else{
                            if($filtro3!=0){
                            $sql=$sql." u.tipo=".$_POST['tipo_filtro'];
                            }
                        }
                        $sql=$sql." )";
                    }
                    if(strlen($sql)<52){
                        $sql="SELECT usuario,nombre,tipo FROM usuario ";
                    }
                    $consulta=mysql_query($sql,$db) or die ("error ".mysql_error());
		    $numRegistros=mysql_num_rows($consulta);
                    if($numRegistros==0) {
                        ?>
                <tbody>
                <tr>
                    <td>No</td>
                    <td>hay</td>
                    <td>resultados</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                </tbody>
                    <?php
		    }else if($numRegistros>=1){
                        $cont=0;
                        while($resultado=mysql_fetch_array($consulta)){
                        $cont++;
                            ?>
                <tr>
                    <td><?=$resultado[0]?><input id="usuario_<?=$cont?>" type="hidden" value="<?=$resultado[0]?>"></td>
                    <td><?=$resultado[1]?><input id="usuario2_<?=$cont?>" type="hidden" value="<?=$resultado[1]?>"></td>
                    <td><?php if($resultado[2]==1){echo "Administrador";}else if($resultado[2]==2){echo "Profesor";}else if($resultado[2]==3){echo "Estudiante";} ?></td>
                    <td><button name="enviar_btn_modificar" onclick="showDialog('modificar1','usuario_<?=$cont?>','usuario2_<?=$cont?>')" class="button bg-darkBlue fg-white text-shadow"><span class="mif-pencil" style="padding-bottom: 5px;"></span> Modificar</button></td>
                    <td><button name="enviar_btn_eliminar" onclick="showDialog2('eliminar1','usuario_<?=$cont?>')" class="button bg-red fg-white text-shadow"><span class="mif-cross" style="padding-bottom: 5px;"></span> Eliminar</button></td>
                </tr>
                    <?php
                    }
                    }
                    }
                    }else{
                    ?>
                <tbody>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                </tbody>
                    <?php } ?>
            </table>
            <script>
            function showDialog(id,valor,valor2){
                var dialog = $("#"+id).data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
                
                document.getElementById('usuario_txt').value=document.getElementById(valor).value;
                document.getElementById('nombreuser_txt').value=document.getElementById(valor2).value;
            }
            function showDialog2(id,valor){
                var dialog = $("#"+id).data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
                
                document.getElementById('usuario_txt2').value=document.getElementById(valor).value;
            }
            </script>
            <div class="align-center" data-role="dialog" id="modificar1" style="padding: 20px 80px 20px 80px;" data-windows-style="true" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true">
                <div class="bg-darkGray" style="margin: 0px;">
                <center>
                    <h4 class="bg-Gray fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Eliminar usuario</h4>
                </center>
                </div>
                <form action="usuariomanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
                <div style="padding: 1% 30% 1% 30%;">
                    <label> Usuario</label>
                    <br>
                    <div style="width: 100%;" class="input-control text" data-role="input" >
                        <input name="usuario_txt" id="usuario_txt" type="text" data-validate-func="required" placeholder="Usuario" data-validate-hint="Llene el campo usuario" readonly="">
                        <span class="input-state-error mif-warning"></span>
                        <span class="input-state-success mif-checkmark"></span>
                    </div>
                </div>
                <div style="padding: 1% 30% 1% 30%;">
                    <label> Nombre</label>
                    <br>
                    <div style="width: 100%;" class="input-control text" data-role="input" >
                        <input name="nombre_txt" id="nombreuser_txt" type="text" data-validate-func="required" placeholder="Nombre" data-validate-hint="Llene el campo nombre" >
                        <span class="input-state-error mif-warning"></span>
                        <span class="input-state-success mif-checkmark"></span>
                    </div>
                </div>  
                <div style="padding: 1% 30% 1% 30%;">
                <label> Tipo</label>
                <br>
                <div class="input-control select" style="width:100%;">
                        <select  name="tipo_sl" style="padding-left: 30px;" data-validate-func="required" data-validate-hint="Seleccione una opcion">
                            <option value="">Seleccione una opción</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                        <span class="mif-arrow-down prepend-icon"></span>
                        <span class="input-state-error mif-warning"></span>
                        <span class="input-state-success mif-checkmark"></span>
                    </div>
                </div>
                <div style="padding: 1% 30% 1% 30%;">
                    <button name="enviar_modificar" class="button bg-darkBlue fg-white text-shadow"><span class="mif-pencil" style="padding-bottom: 5px;"></span> Modificar</button>
                    <div class="button alert text-shadow" onclick="hideMetroDialog('#modificar1')">Cancelar</div>
                </div>
                </form>
            </div>
            <div class="align-center" data-role="dialog" id="eliminar1" style="padding: 20px 80px 20px 80px;" data-windows-style="true" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true">
                <div class="bg-grayLighter" style="margin: 0px;">
                <center>
                    <h4 class="bg-darkGray fg-white padding10" style="margin-bottom: 0px;text-shadow: 0px 0px 4px rgba(150, 150, 150, 1);"><span style="padding-bottom: 5px;" class="mif-users" ></span> Eliminar usuario</h4>
                </center>
                </div>
                <form action="usuariomanto.php" method="post" data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="5000">
                <div style="padding: 1% 30% 1% 30%;">
                    <label> Usuario</label>
                    <br>
                    <div style="width: 100%;" class="input-control text" data-role="input" >
                        <input name="usuario_txt" id="usuario_txt2" type="text" data-validate-func="required" placeholder="Usuario" data-validate-hint="Llene el campo usuario" readonly="">
                        <span class="input-state-error mif-warning"></span>
                        <span class="input-state-success mif-checkmark"></span>
                    </div>
                </div>
                <div style="padding: 1% 30% 1% 30%;">
                    <label>¿Esta seguro de eliminar este usuario?</label>
                </div>
                  
                <div style="padding: 1% 30% 1% 30%;">
                    <button name="enviar_eliminar" class="button alert fg-white text-shadow"><span class="mif-warning" style="padding-bottom: 5px;"></span> Eliminar</button>
                    <div class="button link text-shadow" onclick="hideMetroDialog('#eliminar1')">Cancelar</div>
                </div>
                </form>
            </div>
            
            <?php
            if (isset($_POST["enviar_modificar"]))
	{ 
                $modificaru=false;
		if($_POST["tipo_sl"]=='Administrador')
		{
			$valor=1;
		} else if($_POST["tipo_sl"]=='Profesor')
		{
			$valor=2;
		} else if($_POST["tipo_sl"]=='Estudiante')
		{
			$valor=3;
		}
		$usua=$_POST["usuario_txt"];
		$name=$_POST["nombre_txt"];
		$execute="UPDATE usuario SET nombre='".$name."',tipo=".$valor." WHERE usuario='".$usua."'";
                if(mysql_query($execute,$conexion)){
                    $modificaru=true;
                }
	}
?>
            <?php
    if(isset($_POST["enviar_modificar"])){
        if($modificaru==true){
    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se modifico exitosamente"});
                }, 150);
            });
    </script>
    
    <?php
        }else{
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al modificar"});
                }, 150);
            });
    </script>
            <?php
        }
    }
    ?>
    <?php
            if (isset($_POST["enviar_eliminar"]))
	{ 
                $eliminaru=false;
		$usua=$_POST["usuario_txt"];
		$execute="delete from usuario  WHERE usuario='".$usua."'";
            	if(mysql_query($execute,$conexion)){
                    $eliminaru=true;
                }
	}
?>
            <?php
    if(isset($_POST["enviar_eliminar"])){
        if($eliminaru==true){
    ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'success', caption: 'Mensaje', content: "Se elimino exitosamente"});
                }, 150);
            });
    </script>
    
    <?php
        }else{
            ?>
    <script>
            $(document).ready(function() {
                setTimeout(function(){
                    $.Notify({keepOpen: true, type: 'alert', caption: 'Mensaje', content: "Error al eliminar"});
                }, 150);
            });
    </script>
            <?php
        }
    }
    ?>
    </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
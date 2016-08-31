<?php 
	if($_POST) {
		$usuario = isset($_POST['user_login']) ? $_POST['user_login'] :null;
		$pass= isset($_POST['user_password'])? $_POST['user_password'] :null;
		$db = mysql_connect("localhost", "root", "") or die ("No conecto con el servidor");
		mysql_select_db("expo") or die ("No se pudo seleccionar la base de datos");
		if(isset($_POST['user_login']) && isset($_POST['user_password'])) {
		    $sql="SELECT tipo FROM usuario WHERE usuario='".$usuario."' AND contrasena=AES_ENCRYPT('text','".$pass."')";
		    $consulta=mysql_query($sql,$db) or die ("error ".mysql_error());
		    $resultado=mysql_fetch_array($consulta);
		    $numRegistros=mysql_num_rows($consulta);
		    if($numRegistros==0) {
		        header("location: ../Front/login.php?".base64_encode($_POST['user_login'])."?".base64_encode("v=0"));
		    }else if($numRegistros==1){
                        session_start();
                        $_SESSION['rol']=$resultado['tipo'];
		        $_SESSION['user']=$_POST['user_login'];
		        header("location: ../Back/admin.php");
		    }
		    else
		    {
                        $variable=1;
		    	header("location: ../Front/login.php?".base64_encode("v=1"));
		    }
                }
        }
	function verificar_usuario(){
		if(isset($_SESSION['user']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>
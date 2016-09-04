<?php 
	if($_POST) {
		$usuario = isset($_POST['user_login']) ? $_POST['user_login'] :null;
		$pass= isset($_POST['user_password'])? $_POST['user_password'] :null;
		include 'conexion.php';
		if(isset($_POST['user_login']) && isset($_POST['user_password'])) {
		    $sql="SELECT tipo,estado FROM usuario WHERE usuario='".$usuario."' AND contrasena=AES_ENCRYPT('text','".$pass."')";
		    $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
		    $resultado=mysql_fetch_array($consulta);
		    $numRegistros=mysql_num_rows($consulta);
		    if($numRegistros==0) {
		        header("location: ../Front/login.php?".base64_encode($_POST['user_login'])."?".base64_encode("0"));
		    }else if($numRegistros==1){
                        session_start();
                        $_SESSION['tipo']=$resultado['tipo'];
                        $_SESSION['estado']=$resultado['estado'];
		        $_SESSION['user']=$_POST['user_login'];
                        $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
		        header("location: ../Back/admin.php");
		    }
		    else
		    {
                        $variable=1;
		    	header("location: ../Front/login.php?".base64_encode("v=1"));
		    }
                }
        }else{
            $dir="";
            $url=$_SERVER['REQUEST_URI'];
            for ($i = (strlen($url)-9); $i < strlen($url); $i++) {
                $dir=$dir.$url[$i];
            }
            if(!empty($dir)){
                if($dir=="login.php"){
                    header("location: ../Front/");
                }
            }
        }
	function verificar_usuario(){
		if(isset($_SESSION['user']))
		{
                        if($_SESSION['estado']==1){
                        return true;
                        }else{
                        return false;
                        }
		}
		else
		{
			return false;
		}
	}
?>
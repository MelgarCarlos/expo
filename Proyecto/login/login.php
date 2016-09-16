<?php 
	if($_POST) {
		$usuario = isset($_POST['user_login']) ? $_POST['user_login'] :null;
		$pass= isset($_POST['user_password'])? $_POST['user_password'] :null;
		include 'conexion.php';
		if(isset($_POST['user_login']) && isset($_POST['user_password'])) {
                    include '../login/encriptar.php';
		    $sql="SELECT tipo,estado,usuario FROM usuario WHERE usuario='".$usuario."' AND contrasena='".encriptar(md5($pass))."'";
                    $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
		    $resultado=mysql_fetch_array($consulta);
		    $numRegistros=mysql_num_rows($consulta);
		    if($numRegistros==0){
		        header("location: ../Front/login.php?".base64_encode($_POST['user_login'])."?".base64_encode("0"));
		    }else if($numRegistros==1){
                        if(strcmp($usuario, $resultado[2])==0){
                        session_start();
                        if($resultado[1]==0){
                            header("location: ../Front/login.php");
                        }else{
                        $_SESSION['tipo']=$resultado['tipo'];
                        if($_SESSION['tipo']==3){
                            $sql="SELECT `id` FROM `pedido` WHERE `usuario`='".$usuario."' and `estado`=1";
                            $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                            $row=mysql_fetch_array($consulta);
                            $numRegistros=mysql_num_rows($consulta);
                            if($numRegistros==0){
                                    $consulta="INSERT INTO `pedido`(`fecha`, `total`, `estado`, `usuario`) VALUES ((select now()),0,1,'".$usuario."')";
                                    mysql_query($consulta,$conexion);
                                    $sql="SELECT `id` FROM `pedido` WHERE `usuario`='".$usuario."' and `estado`=1";
                                    $consulta=mysql_query($sql,$conexion) or die ("error ".mysql_error());
                                    $row=mysql_fetch_array($consulta);
                                    $_SESSION['carretilla']=$row[0];
                            }
                            else if($numRegistros==1){
                                $_SESSION['carretilla']=$row[0];
                            }
                        }
		        $_SESSION['user']=$_POST['user_login'];
                        $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
                        header("location: ../Back/admin.php");
                        }
                        }else{
                             header("location: ../Front/login.php");
                        }
		    }
		    else
		    {
                        $variable=1;
		    	header("location: ../Front/login.php");
		    }
                }
        }else{
            $dir="";
            $url=$_SERVER['REQUEST_URI'];
            for ($i = (strlen($url)-15); $i < strlen($url); $i++) {
                $dir=$dir.$url[$i];
            }
            if(!empty($dir)){
                if($dir=="login/login.php"){
                    header("location: ../Front/");
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
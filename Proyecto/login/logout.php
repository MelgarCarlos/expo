<?php
        include "login.php";
        session_start();
	if(verificar_usuario())
	{
            if(destruir()){
            header('Location: ../Front/login.php');
            }else{
            header('Location: ../Front/login.php');
            }
	}
	else
	{
		echo "error";
	}
	function destruir(){
		if($_SESSION['user'])
		{
			session_unset();
			session_destroy();
			return true;
		}
		else
		{
			return false;
		}
	}
?>
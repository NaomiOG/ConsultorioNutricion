<?php

include "herramientas.php";
session_start();

$superAdmin=array("administrador@gmail.com","control");

if(in_array($_POST['email'], $superAdmin))
{
	if($_POST['clave']=="1234"){
		$_SESSION['isAdmin']=true;
		header("location: administrador/home.php?E=1");
	}
	else
	{
		header("location: login.php?E=35");
	}
}

else
{
	$row=$objetoBD->saca_tupla("SELECT * FROM usuarios WHERE email='".$_POST['email']."' and contraseña=password('".$_POST['clave']."') limit 1");
			echo $objetoBD->numTuplas;

			if($objetoBD->numTuplas==1){
				$_SESSION['email']=$row->email;
				$_SESSION['id']=$row->id_usuario;
				$_SESSION['rol']=$row->tipo_usuario;
				echo $_SESSION['rol'] ;
				if($_SESSION['rol']==1){
					header("location: empleadas/home.php?E=1");
				}
				else{
					header("location: pacientes/home.php?E=1");
				}
				
			}
			
			else{
				header("location: login.php?E=1");//Llama otro recurso, para que funcione no debe haberse impreso o escrito html antes de el. Colocamos una bandera de error 1 
			}
}
?>
<?php
//1. Registrar en la BD
include "herramientas.php";
          
          $objetoBD->consulta("select * from usuarios where email='".$_POST['email']."';");
          
          if($objetoBD->numTuplas){
            $objetoBD->generarPwd();
            $objetoBD->consulta("update usuarios set contraseña=Password('".$objetoBD->clave."') where email='".$_POST['email']."';");
            header("location: login.php?E=15");
          }
          else{
            header("location: login.php?E=25");
          }
	
//3. Indicar situación o enviar a logueo


?>
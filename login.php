<!DOCTYPE html>
<html>
<head>
	<title>Consultorio de Nutrición</title>
	
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	 <style>
      
      #password{
          background: url("imagenes/iconos.png");
          background-position: -314px -39px;
          cursor:pointer;
          width: 30px;
          height: 20px;
      }
      #correo{
          background: url("imagenes/iconos.png");
          background-position: -69px 0px;
          cursor:pointer;
          width: 29px;
          height: 20px;
      }
      #contenedor{
      	width: 400px;
      	font-family: Century Gothic;
      	text-align: center;
      	background-color: white;
      	margin-top: 100px;
      	opacity: .7;
      	-webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);
		-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);
		box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);



      }
      body {
		background: url(imagenes/fondo_login.jpg) no-repeat center top;
		background-size: cover;
	 }
  </style>
	<script src="jquery-3.5.1.min.js">
  	</script>
  <script type="text/javascript">
  	$(document).ready(function(){
	  	 $("#recuperar").click(function(){
		      		var parametros=$("#formCredenciales").serialize();
		      		console.log("Estos son: "+parametros);
				          $.ajax({
				                type:"POST",
				                method:"POST",
				                url: "recuperar.php", 
				                data: parametros,
				                 success: function(result){
				                 	console.log(result);
				               		$("body").html(result).show();
				                }
				                
			         		});
				        
		  });
  	 });
  </script>
</head>
<body>
	<div style="font-family: Century Gothic; text-align: center; margin-top: 50px; ">
		<h5><b>Dra. Ariana Espinoza Espinoza</b></h5>
		<h6>Médico Cirujano-Nutrición Clínica</h6>	
	</div>
	<img src="imagenes/login.png" width="100px" style="z-index: 1; position: absolute; margin-left: 47%; margin-top: 30px;">
	<div class="container" id="contenedor" >
		<form method="post" action="validar.php" id="formCredenciales">  
			<br><br>
			<h4>Iniciar sesión</h4><br>
		    <div class="form-group" style="display: inline-flex;">
		    
		      <img id="correo" src="imagenes/img_trans.png" style="vertical-align: middle;"/>
		      <input style="width: 300px;" type="email" class="form-control" id="email" name ="email" aria-describedby="emailHelp" placeholder="Enter email">
		    </div><br>
		    <div class="form-group" style="display: inline-flex;">
		      <img id="password" src="imagenes/img_trans.png" style="vertical-align: middle;" />
		      <input style="width: 300px;" type="password" name= "clave" class="form-control" id="clave" placeholder="Password">
		    </div><br>
		    <button type="submit" class="btn btn-primary" width="600px">Ingresar</button><br><br>
		    <input  style="width: 200px; margin-left: 80px;" class="form-control" type="button" id="recuperar" value="Olvidé mi contraseña" /><br><br>
		</form>
	</div>
<?php

session_start();
session_destroy();

  if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {

    case 1:

      echo '<div class="alert alert-dismissible alert-primary" style="margin-left:35.4%; width:400px; font-family:Century Gothic;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>Credenciales incorrectas </strong> 
		</div>';
      break;
    case 15:
    	echo '<div class="alert alert-dismissible alert-primary" style="margin-left:35.4%; width:400px; font-family:Century Gothic;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>Revisa tu correo hemos enviado una nueva clave</strong> 
		</div>';
      break;
    case 25:
    	echo '<div class="alert alert-dismissible alert-primary" style="margin-left:35.4%; width:400px; font-family:Century Gothic;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>No podemos Recuperar la contraseña porque el correo no existe</strong> 
		</div>';
      break;
    case 35:
      echo '<div class="alert alert-dismissible alert-primary" style="margin-left:35.4%; width:400px; font-family:Century Gothic;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>La clave del administrador es incorrecta</strong> 
		</div>';
      break;
    case 45:
      echo '<div class="alert alert-dismissible alert-primary" style="margin-left:35.4%; width:400px; font-family:Century Gothic;">
	  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	  	<strong>Acceso no autorizado</strong> 
		</div>';
      break;

  }
  }
  
?>

</body>
</html>
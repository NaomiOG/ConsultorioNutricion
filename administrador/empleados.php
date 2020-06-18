<!DOCTYPE html>
<html>
<head>

	<title>Empleados</title>

	<script src="../jquery-3.5.1.min.js">
  	</script>
  	<script src="../jquery-confirm.js">
  	</script>
  	<link rel="stylesheet" type="text/css" href="../jquery-confirm.css">
	<style>
				#edit{
					background: url("../imagenes/iconos.png");
					background-position: -95px -80px;
					cursor:pointer;
					width: 30px;
		  			height: 20px;
				}
				#delete{
					background: url("../imagenes/iconos.png");
					background-position: -120px -100px;
					cursor:pointer;
					width: 30px;
		  			height: 20px;
				}
				#add{
					background: url("../imagenes/iconos.png");
					background-position: -387px -20px;
					cursor:pointer;
					width: 30px;
		  			height: 20px;

				}
	</style>
	
	<script type="text/javascript">

      function a_onClick() {
        document.getElementById("nuevo").click();
      }
      function b_onClick() {
		document.getElementById("borrar").click();
      }
      function c_onClick() {
		document.getElementById("editar").click();
      }


      function mostrarNuevo(){	
            $(location).attr('href','empleados.php?E=3');
      }
      function mostrarEditar(id){	
            $(location).attr('href','empleados.php?E=2&id='+id);
      }
      function borrar(id){
     			
		$.confirm({
				title: 'Eliminar elemento',
			content: '¿Está seguro de eliminar el empleados?',
			type: 'blue',
			buttons: {
					confirmar:{
					 btnClass:'btn-blue',
					 action: function () {
					 	$(location).attr('href','empleados.php?E=1&id='+id);
					 	//$.alert("Se ha eliminado el elemento correctamente");		
 					}},
					cancelar:{
					btnClass:'btn-blue',
					action: function () {
					$.alert('Los cambios se han descartado');
					}},        			     
				 }
		});
  	}
      $(document).ready(function(){	

	      	$("#insertar").click(function(){
	      		var parametros=$("#datosEmpleado").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "empleados.php?E=5", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#modificar").click(function(){
	      		var parametros=$("#datosEmpleado").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "empleados.php?E=6", 
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


    <?php
 
include "header.php";	

if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {

    case 1:
    //Elimina un empleado
    	$result="";
	    include 'C:\xampp\htdocs\consultorio\herramientas.php';
	   	$objetoBD->consulta("delete from empleados where id_empleado=".$_GET['id']);
		$objetoBD->consulta("delete from usuarios where tipo_usuario=1 and id_usuario=".$_GET['id']);
		$result.="<script type='text/javascript'>";
    			$result.='window.location="empleados.php?E=4";';
    			$result.="</script>";
    	echo $result;

	break;
	case 2:
	//Actualiza un empleado
	include ("class/classEmpleado.php");
    //muestra el formulario para editar un usuario
    echo $objetoEmpleado->form($_GET['id']);
    break;
    case 3:
    include ("class/classEmpleado.php");
    //muestra el formulario para crear un usuario
    echo $objetoEmpleado->form();
	break;
	case 4:
	
	include ("class/classEmpleado.php");
    //muestra los usuarios que coinciden con el nombre ingresado
    echo $objetoEmpleado->totalEmpleados();
	break;
	case 5:
    include '..\herramientas.php';
    	
    	$result="";
		function validar(){
			if(empty($_POST['nombre'])||empty($_POST['apellidos'])||empty($_POST['email'])||empty($_POST['telefono'])||empty($_POST['clave'])||empty($_POST['sueldo'])){
				return false;
			}
			else{
				return true;
			}
		}
		if(validar()){
			$objetoBD->consulta("select * from usuarios where email='".$_POST['email']."'");
			$resultados=$objetoBD->numTuplas;
			if($resultados==0){
					
				$cad="insert into empleados set nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', telefono=".$_POST['telefono'].", sueldo=".$_POST['sueldo'];
				$objetoBD->consulta($cad);
				$objetoBD->consulta("select id_empleado from empleados order by id_empleado DESC limit 1");
				for ($i=0; $i < $objetoBD->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($objetoBD->bloque);
				}
				$objetoBD->consulta("insert into usuarios set id_usuario='".$tupla[0]."' ,email='".$_POST['email']."',tipo_usuario=1,contraseña=password('".$_POST['clave']."')");
					$result.="<script type='text/javascript'>";
	    			$result.='window.location="empleados.php?E=4";';
	    			$result.="</script>";
	    	}else{
	    		include ("class/classEmpleado.php");
    			echo $objetoEmpleado->form();
				$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
	  				<button type="button" class="close" data-dismiss="alert">&times;</button>
	  				<strong>El correo que ingresaste ya está registrado</strong> 
					</div>';
			

	    		}
		}
		else{
			include ("class/classEmpleado.php");
    		//muestra el formulario para crear un usuario
    		
			echo $objetoEmpleado->form();
			$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos</strong> 
						</div>';
			
		}
		echo $result;
		break;
		case 6:
		//Actualizar un empleado
		$result="";
		include '..\herramientas.php';
    		function validar(){
				if(empty($_POST['nombre'])||empty($_POST['apellidos'])||empty($_POST['email'])||empty($_POST['telefono'])||empty($_POST['sueldo'])){
					return false;
				}
				else{
					return true;
				}
			}
			if(validar()){
			$objetoBD->consulta("select * from usuarios where email='".$_POST['email']."'");
			$resultados=$objetoBD->numTuplas;
				if($resultados<=1){
						
					$clave=$_POST['clave'];
					$cad="update empleados set nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', telefono=".$_POST['telefono'].", sueldo=".$_POST['sueldo']." where id_empleado=".$_POST['id_empleado'];
					$objetoBD->consulta($cad);
					$objetoBD->consulta("update usuarios set email='".$_POST['email']."'".(($clave!="")?", contraseña=password('".$clave."') ":" ")."where tipo_usuario=1 and id_usuario=".$_POST['id_empleado']);
						$result.="<script type='text/javascript'>";
		    			$result.='window.location="empleados.php?E=4";';
		    			$result.="</script>";
				}else{
	    		include ("class/classEmpleado.php");
    			echo $objetoEmpleado->form();
				$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
	  				<button type="button" class="close" data-dismiss="alert">&times;</button>
	  				<strong>El correo que ingresaste ya está registrado</strong> 
					</div>';
			

	    		}
			}
			else{
			include ("class/classEmpleado.php");
    		//muestra el formulario para crear un usuario
    		
			echo $objetoEmpleado->form($_POST['id_empleado']);
			$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos</strong> 
						</div>';
			
		}
		echo $result;

		break;
	}
}

?>


</body>

</html>

<!DOCTYPE html>
<html>
<head>

	<title>Tipo Cita</title>

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
            $(location).attr('href','tipoCita.php?E=3');
      }
      function mostrarEditar(id){	
            $(location).attr('href','tipoCita.php?E=2&id='+id);
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
					 	$(location).attr('href','tipoCita.php?E=1&id='+id);
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
	      		var parametros=$("#datosTipoCita").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "tipoCita.php?E=5", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#modificar").click(function(){
	      		var parametros=$("#datosTipoCita").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "tipoCita.php?E=6", 
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
<div id="capaDatos" style="background-color:#FEDCEE; width:300px; margin-top: 70px; position:absolute; margin-left: 10px; z-index: 1;"></div>


    <?php
 
include "header.php";	

if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {

    case 1:
    //Elimina un tipo_cita
    	$result="";
	    include '..\herramientas.php';
	   	$objetoBD->consulta("delete from tipo_cita where id_tipo=".$_GET['id']);
		$result.="<script type='text/javascript'>";
    			$result.='window.location="tipoCita.php?E=4";';
    			$result.="</script>";
    	echo $result;

	break;
	case 2:
	//Actualiza un empleado
	include ("class/classCita.php");
    //muestra el formulario para editar un usuario
    echo $objetoCita->formTipo($_GET['id']);
    break;
    case 3:
    include ("class/classCita.php");
    //muestra el formulario para crear un usuario
    echo $objetoCita->formTipo();
	break;
	case 4:
	
	include ("class/classCita.php");
    //muestra los usuarios que coinciden con el nombre ingresado
    echo $objetoCita->totalTipos();
	break;
	case 5:
    include '..\herramientas.php';
    	$result="";
		function validar(){
			if(empty($_POST['descripcion'])||empty($_POST['costo'])){
				return false;
			}
			else{
				return true;
			}
		}
		if(validar()){
				$cad="insert into tipo_cita set descripcion='".$_POST['descripcion']."', costo=".$_POST['costo'];
					$objetoBD->consulta($cad);
					$result.="<script type='text/javascript'>";
	    			$result.='window.location="tipoCita.php?E=4";';
	    			$result.="</script>";
	    	
		}
		else{
			include ("class/classCita.php");
    		//muestra el formulario para crear un usuario
    		
			echo $objetoCita->formTipo();
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
    		function val(){
				if(empty($_POST['descripcion'])||empty($_POST['costo'])){
					return false;
				}
				else{
					return true;
				}
			}
			if(val()){
					$cad="update tipo_cita set descripcion='".$_POST['descripcion']."', costo=".$_POST['costo']." where id_tipo=".$_POST['id_tipo'];
					$objetoBD->consulta($cad);	
					$result.="<script type='text/javascript'>";
	    			$result.='window.location="tipoCita.php?E=4";';
	    			$result.="</script>";
			}
			else{
			include ("class/classCita.php");
    		//muestra el formulario para crear un usuario
    		
			echo $objetoCita->formTipo($_POST['id_tipo']);
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

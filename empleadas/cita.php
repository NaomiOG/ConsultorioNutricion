<!DOCTYPE html>
<html>
<head>
		<title>Cita</title>

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
            $(location).attr('href','proceso-cita.php?E=3');
      }
      function mostrarEditar(id,pid){	
            $(location).attr('href','proceso-cita.php?E=2&id='+id+'&pid='+pid);
      }
      function borrar(id,pid){
     			
		$.confirm({
				title: 'Eliminar elemento',
			content: '¿Está seguro de eliminar el empleados?',
			type: 'blue',
			buttons: {
					confirmar:{
					 btnClass:'btn-blue',
					 action: function () {
					 	$(location).attr('href','proceso-cita.php?E=1&id='+id+'&pid='+pid);
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
	      	function ajaxBuscador(){
			     	  var filtro=$("#buscador").val();
			          var parametros='filter='+filtro;
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=4", 
			                data: parametros,
			                success: function(result){
			                 $("#contenedor").html(result).show();
			                }
		         });
			     
       		}
       		var bus=setInterval(function(){ ajaxBuscador(); }, 1000);
       		//var bus=ajaxBuscador();

       		$( "#tipo" ).on('change',function(){
 				var filtro=$("#tipo").val();
			          var parametros='filter='+filtro;
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=7", 
			                data: parametros,
			                success: function(result){
			                 $("#horarios").html(result).show();
			                }
		         	});
 			});
      });
      
      
	</script>
</head>
<body>
	<?php
	include "header.php";

	?>

<div style="margin-top: 20px; margin-left: 50px; display: inline-flex">
	<h6 style="margin-top:5px;">Buscar </h6>
    <input style="font-size: 0.8rem; width: 300px;" value="" type="text" class="form-control" id="buscador" name="buscador" placeholder="Búsqueda por nombre del paciente" /></div>
<div style="display: inline-flex;">
<div id="contenedor"></div>
		
</div>


    

</body>

</html>

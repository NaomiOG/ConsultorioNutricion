<?php
include "header.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pacientes</title>

  <script src="../jquery-3.5.1.min.js">
  </script>
  <script src="../jquery-confirm.js">
  </script>
  <script type="text/javascript">
  			function a_onClick() {
        		document.getElementById("btnDel").click();
      		}
  			function borrar(id){
  				$.confirm({
   						title: 'Eliminar elemento',
	    				content: '¿Está seguro de eliminar el registro?',
	    				type: 'blue',
	    				buttons: {
        						confirmar:{
        						 btnClass:'btn-blue',
        						 action: function () {
        								$.ajax({
            							type:"POST",
            							method:"POST",
            							url: "proceso-paciente.php?id="+id+"&accion=pacientes.delete", 
  										});
  										//$(location).attr('href',"paciente.php?id="+id+"&accion=pacientes.delete");
  										$.alert('Se ha eliminado el elemento correctamente');
  										
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
			                url: "proceso-paciente.php?accion=pacientes.filtro", 
			                data: parametros,
			                success: function(result){
			                 $("#contenedor").html(result).show();
			                }
		         });
			     
       			}
       			var bus=setInterval(function(){ ajaxBuscador(); }, 1000);
      		});//filtra por nombre 

  </script>

  <link rel="stylesheet" type="text/css" href="../jquery-confirm.css">

</head>
<body>
<div style="margin-top: 20px; margin-left: 127px; display: inline-flex">
						<h6 style="margin-top:5px;">Buscar </h6>
    					<input style="font-size: 0.8rem; width: 200px;" value="" type="text" class="form-control" id="buscador" name="buscador" placeholder="Búsqueda por nombre" /></div>
<div id="contenedor">
		
</div>

</body>

</html>

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
    			 $(document).ready(function(){   
	  			 function ajaxBuscador(){
			     	  var filtro=$("#buscador").val();
			          var parametros='filter='+filtro;
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-historial.php?E=1", 
			                data: parametros,
			                success: function(result){
			                 $("#contenedor").html(result).show();
			                }
		         });
			     
       			}
       			var bus=setInterval(function(){ ajaxBuscador(); }, 1000);
              
            
            
          
      		});//filtra por nombre 
           function dieta(id,pid){ 
            $(location).attr('href','proceso-historial.php?E=2&id='+id+'&pid='+pid);
            }
            function expediente(id,pid){ 
            $(location).attr('href','proceso-historial.php?E=3&id='+id+'&pid='+pid);
            }

  </script>

  <link rel="stylesheet" type="text/css" href="../jquery-confirm.css">

</head>
<body>
<div style="margin-top: 20px; margin-left: 127px; display: inline-flex">
						<h6 style="margin-top:5px;">Filtro&nbsp&nbsp</h6>
    					<input style="font-size: 0.8rem; width: 200px;" value="" type="date" class="form-control" id="buscador" name="buscador" placeholder="Búsqueda por nombre" /></div>
<div id="contenedor">
		
</div>

</body>

</html>

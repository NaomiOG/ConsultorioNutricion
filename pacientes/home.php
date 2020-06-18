<?php
include "header.php";
session_start();
if(isset($_SESSION['rol'])&&($_SESSION['rol']==2)){
		//echo "Bienvenido Administrador".'<a class="btn btn-info btn-sm" href="../formAcceso.php">Cerrar sesión</a>';
}
else{
	header("location: ../login.php?E=45");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Consultorio de Nutrición</title>
	<script src="../jquery-3.5.1.min.js">
  	</script>
  	<script src="../jquery-confirm.js">
  	</script>
  	<link rel="stylesheet" type="text/css" href="../jquery-confirm.css">
	<style type="text/css">
		
		
		#delete{
			background: url("../imagenes/iconos.png");
			background-position: -120px -100px;
			cursor:pointer;
			width: 30px;
  			height: 20px;
		}
		.mifecha2 {
		   border: 1px solid #ddd;
		   padding: 3px;
		   text-align: center;
		   font-family:Century Gothic, arial;
		   font-size: 10.5pt;
		   overflow: hidden;
		   width: 100%
		}
		.mifecha2 .mesano{
		   float: left;
		   padding: 3px;
		   font-weight: bold;
		}
		.mifecha2 .dia, .mifecha2 .diaactual{
		   width: 30px;
		   padding: 3px;
		   margin-left: 3px;
		   background-color: #ADFCDF;
		   float: left;
		}
		.mifecha2 .diaactual{
		   background-color: #1FB27C;
		   font-weight: bold;
		}
		
	</style>
	<script type="text/javascript">
		var f=new Date();
		var ano = f.getFullYear();
		var mes = f.getMonth();
		var dia = f.getDate();
		var estiloDia;
		var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		var diasMes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		var diaMaximo = diasMes[mes];
		if (mes == 1 && (((ano % 4 == 0) && (ano % 100 != 0)) || (ano % 400 == 0)))
		   diaMaximo = 29;
		document.write('<div class="mifecha2">');
		document.write('<div class="mesano">' + meses[mes] + ' ' + ano + ':</div>');

		for (i=1; i<=diaMaximo; i++){
		   if(i == dia)
		      estiloDia = "diaactual";
		   else
		      estiloDia = "dia";
		   document.write('<div class="' + estiloDia + '">' + i + '</div>');
		}   
		document.write('</div>');

		//boton detalles 
		function b_onClick() {
        document.getElementById("borrar").click();
      	}
      	 function borrar(id,pid){
     			
		$.confirm({
				title: 'Cancelar cita',
			content: '¿Está seguro de cancelar su cita?',
			type: 'blue',
			buttons: {
					confirmar:{
					 btnClass:'btn-blue',
					 action: function () {
					 	$(location).attr('href','home.php?E=2&id='+id+'&pid='+pid);
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
	</script>
</head>
<body>
<div style="font-family: Century Gothic; text-align: center; margin-top: 10px; ">
		<h5><b>Dra. Ariana Espinoza Espinoza</b></h5>
		<h6>Médico Cirujano-Nutrición Clínica</h6>	
		<h6>CED. PROF. 6090150: REG S. S. G. 9769</h6>
		<h6><b>Tel.</b> (461) 157 68 72, <b>Celular</b> 4424107371</h6><p>    </p><br/>
</div>
 <?php
 include ("class/classHome.php");

if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {
    	case 1:
    	
	    //muestra el formulario para editar un usuario
	    echo $objetoHome->totalCitas();
    	break;
    	case 2:
	    	$result="";

		   	$objetoBD->consulta("delete from cita where id_paciente=".$_GET['pid']." and id_cita=".$_GET['id']);
			$result.="<script type='text/javascript'>";
	    			$result.='window.location="home.php?E=1";';
	    			$result.="</script>";
	    	echo $result;
    	break;
    }
}
?>


</body>

</html>
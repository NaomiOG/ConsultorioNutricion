<?php
include "header.php";
session_start();
if(isset($_SESSION['rol'])&&($_SESSION['rol']==1)){
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
	<style type="text/css">
		
		
		#add{
			background: url("../imagenes/iconos.png");
			background-position: -437px -140px;
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
		function a_onClick() {
        document.getElementById("ver").click();
      	}
      	function mostrarDetalles(id,pid){	
            $(location).attr('href','proceso-cita.php?E=2&id='+id+'&pid='+pid);
     	 }
	</script>
</head>
<body>
 <?php
 

if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {
    	case 1:
    	include ("class/classHome.php");
	    //muestra el formulario para editar un usuario
	    echo $objetoHome->totalCitas();
    	break;
    }
}
?>

</body>
</html>
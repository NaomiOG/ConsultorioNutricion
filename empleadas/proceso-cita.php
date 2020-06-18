<!DOCTYPE html>
<html>
<head>
	<title>Citas</title>
	<script src="../jquery-3.5.1.min.js">
  	</script>
  	<script src="../jquery-confirm.js">
  	</script>
  	
  	<link rel="stylesheet" type="text/css" href="../jquery-confirm.css">
	<script type="text/javascript">
	$(document).ready(function(){
		$( "#tipo" ).on('change',function(){
 				var filtro=$("#tipo").val();
 				console.log(filtro);
 				if($("#fecha").val()!=""){
 					var parametros=$("#formNew").serialize();
			          console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=7", 
			                data: parametros,
			                success: function(result){
			                	console.log
			                 $("#horarios").html(result).show();
			                }
		         	});
 				}
 				else{
 					$("#tipo").val(-1);
 					$.alert('Debes ingresar una fecha');
 				}
			          
 		});
 			$("#insertar").click(function(){
	      		var parametros=$("#formNew").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=5", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#insertarExp").click(function(){
	      		var parametros=$("#datosExpediente").serialize();
	      		console.log("Estos son: "+parametros, "hola");
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=9", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#volver").click(function(){
	      	 	location.reload()
			        
	      	});
	      	$("#modificar").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=6", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#modificarExp").click(function(){
	      		var parametros=$("#datosExpediente").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=10", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#expediente").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=8", 
			                data: parametros,
			                 success: function(result){
			                 	 console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#dieta").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=11", 
			                data: parametros,
			                 success: function(result){
			                 	 console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});

	});
	function llenarHora(id){
	      		hora=$("#btn"+id).val();	
	      		console.log(hora)        
	      		$("#hora").val(hora);
	 }
</script>

</head>
<body>

</body>
</html>

<?php
include "class/classCita.php"; 


if(isset($_GET['E'])){
    $E=$_GET['E'];
    switch ($E) {

    case 1:
    //Elimina una cita
    	$result="";

	   	$objetoBD->consulta("delete from cita where id_paciente=".$_GET['pid']." and id_cita=".$_GET['id']);
		$result.="<script type='text/javascript'>";
    			$result.='window.location="cita.php";';
    			$result.="</script>";
    	echo $result;

	break;
	case 2:
	include "header.php";
    //muestra el formulario para editar una cita
    echo $objetoCita->formCitaEdit($_GET['id'],$_GET['pid']);
    break;
    case 3:
    include "header.php";
    //muestra el formulario para crear un usuario
    echo $objetoCita->formCitaNew();
    break;
	case 4:
    //muestra los usuarios que coinciden con el nombre ingresado
    echo $objetoCita->totalCitas("select id_cita as NumCita,c.id_paciente, fecha as Fecha, hora as Hora, concat(p.nombre,' ',p.apellidos) as Paciente, tc.descripcion as TipoCita, status_pago as Estadodepago, tipo_pago as Tipodepago, asistencia as Asistió from cita c join tipo_cita tc on c.tipo_cita=tc.id_tipo join paciente p on c.id_paciente=p.id_paciente where p.nombre like '".$_POST['filter']."%' order by nombre,fecha DESC",array("5%","5%","10%","10%","15%","10%","10%","10%","5%","5%"),true,array("edit","delete"));
	break;
	case 5:
    	$result="";
		function validar(){
			if(empty($_POST['fecha'])||empty($_POST['hora'])||empty($_POST['tipo'])||empty($_POST['agendo'])||empty($_POST['paciente'])){
				return false;
			}
			else{
				return true;
			}
		}
		if(validar()){
			$idcita=0;
			$cad="select count(id_paciente) from cita where id_paciente=".$_POST['paciente']." limit 1";
			$objetoBD->consulta($cad);
			for ($i=0; $i < $objetoBD->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($objetoBD->bloque);
					$idcita=$tupla[0]+1;
			}
			
				$cad="insert into cita set status_pago='Pendiente', fecha='".$_POST['fecha']."', hora='".$_POST['hora']."', tipo_cita=".$_POST['tipo'].", empleado_agendo=".$_POST['agendo'].", id_paciente=".$_POST['paciente'].", id_cita=".$idcita;
					$objetoBD->consulta($cad);
					$result.="<script type='text/javascript'>";
	    			$result.='window.location="cita.php";';
	    			$result.="</script>";
	    	
		}
		else{
			$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:10px; width:1200px; font-family:Century Gothic; margin-top:10px; position:absolute;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos</strong> 
						</div>';
		}
		echo $result;
		break;
		case 6:
		//Actualizar una cita
		$result="";

    		function val(){
				if(empty($_POST['atendio'])||empty($_POST['pago'])||empty($_POST['observaciones'])||empty($_POST['asistencia'])){
					return false;
				}
				else{
					return true;
				}
			}
			if(val()){
					$cad="update cita set empleado_atendio=".$_POST['atendio'].", status_pago='".$_POST['pago']."', observaciones='".$_POST['observaciones']."', asistencia='".$_POST['asistencia']."', tipo_pago='".$_POST['tipopago']."' where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita'];
					$objetoBD->consulta($cad);	
					$result.="<script type='text/javascript'>";
	    			$result.='$.alert("Se han almacenado correctamente los cambios");';
	    			$result.='window.location="cita.php";';
	    			$result.="</script>";
			}
			else{
    		//muestra el formulario para editar una cita
			//echo $objetoCita->formCitaEdit($_POST['id_cita'],$_POST['id_paciente']);
			$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos</strong> 
						</div>';
			
			}
		echo $result;

		break;
		case 7:
		
				echo "<h6>Horarios Disponibles</h6>";
				$imprime="";
				$horarios=array("10:00:00","10:30:00","11:00:00","11:30:00","12:00:00","12:30:00","13:00:00","13:30:00","14:00:00","14:30:00","15:00:00","15:30:00","17:00:00","17:30:00","18:00:00","18:30:00","19:00:00","19:30:00");
				$imprime.="<div style='display:inline-flex; font-size:0.8em;'>";

			//eliminar horas ocupadas
			$cad="select id_tipo from tipo_cita where descripcion like 'Cavitación'";
			$objetoBD->consulta($cad);
			$idcav=0;	
			for ($i=0; $i < $objetoBD->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($objetoBD->bloque);
					$idcav=$tupla[0];
			}

			if($_POST['tipo']==$idcav){
				$cad="select hora from cita where tipo_cita=".$tupla[0]." and fecha='".$_POST['fecha']."' GROUP by fecha HAVING COUNT(id_cita)>=4";
				$objetoBD->consulta($cad);
				for ($i=0; $i < $objetoBD->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($objetoBD->bloque);
					$ban=array_search($tupla[0], $horarios);
					unset($horarios[$ban]);
				}

			}else{
				$cad="select hora from cita where tipo_cita!=".$idcav." and fecha='".$_POST['fecha']."'";
				$objetoBD->consulta($cad);
				for ($i=0; $i < $objetoBD->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($objetoBD->bloque);
					$ban=array_search($tupla[0], $horarios);
					unset($horarios[$ban]);
				}
			}
				

			foreach ($horarios as $hora => $value) {
				$imprime.="<input style='margin-left:5px; background-color:#0B8762; color:white;' type='button' id='btn".$hora."' class='btnHora' value='".$value."' onclick='llenarHora(".$hora.")'/>";
			}
			$imprime.="</div><br/><br/>";
			echo $imprime;
			break;

			case 8:
			    include "header.php";
    			//muestra el formulario para crear un expediente
    			echo $objetoCita->formExpediente($_POST['id_cita'],$_POST['id_paciente']);

			break;
			case 9:
				$result="";

    			function val(){
					if(!(isset($_POST['medicamento']))||empty($_POST['indicaciones'])||empty($_POST['Talla'])||empty($_POST['Peso'])||empty($_POST['Busto'])||empty($_POST['Cintura'])||empty($_POST['Cadera'])||empty($_POST['Muslo'])||empty($_POST['Brazo'])){
						return false;
					}
					else{
						return true;
					}
				}
				if(val()){
				
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Talla'");

					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Talla'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Peso'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Peso'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Busto'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Busto'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Cintura'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Cintura'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Cadera'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Cadera'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Muslo'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Muslo'];
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Brazo'");
					$cad="insert into expediente set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_tipomedida=".$row->id_tipo.", medida=".$_POST['Brazo'];
					$objetoBD->consulta($cad);

					$cad="insert into cita_medicamento set id_paciente=".$_POST['id_paciente'].", id_cita=".$_POST['id_cita'].", id_medicamento=".$_POST['medicamento'].", indicaciones='".$_POST['indicaciones']."'";
					$objetoBD->consulta($cad);

						
						$result.="<script type='text/javascript'>";
		    			$result.='window.location="proceso-cita.php?E=2&id='.$_POST['id_cita'].'&pid='.$_POST['id_paciente'].'";';
		    			$result.='$.alert("Se han almacenado correctamente los cambios");';

		    			$result.="</script>";
		    	
				}
				else{
					$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:10px; width:1200px; font-family:Century Gothic; margin-top:10px; position:absolute;">
				  				<button type="button" class="close" data-dismiss="alert">&times;</button>
				  				<strong>Debes llenar todos los campos</strong> 
								</div>';
				}
				echo $result;

			break;
			case 10:
			$result="";

    			function val(){
					if(!(isset($_POST['medicamento']))||empty($_POST['indicaciones'])||empty($_POST['Talla'])||empty($_POST['Peso'])||empty($_POST['Busto'])||empty($_POST['Cintura'])||empty($_POST['Cadera'])||empty($_POST['Muslo'])||empty($_POST['Brazo'])){
						return false;
					}
					else{
						return true;
					}
				}
				if(val()){
				
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Talla'");

					$cad="update expediente set medida=".$_POST['Talla']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Peso'");
					$cad="update expediente set medida=".$_POST['Peso']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Busto'");
					$cad="update expediente set medida=".$_POST['Busto']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Cintura'");
					$cad="update expediente set medida=".$_POST['Cintura']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Cadera'");
					$cad="update expediente set medida=".$_POST['Cadera']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Muslo'");
					$cad="update expediente set medida=".$_POST['Muslo']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);
					$row=$objetoBD->saca_tupla("select id_tipo from tipo_medida where descripcion like 'Brazo'");
					$cad="update expediente set medida=".$_POST['Brazo']." where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita']." and id_tipomedida=".$row->id_tipo;
					$objetoBD->consulta($cad);

					$cad="update cita_medicamento set id_medicamento=".$_POST['medicamento'].", indicaciones='".$_POST['indicaciones']."' where id_paciente=".$_POST['id_paciente']." and id_cita=".$_POST['id_cita'];
					$objetoBD->consulta($cad);

						
						$result.="<script type='text/javascript'>";
		    			$result.='window.location="proceso-cita.php?E=2&id='.$_POST['id_cita'].'&pid='.$_POST['id_paciente'].'";';
		    			$result.='$.alert("Se han almacenado correctamente los cambios");';

		    			$result.="</script>";
		    	
				}
				else{
					$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:10px; width:1200px; font-family:Century Gothic; margin-top:10px; position:absolute;">
				  				<button type="button" class="close" data-dismiss="alert">&times;</button>
				  				<strong>Debes llenar todos los campos</strong> 
								</div>';
				}
				echo $result;

			break;
			case 11:
				include "header.php";
    			//muestra el formulario para crear una dieta
    			echo $objetoCita->formDieta($_POST['id_cita'],$_POST['id_paciente']);
			break;
	}
}

?>
<div id='horarios' style='text-align:center; background-color:#98F8DC; width:1200px; margin-left: 80px; margin-bottom: 20px;'></div>
<div id='mensajes' style='width:1200px; background-color:white;'></div>
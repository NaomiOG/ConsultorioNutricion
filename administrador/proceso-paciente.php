
<?php

include "class/classPaciente.php";
if (isset($_REQUEST['accion'])) {

			if(isset($_POST['accion'])){
				switch ($_POST['accion']) {
					//Paciente
					case 'pacientes.insert':
	      				include 'header.php';
						echo $objetoPaciente->accion("insert");	
					break;
					case 'pacientes.update':
	      				echo $objetoPaciente->accion("update");
      				break;
      			
				}
			}
			
				switch ($_REQUEST['accion']) {
					//pacientes
					case 'pacientes.filtro':
						
	      				echo $objetoPaciente->accion("filtro",$_POST['filter']);
      				break;
					case 'pacientes.new':
						include 'header.php';
						echo $objetoPaciente->accion("formNew");
						break;
					case 'pacientes.delete':
						
						echo $objetoPaciente->accion("delete","",$_REQUEST['id']);	
					break;
					case 'pacientes.formEdit':
						include 'header.php'; 
				        echo $objetoPaciente->accion("formEdit");
		   			break;
					
				}
	}
?>
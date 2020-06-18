
<?php

include "class/classMedicamento.php";
if (isset($_REQUEST['accion'])) {

			if(isset($_POST['accion'])){
				switch ($_POST['accion']) {
					//Medicamento
					case 'medicamento.insert':
	      				include 'header.php';
						echo $objetoMedicamento->accion("insert");	
					break;
					include 'header.php';
					case 'medicamento.update':
	      				echo $objetoMedicamento->accion("update");
      				break;
      			
				}
			}
			
				switch ($_REQUEST['accion']) {
					//medicamento
					case 'medicamento.filtro':
	      				echo $objetoMedicamento->accion("filtro",$_POST['filter']);
      				break;
					case 'medicamento.new':
						include 'header.php';
						echo $objetoMedicamento->accion("formNew");
						break;
					case 'medicamento.delete':
						
						echo $objetoMedicamento->accion("delete","",$_REQUEST['id']);	
					break;
					case 'medicamento.formEdit':
				        echo $objetoMedicamento->accion("formEdit");
		   			break;
					
				}
	}
?>
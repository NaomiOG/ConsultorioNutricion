<?php
if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Home extends baseDatos{
			function totalCitas(){
			$imprime="";
			
				$cad="select c.id_cita,c.id_paciente, hora, concat(nombre,' ',apellidos) as paciente, tp.descripcion from cita c join paciente p on c.id_paciente=p.id_paciente join tipo_cita tp on c.tipo_cita=tp.id_tipo where fecha=curdate() order by hora ASC";
				$this->consulta($cad);
				$citas=$this->numTuplas;

				$imprime="<div style='text-align:center;'><b style='font-family:Century Gothic; color:black; margin-left:5px;'>Número de citas del día: </b>".$citas."</div><br/><div style=' display: flex;  flex-wrap: wrap;'>";
				$top=20;
				$conta=0;
				for ($i=0; $i < $this->numTuplas; $i++) { 
					$conta++;
					$tupla=mysqli_fetch_array($this->bloque);
					$imprime.='<div style="margin-top:'.$top.'px; margin-bottom:20px; margin-left:20px; '.(($tupla[4]=="Control")?"background-color:#9AF3E9;":(($tupla[4]=='Retoma')?'background-color:#F6F8A7;':(($tupla[4]=='Primera vez')?'background-color:#B0F8A7;':(($tupla[4]=='Cavitacion')?'background-color:#A7D9F8;':'')))).' display: block; width:250px; heigth=3000px; box-shadow: 1px 3px 5px #000;
						 border-radius: 1px;">
						
						<h6 id="cita'.$i.'" style="font-family:Century Gothic; font-weight:bold; color:#0B685E">Hora:'.$tupla[2].'</h6><h6><b>Paciente:</b> '.$tupla[3].'</h6><h6 style="font-family:Century Gothic; color:black"><b>Tipo de cita:</b> '.$tupla[4].'
						<a id="ver" onmouseover="a_onClick" onclick="mostrarDetalles('.$tupla[0].','.$tupla[1].')"><img id="add" src="../imagenes/img_trans.png"/></a>
						</div>
						 ';
					
					if($conta>4){
						$conta=0;
						$imprime.='<br/><br/>';
					}
					
				}
				$imprime.="</div>";
			return $imprime;
		}


	}

	$objetoHome=new Home();
?>

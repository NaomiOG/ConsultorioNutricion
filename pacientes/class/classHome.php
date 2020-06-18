<?php
if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Home extends baseDatos{
			function totalCitas(){
			$imprime="";
				$cad="select c.id_cita,c.id_paciente, hora, concat(nombre,' ',apellidos) as paciente, tp.descripcion, fecha from cita c join paciente p on c.id_paciente=p.id_paciente join tipo_cita tp on c.tipo_cita=tp.id_tipo where fecha>=curdate() and c.id_paciente=".$_SESSION['id']." order by fecha ASC";
				$this->consulta($cad);
				$citas=$this->numTuplas;

				$imprime="<div style='text-align:center;'><b style='font-family:Century Gothic; color:black; margin-top:20px; margin-left:5px;'>Próximas citas: </b>".$citas."</div><br/><div style=' display: flex;  flex-wrap: wrap;'>";
				$top=20;
				$conta=0;
				for ($i=0; $i < $this->numTuplas; $i++) { 
					$conta++;
					$tupla=mysqli_fetch_array($this->bloque);
					$imprime.='<div style="margin-top:'.$top.'px; margin-bottom:20px; margin-left:20px; '.(($tupla[4]=="Control")?"background-color:#9AF3E9;":(($tupla[4]=='Retoma')?'background-color:#F6F8A7;':(($tupla[4]=='Primera vez')?'background-color:#B0F8A7;':(($tupla[4]=='Cavitacion')?'background-color:#A7D9F8;':'')))).' display: block; width:250px; heigth=3000px; box-shadow: 1px 3px 5px #000;
						 border-radius: 1px;">
						
						<h6></h6>
						<h6 id="cita'.$i.'" style="font-family:Century Gothic; font-weight:bold; color:#0B685E">Hora:'.$tupla[2].'</h6><h6><b>Fecha: </b>'.$tupla[5].'</h6><h6><b>Paciente:</b> '.$tupla[3].'</h6><h6 style="font-family:Century Gothic; color:black"><b>Tipo de cita:</b> '.$tupla[4].'
						<a id="ver" onmouseover="b_onClick" onclick="borrar('.$tupla[0].','.$tupla[1].')"><img id="delete" src="../imagenes/img_trans.png"/></a>
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
		function historialCitas($filtro,$id){
				$imprime="";
			
				$cad="select c.id_cita,c.id_paciente, hora, concat(nombre,' ',apellidos) as paciente, tp.descripcion, fecha from cita c join paciente p on c.id_paciente=p.id_paciente join tipo_cita tp on c.tipo_cita=tp.id_tipo where ".(($filtro!="")?'fecha="'.$filtro.'" and ':'')." c.id_paciente=".$id." order by fecha ASC";
				$this->consulta($cad);
				$usuarios=$this->numTuplas;
				$imprime="<div style='text-align: center;'><b style='font-family:Century Gothic; color:black; margin-left:5px;'>Total de Citas: </b>".$usuarios."</div><br/>";
				$top=20;
				for ($i=0; $i < $this->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($this->bloque);
					$imprime.='<div style="margin-top:'.$top.'px; margin-bottom:20px; margin-left:500px; position:absolute; background-color:#9AF3E9; display: block; width:400px; box-shadow: 1px 3px 5px #000;
						 border-radius: 1px;">
						
						<h6 id="nom'.$i.'" style="font-family:Century Gothic; font-weight:bold; color:#0B685E">'.$tupla[3].'</h6><h6><b>Id Cita:</b> '.$tupla[0].'</h6><h6 style="font-family:Century Gothic; color:black"><b>Fecha:</b> '.$tupla[5].'</h6><h6><b>Hora:</b> $'.$tupla[2].'</h6>
						
						<div style="display: inline-flex; margin-bottom:10px;"><input id="mostrarDieta" type="button" style=" margin-left:100px; width:100px;" class="btn btn-sm- btn-primary" onclick="dieta('.$tupla[0].','.$tupla[1].')" value="Dieta">&nbsp&nbsp<input id="mostrarExpediente" type="button" style="style="margin-left:100px; width:100px;" class="btn btn-sm- btn-primary" value="Expediente" onclick="expediente('.$tupla[0].','.$tupla[1].')"></diV>	
						</div><br/> ';
					$top+=135;
				}
			return $imprime;

		}
		function formDieta($id,$pid){
				$result="";
				$row=$this->saca_tupla("select * from cita where id_paciente=".$pid." and id_cita=".$id);
				$fecha=$row->fecha;
				$paciente=$row->id_paciente;
				$row=$this->saca_tupla("select * from dieta d join cita c on d.id_cita=c.id_cita where d.id_paciente=".$pid." and d.id_cita=".$id);
				$result.='

					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:10px; text-align:center;"><b>Dieta</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 10px; margin-left:400px; width:300px; display:inline-flex; text-align:center;">
					<form method="post" id="datosDieta">
						<input type="hidden" class="form-control" name="id_cita" id="id_cita" placeholder="Nombre(s)" value="'.$id.'" />
						<input type="hidden" class="form-control"  name="id_paciente" id="id_paciente" placeholder="Nombre(s)" value="'.$pid.'" />
						<div style="display:inline-flex">
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Paciente</label>
					        <select class="form-control" disabled placeholder="Paciente" id="paciente" name="paciente" style=" width: 300px;" >
					        	<option value=-1 disabled selected>Selecciona el paciente</option>';
				         		$cad="select id_paciente, concat(nombre,' ',apellidos) as nombre from paciente order by nombre ASC;";
				         		 $this->inicializa();
					    
					    		$registros=mysqli_query($this->cone,$cad);
					    		$tuplas=mysqli_num_rows($registros);
				         		
				         		for ($i=0; $i < $tuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($registros);  
				                 $result.= "<option ".(($paciente==$tupla[0])?'selected':'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         		
				        $result.='	
    					</select>
					    </div>
						&nbsp&nbsp<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Fecha</label>
					        <input type="date" class="form-control"  readonly name="fecha" id="fecha" style="width:300px" placeholder="Fecha de la cita" value="'.$fecha.'" />
					    </div></div>
					    <br/>
					    	<label class="col-form-label" for="inputDefault" ><b>Desayuno</b></label>
					        <textarea class="form-control" id="desayuno" name="desayuno" cols="100" rows="5">'.((isset($row->fecha))?$row->desayuno:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Almuerzo</b></label>
					        <textarea class="form-control" id="almuerzo" name="almuerzo" cols="100" rows="5">'.((isset($row->fecha))?$row->almuerzo:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Comida</b></label>
					        <textarea class="form-control" id="comida" name="comida" cols="100" rows="5">'.((isset($row->fecha))?$row->comida:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Colación</b></label>
					        <textarea class="form-control" id="colacion" name="colacion" cols="100" rows="5">'.((isset($row->fecha))?$row->colacion:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Cena</b></label>
					        <textarea class="form-control" id="cena" name="cena" cols="100" rows="5">'.((isset($row->fecha))?$row->cena:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Alimentos para no sufrir hambre</b></label>
					        <textarea class="form-control" id="alimentos" name="alimentos" cols="100" rows="5">'.((isset($row->fecha))?$row->alimentos:'').'</textarea>
					        <label class="col-form-label" for="inputDefault" ><b>Indicaciones extra</b></label>
					        <textarea class="form-control" id="indicaciones" name="indicaciones" cols="100" rows="5">'.((isset($row->fecha))?$row->indicaciones:'').'</textarea>
					    </div>
					    </div>
					  
					   </div><br/>';
					    

					$result.='</form>
					</div></div></div>';
					return $result;
			}
				function formExpediente($id,$pid){
				$result="";
				$row=$this->saca_tupla("select * from cita where id_paciente=".$pid." and id_cita=".$id);
				$result.='

					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:10px; text-align:center;"><b>Expediente</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 10px; margin-left:400px; width:300px; display:inline-flex; text-align:center;">
					<form method="post" id="datosExpediente">
						<input type="hidden" class="form-control" name="id_cita" id="id_cita" placeholder="Nombre(s)" value="'.$id.'" />
						<input type="hidden" class="form-control"  name="id_paciente" id="id_paciente" placeholder="Nombre(s)" value="'.$pid.'" />
						<div style="display:inline-flex">
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Paciente</label>
					        <select class="form-control" disabled placeholder="Paciente" id="paciente" name="paciente" style=" width: 300px;" >
					        	<option value=-1 disabled selected>Selecciona el paciente</option>';
				         		$cad="select id_paciente, concat(nombre,' ',apellidos) as nombre from paciente order by nombre ASC;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option ".(($row->id_paciente==$tupla[0])?'selected':'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         		
				        $result.='	
    					</select>
					    </div>
						&nbsp&nbsp<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Fecha</label>
					        <input type="date" class="form-control"  readonly name="fecha" id="fecha" style="width:300px" placeholder="Fecha de la cita" value="'.((isset($row->fecha))?$row->fecha:'').'" />
					    </div></div>
					    <br/>
					    <div style="display:inline-flex;" >
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Medicamento</label>
					        <select class="form-control" placeholder="Medicamento" id="medicamento" name="medicamento" style=" width: 300px;" >
					        	<option value=-1 disabled selected>Selecciona el medicamento</option>';
				         		 $row=$this->saca_tupla("select id_medicamento,indicaciones from cita_medicamento where id_paciente=".$pid." and id_cita=".$id); 
				         		$cad="select id_medicamento, descripcion from medicamento order by descripcion ASC;";
				         		
				         		$this->consulta($cad);
				         		 $numMedidas=$this->numTuplas;
				         		for ($i=0; $i < $numMedidas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque); 
				                
				                 $result.= "<option ".((isset($row->id_medicamento))?(($row->id_medicamento==$tupla[0])?'selected':''):'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         		
				        $result.='	
    					</select>
					    </div>&nbsp&nbsp
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Indicaciones</label>
					        <textarea class="form-control" id="indicaciones" name="indicaciones" cols="50">'.((isset($row->id_medicamento))?$row->indicaciones:'').'</textarea>
					    </div>
					    </div>
					    <h6 style="text-align:center"><b>Medidas</b></h6>
					    <div style="margin-left:5%; text-align:justify; position:relative; margin-bottom:30px; display:inline-block; background-color: #CBFCDA; width: 400px; padding: 3px;  -webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1); box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);">';
					   	
					    
					    $this->inicializa();
					    $cad="select * from tipo_medida";
					    $registros=mysqli_query($this->cone,$cad);
					    $tuplas=mysqli_num_rows($registros);
					   
						for ($j=0; $j < $tuplas; $j++) { 
							
							$tupla=mysqli_fetch_array($registros);
							$row=$this->saca_tupla("select * from expediente e join tipo_medida m on e.id_tipomedida=m.id_tipo where id_tipomedida=".$tupla[0]." and id_paciente=".$pid." and id_cita=".$id);
							
							$result.=$tupla[1].'&nbsp<input type="text" class="form-control" name="'.$tupla[1].'" id="'.$tupla[1].'" style="width:200px" placeholder="Medida de '.$tupla[1].'" value="'.((isset($row->medida))?$row->medida:'').'"/>';
							
						
				}


					$result.='</form>
					</div></div></div>';
					return $result;
			}


	}

	$objetoHome=new Home();
?>

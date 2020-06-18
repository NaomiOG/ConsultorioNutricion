

<?php
if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Cita extends baseDatos{
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
					    
					    $result.=(isset($row->fecha)?'<input id="modificarDieta" type="button" style=" margin-left:620px; width:100px;" class="btn btn-sm- btn-primary" value="Actualizar">&nbsp&nbsp<input id="volver" type="button" style="style="margin-left:100px; width:100px;" class="btn btn-sm- btn-primary" value="Regresar"></div>':'<input id="insertarDieta" type="button" style="margin-left:660px;" class="btn btn-sm- btn-primary" value="Registrar">');

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
					    <div style="margin-left:5%; text-align:justify; position:relative; display:inline-block; background-color: #CBFCDA; width: 400px; padding: 3px;  -webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1); box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);">';
					   	
					    
					    $this->inicializa();
					    $cad="select * from tipo_medida";
					    $registros=mysqli_query($this->cone,$cad);
					    $tuplas=mysqli_num_rows($registros);
					   
						for ($j=0; $j < $tuplas; $j++) { 
							
							$tupla=mysqli_fetch_array($registros);
							$row=$this->saca_tupla("select * from expediente e join tipo_medida m on e.id_tipomedida=m.id_tipo where id_tipomedida=".$tupla[0]." and id_paciente=".$pid." and id_cita=".$id);
							
							$result.=$tupla[1].'&nbsp<input type="text" class="form-control" name="'.$tupla[1].'" id="'.$tupla[1].'" style="width:200px" placeholder="Medida de '.$tupla[1].'" value="'.((isset($row->medida))?$row->medida:'').'"/>';
							
						
						}


					   $result.='</div><br><br>
					';
					    
					    $result.=(isset($row->medida)?'<input id="modificarExp" type="button" style=" margin-left:50px; width:100px;" class="btn btn-sm- btn-primary" value="Actualizar">&nbsp&nbsp<input id="volver" type="button" style="style="margin-left:100px; width:100px;" class="btn btn-sm- btn-primary" value="Regresar"></div>':'<input id="insertarExp" type="button" style="style="margin-left:500px;" class="btn btn-sm- btn-primary" value="Registrar">');

					$result.='</form>
					</div></div></div>';
					return $result;
			}
			
			function formCitaNew(){
				$result="";
				
				$result.='
					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Registro de la cita</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:530px; width:400px;">
					<form method="post" id="formNew" >
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Fecha</label>
					        <input style="width:300px;" type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha de la cita" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Tipo de Cita</label>
					        <select class="form-control" placeholder="Elige el tipo de cita"  name="tipo" style=" width: 300px;" id="tipo">
					       		 <option value=-1 disabled selected>Selecciona el tipo de cita</option>';
				         		$cad="select id_tipo,descripcion from tipo_cita;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				        $result.='	
    					</select>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Hora</label>
					        <input style="width:300px;" type="time" class="form-control" name="hora" id="hora" readonly="readonly" placeholder="Hora de la cita"/>
					    </div>
					    
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Empleado agendó</label>
					        <select class="form-control" placeholder="Empleado que agendó" id="agendo" name="agendo" style=" width: 300px;">
					        <option value=-1 disabled selected>Selecciona el empleado</option>';
				         		$cad="select id_empleado, concat(nombre,' ',apellidos) as nombre from empleados order by nombre ASC;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         $result.='	
    					</select>
					    </div>
    					<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Paciente</label>
					        <select class="form-control" placeholder="Paciente" id="paciente" name="paciente" style=" width: 300px;" >
					        	<option value=-1 disabled selected>Selecciona el paciente</option>';
				         		$cad="select id_paciente, concat(nombre,' ',apellidos) as nombre from paciente order by nombre ASC;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         		
				        $result.='	
    					</select>
					    </div>';
					    
					    
					    $result.='<input id="insertar" type="button" style="margin-left:100px;" class="btn btn-sm- btn-primary" value="Registrar"/>';

					$result.='</form>
					</div></div></div>';
					return $result;
			}
			function formCitaEdit($id,$pid){
				$result="";
				$row=$this->saca_tupla("select * from cita where id_paciente=".$pid." and id_cita=".$id);
				$result.='
					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Datos de la Cita</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:280px; width:400px;">
					<form method="post" id="formCitaEdit" >
						<input type="hidden" class="form-control" name="id_cita" id="id_cita" placeholder="Nombre(s)" value="'.((isset($row	->fecha))?$row->id_cita:'-1').'" />
						<input type="hidden" class="form-control"  name="id_paciente" id="id_paciente" placeholder="Nombre(s)" value="'.((isset($row	->fecha))?$row->id_paciente:'-1').'" />
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Fecha</label>
					        <input type="date" class="form-control"  readonly name="fecha" id="fecha" style="width:300px" placeholder="Fecha de la cita" value="'.((isset($row->fecha))?$row->fecha:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Hora</label>
					        <input type="time" class="form-control" readonly name="hora" id="hora" style="width:300px"placeholder="Hora de la cita" value="'.((isset($row->fecha))?$row->hora:'').'"/>
					    </div>
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
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Tipo de Cita</label>
					        <select placeholder="Elige el tipo de cita" disabled class="form-control" name="tipo" style=" width: 300px;" id="tipo">';
				         		$cad="select id_tipo,descripcion from tipo_cita;";

				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) {
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option ".(($row->tipo_cita==$tupla[0])?'selected':'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				        $result.='	
    					</select>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Agendó</label>
					        <select class="form-control" disabled placeholder="Empleado que agendó" id="agendo" name="agendo" style=" width: 300px;"><option value=-1 disabled selected> Selecciona un empleado</option>';
				         		$cad="select id_empleado, concat(nombre,' ',apellidos) as nombre from empleados;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option ".(($row->empleado_agendo==$tupla[0])?'selected':'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         $result.='	
    					</select>
					    </div>
					   	</div>
						<div style="margin-top: 35px; width:300px;margin-left: 800px; position:absolute">
						 <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Atendió</label>
					        <select class="form-control" placeholder="Empleado que atendió" id="atendio" name="atendio" style=" width: 300px;"><option value=-1 disabled selected> Selecciona un empleado</option>';
				         		$cad="select id_empleado, concat(nombre,' ',apellidos) as nombre from empleados;";
				         		$this->consulta($cad);
				         		for ($i=0; $i < $this->numTuplas; $i++) { 
				                 $tupla=mysqli_fetch_array($this->bloque);  
				                 $result.= "<option ".(($row->empleado_atendio==$tupla[0])?'selected':'')." value=".$tupla[0].">".$tupla[1]."</option>";
				         		}
				         		
				        $result.='	
    					</select>
    					 
						</div>
					    <div class="form-group" >
					      <label>Estado del pago</label>
					      <select class="form-control" class="form-control" id="pago" name="pago" style="vertical-align: middle; font-size: 0.9rem"><option value=-1 disabled> Selecciona una forma de pago</option>
					           <option value="Pagado"';       
					            $result.=(($row->status_pago=='Pagado')?' selected':'');
					          
					     	$result.='>Pagado</option>
					           <option value="Pendiente"';
								
					           $result.=(($row->status_pago=='Pendiente')?' selected':'');
					           
					      $result.='>Pendiente</option>
					      </select>
					    </div>
					    <label>Tipo de pago</label>
						<div style="background-color: #CBF4FB; width: 300px; padding: 3px;  -webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1); box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);">
						<label>Efectivo&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" style="font-size:1em;"  class="form-check-input" value="Efectivo" name="tipopago" '.(($row->tipo_pago=='Efectivo')?' checked':'').'/></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	
						<label>Transferencia&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" style="font-size:1em;"  class="form-check-input" value="Transferencia" name="tipopago" '.(($row->tipo_pago=='Transferencia')?' checked':'').'/></label>
						</div>

					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Observaciones</label>
					        <textarea class="form-control" id="observaciones" name="observaciones">'.((isset($row->fecha))?$row->observaciones:'').'</textarea>
					    </div>
					    
					    <label>Asistió</label>
						<div style="background-color: #CBF4FB; width: 300px; padding: 3px;  -webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1); box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);">
						<label>Si&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" style="font-size:1em;"  class="form-check-input" value="Si" name="asistencia" '.(($row->asistencia=='Si')?' checked':'').'/></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp	
						<label>No&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" style="font-size:1em;"  class="form-check-input" value="No" name="asistencia" '.(($row->asistencia=='No')?' checked':'').'/></label>
						</div><br/><br/>
					
					    ';

					$result.='</form>
					</div></div></div><br/><div style="display:inline-flex; text-align:center; margin-left:40%">
					    <input id="modificar" type="button" style="margin-left:0px; width:100px;" class="btn btn-sm- btn-primary" value="Actualizar"/><input id="expediente"  type="button" style="margin-left:5px; width:100px;" class="btn btn-sm- btn-primary" value="Expediente"/><input id="dieta" type="button" style="margin-left:5px; width:100px;" class="btn btn-sm- btn-primary" value="Dieta"/></div>';
					return $result;
			}
			function formTipo($id=-1){
				$result="";
				$row=$this->saca_tupla("select * from tipo_cita where id_tipo=".$id);
				echo $id;
				$result.='
					<div style="z-index: 1; background-color:white; ">

					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Datos del tipo de cita</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:500px; width:400px;">
					<form method="post" id="datosTipoCita">
						<input type="hidden" class="form-control" name="id_tipo" id="id_tipo" placeholder="Nombre(s)" value="'.((isset($row	->descripcion))?$row->id_tipo:'-1').'" />
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Descripción</label>
					        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" value="'.((isset($row->descripcion))?$row->descripcion:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Costo</label>
					        <input type="number" class="form-control" name="costo" id="costo" placeholder="Costo de la cita" value="'.((isset($row->descripcion))?$row->costo:'').'"/>
					    </div>
					    <br/>
					';
					    
					    $result.=(isset($row->descripcion)?'<input id="modificar" type="button" style="margin-left:160px;" class="btn btn-sm- btn-primary" value="Actualizar">':'<input id="insertar" type="button" style="margin-left:160px;" class="btn btn-sm- btn-primary" value="Registrar">');

					$result.='</form>
					</div></div></div>';
					return $result;
			}
			
			function totalTipos(){
				$imprime="";
			
				$cad="select * from tipo_cita";
				$this->consulta($cad);
				$tipos=$this->numTuplas;
				$imprime="<div style='text-align:center;'><a id='nuevo' onmouseover='a_onClick' onclick='mostrarNuevo()'><img id='add' src='../imagenes/img_trans.png'/></a><b style='font-family:Century Gothic; color:black; margin-left:5px;'>Total tipos de citas: </b>".$tipos."</div><br/>";
				$top=20;
				for ($i=0; $i < $this->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($this->bloque);
					$imprime.='<div style="margin-top:'.$top.'px; margin-bottom:20px; margin-left:500px; position:absolute; background-color:#9AF3E9; display: block; width:400px; box-shadow: 1px 3px 5px #000;
						 border-radius: 1px;">
						<div>
						<h6 id="nom'.$i.'" style="font-family:Century Gothic; font-weight:bold; color:#0B685E">'.$tupla[1].'</h6><h6><b>Costo: $</b>'.$tupla[2].'</h6>
						</div>
						<div style="text-align:center; display: inline-flex; margin-left:40%; margin-bottom:5px;"><a id="editar" onmouseover="c_onClick" onclick="mostrarEditar('.$tupla[0].')"><img id="edit" src="../imagenes/img_trans.png"/></a><a id="borrar" onmouseover="b_onClick" onclick="borrar('.$tupla[0].')"><img id="delete" src="../imagenes/img_trans.png"/></a></div>	
						</div><br/> ';
					$top+=65;
				}
			return $imprime;

			}

			function totalCitas($query,$medidas=array(),$agregar=false,$p_iconos=array(),$p_colorRenglon="table-secondary"){
				
				//3.Consumir datos
				$this->consulta($query);
				$result='<html>
				<head>
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
				</head>
				<body>';
				$result.='<div style="margin-top: 20px; margin-left:30px;"><span style="font-family: Century Gothic; font-size: 0.8rem;" class="badge badge-pill badge-primary">Citas</span><table class="table-hover" width=1300px;>';
				#cabecera de las columnas

				$result.='<tr class=table-info>';
				$result.='<td colspan="'.count($p_iconos).'">'.(($agregar)?'<a id="nuevo" onmouseover="a_onClick" onclick="mostrarNuevo()"><img id="add" src="../imagenes/img_trans.png"/></a>':"&nbsp;").'</td>';
				for ($coluC=0; $coluC < mysqli_num_fields($this->bloque) ; $coluC++) { 
						$campo=mysqli_fetch_field_direct($this->bloque,$coluC);

						$result.='<th width="'.$medidas[$coluC].'">'.$campo->name.'</th>';
					}
				$result.='</tr>';

				#fin de las cabeceras

				for ($contR=0; $contR < $this->numTuplas; $contR++) { 
					$result.= '<tr '.(($contR%2)?'class="'.$p_colorRenglon.'"':'').'>';
					

					$tupla=mysqli_fetch_array($this->bloque);
					#íconos de acción
					if(in_array("delete", $p_iconos)){
						$result.='<td width="5%"><a id="btnDel" onmouseover="a_onClick" onclick="borrar('.$tupla[0].','.$tupla[1].')"><img id="delete" src="../imagenes/img_trans.png" /></a></td>';
					}
					if(in_array("edit", $p_iconos)){
						$result.='<td width="5%"><a id="editar" onmouseover="c_onClick" onclick="mostrarEditar('.$tupla[0].','.$tupla[1].')"><img id="edit" src="../imagenes/img_trans.png"/></td>';
					}
					if(in_array("details", $p_iconos)){
						$result.='<td width="5%"><a href="proceso-paciente.php?id='.$tupla[0].'&accion=pacientes.formEdit"><img id="edit" src="../imagenes/img_trans.png"/></td>';
					}

					for ($coluC=0; $coluC < mysqli_num_fields($this->bloque) ; $coluC++) { 
						$result.='<td>'.$tupla[$coluC].'</td>';
					}

					$result.= '</tr>';
				}
				$result.="</table></div></body></html>";
				return $result;
				
			}




	}
	$objetoCita=new Cita();
?>
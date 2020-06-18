 
<?php

if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Paciente extends baseDatos{
		function accion($cual,$filtro='',$id=-1){
			$result="";
			switch ($cual) {

				case 'filtro':
				$result="";
					$result=$this->showTabla("select id_paciente as id, nombre as Nombre, apellidos as Apellidos, telefono as Teléfono, sexo as Sexo, fecha_nacimiento as Nacimiento, fecha_Ingreso as Ingreso, domicilio as Domicilio from paciente WHERE nombre like '".$filtro."%'",array("5%","12%","15%","12%","5%","15%","%15%","15%"),true,array("edit","delete"));
					
					break;
				case 'insert':
				$result="";
					function validar(){
						if(isset($_POST['nombre'])&&isset($_POST['apellidos'])&&isset($_POST['email'])&&isset($_POST['domicilio'])&&isset($_POST['telefono'])&&isset($_POST['nacimiento'])&&isset($_POST['genero'])&&isset($_POST['clave'])){
						return true;
						}
						else{
							return false;
						}
					}
					if(validar()){
						$this->consulta("select * from usuarios where email='".$_POST['email']."'");
						$resultados=$this->numTuplas;
						if($resultados==0){
							$cad="insert into paciente set nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', telefono=".$_POST['telefono'].", sexo='".$_POST['genero']."', fecha_ingreso='".date("Y-m-d")."', fecha_nacimiento='".$_POST['nacimiento']."', domicilio='".$_POST['domicilio']."'";
							$this->consulta($cad);
							$this->consulta("select id_paciente from paciente order by id_paciente DESC limit 1");
							for ($i=0; $i < $this->numTuplas; $i++) { 
								$tupla=mysqli_fetch_array($this->bloque);
							}
							$this->consulta("insert into usuarios set id_usuario='".$tupla[0]."' ,email='".$_POST['email']."',tipo_usuario=2,contraseña=password('".$_POST['clave']."')");
							$result.="<script type='text/javascript'>";
	    					$result.='window.location="paciente.php"';
	    					$result.="</script>";
	    				}
						else{
	    				$result=$this->accion("formNew");
							$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>El correo que ingresaste ya está registrado</strong> 
						</div>';
			

	    				}

					}
					else
					{
						$result=$this->accion("formNew");
						$result.='<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos </strong> 
						</div>';
					}
				
				break;
				case 'update':
				$result="";
					function val(){
						if(isset($_POST['nombre'])&&isset($_POST['apellidos'])&&isset($_POST['email'])&&isset($_POST['domicilio'])&&isset($_POST['telefono'])&&isset($_POST['nacimiento'])&&isset($_POST['genero'])){
							return true;
						}
						else{
							return false;
						}
					}
					if(val()){
						$this->consulta("select * from usuarios where email='".$_POST['email']."'");
						$resultados=$this->numTuplas;
						if($resultados<=1){
							$clave=$_POST['clave'];
					        $this->consulta("UPDATE paciente set nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', telefono=".$_POST['telefono'].",sexo='".$_POST['genero']."', fecha_nacimiento='".$_POST['nacimiento']."', domicilio='".$_POST['domicilio']."'  WHERE id_paciente=".$_POST['id']);

					        $this->consulta("update usuarios set email='".$_POST['email']."'".(($clave!="")?", contraseña=password('".$clave."') ":" ")."where tipo_usuario=2 and id_usuario=".$_POST['id']);
					        
					        $result.="<script type='text/javascript'>";
	    					$result.='window.location="paciente.php"';
	    					$result.="</script>";
	    				}else{
	    				$result.=$this->accion("formEdit");
							$result.= '<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>El correo que ingresaste ya está registrado</strong> 
						</div>';
			

	    				}
				    }
				    else{
				    	$result.=$this->accion("formEdit");
    					$result.='<div class="alert alert-dismissible alert-danger" style="margin-left:20%; width:820px; font-family:Century Gothic; margin-top:10px;">
		  				<button type="button" class="close" data-dismiss="alert">&times;</button>
		  				<strong>Debes llenar todos los campos </strong> 
						</div>';


				    }
		    	break;		    

				case 'delete':
					$this->consulta("delete from paciente where id_paciente=".$id);
					$this->consulta("delete from usuarios where tipo_usuario=2 and id_usuario=".$id);
				
					
					break;
				case "formEdit":
					$result="";
				 	 $row=$this->saca_tupla("select * from paciente p join usuarios u on p.id_paciente=u.id_usuario where id_paciente=".$_REQUEST['id']);
				case 'formNew':
					$result.='
					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Datos del Paciente</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:280px; width:400px;">
					<form method="post" >
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Nombre</label>
					        <input type="text" class="form-control" name="nombre" placeholder="Nombre(s)" value="'.((isset($row->nombre))?$row->nombre:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Apellidos</label>
					        <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="'.((isset($row->nombre))?$row->apellidos:'').'"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Email</label>
					        <input type="email" class="form-control" name="email" placeholder="Email" value="'.((isset($row->nombre))?$row->email:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Dirección</label>
					        <input type="text" class="form-control" name="domicilio" placeholder="Dirección" value="'.((isset($row->nombre))?$row->domicilio:'').'"/>
					    </div>
					</div>
					<div style="margin-top: 30px; width:300px;margin-left: 100px;">

					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Contraseña</label>
					        <input type="password" class="form-control" name="clave" placeholder="Password" id="inputDefault"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Fecha de nacimiento</label>
					        <input type="date" class="form-control" name="nacimiento" placeholder=" fecha de nacimiento" value="'.((isset($row->nombre))?$row->fecha_nacimiento:'').'"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Teléfono</label>
					        <input type="number" class="form-control" name="telefono" placeholder="Número de teléfono" value="'.((isset($row->nombre))?$row->telefono:'').'"/>
					    </div>
					    <label>Sexo</label>
						<div style="background-color: #CBF4FB; width: 100%; padding: 3px;  -webkit-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);-moz-box-shadow: 15px 15px 28px -9px rgba(158,152,158,1); box-shadow: 15px 15px 28px -9px rgba(158,152,158,1);">
						<label>Femenino<input type="radio" value="F" name="genero" '.((isset($row->nombre))?(($row->sexo=='F')?'checked':''):'').'/></label>	
						<label>Masculino<input type="radio" value="M" name="genero" '.((isset($row->nombre))?(($row->sexo=='M')?'checked':''):'').'/></label>
						</div><br/><br/>
					';
					    
					    $result.=(isset($row->nombre)?'<button style="margin-left:210px;" class="btn btn-sm- btn-primary">Actualizar</button><input type="hidden" name="id" value="'.$row->id_paciente.'"/><input type="hidden" name="accion" value="pacientes.update"/>':'<button style="margin-left:210px;" class="btn btn-sm- btn-primary">Registrar</button><input type="hidden" name="accion" value="pacientes.insert" />');

					$result.='</form>
					</div></div></div>';
			}
			return $result;
		}

		function showTabla($query,$medidas=array(),$agregar=false,$p_iconos=array(),$p_colorRenglon="table-secondary"){
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
		$result.='<div class="container" style="margin-top: 20px"><span style="font-family: Century Gothic; font-size: 0.8rem;" class="badge badge-pill badge-primary">Pacientes</span><table class="table-hover" width=1100px;>';
		#cabecera de las columnas

		$result.='<tr class=table-info>';
		$result.='<td colspan="'.count($p_iconos).'">'.(($agregar)?'<a href="proceso-paciente.php?accion=pacientes.new"><img id="add" src="../imagenes/img_trans.png"/></a>':"&nbsp;").'</td>';
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
				$result.='<td width="5%"><a id="btnDel" onmouseover="a_onClick" onclick="borrar('.$tupla[0].')"><img id="delete" src="../imagenes/img_trans.png" /></a></td>';
			}
			if(in_array("edit", $p_iconos)){
				$result.='<td width="5%"><a href="proceso-paciente.php?id='.$tupla[0].'&accion=pacientes.formEdit"><img id="edit" src="../imagenes/img_trans.png"/></td>';
			}
			if(in_array("add", $p_iconos)){
				$result.='<td><img src="../imagenes/icono_add.png"/></td>';
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
$objetoPaciente=new Paciente();
?>
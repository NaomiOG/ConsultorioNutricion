

<?php
if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Empleado extends baseDatos{
			function form($id=-1){
				$result="";
				$row=$this->saca_tupla("select * from empleados p join usuarios u on p.id_empleado=u.id_usuario where tipo_usuario=1 and id_empleado=".$id);
		
				$result.='
					<div style="z-index: 1; background-color:white; ">

					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Datos del Empleado</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:280px; width:400px;">
					<form method="post" id="datosEmpleado">
						<input type="hidden" class="form-control" name="id_empleado" id="id_empleado" placeholder="Nombre(s)" value="'.((isset($row	->nombre))?$row->id_empleado:'-1').'" />
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Nombre</label>
					        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s)" value="'.((isset($row->nombre))?$row->nombre:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Apellidos</label>
					        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" value="'.((isset($row->nombre))?$row->apellidos:'').'"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Email</label>
					        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="'.((isset($row->nombre))?$row->email:'').'" />
					    </div>
					    
					</div>
					<div style="margin-top: 30px; width:300px;margin-left: 100px;">
				
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Contraseña</label>
					        <input type="password" class="form-control" name="clave" id="clave" placeholder="Password" id="inputDefault"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Sueldo</label>
					        <input type="number" class="form-control" name="sueldo" id="sueldo" placeholder="Sueldo" value="'.((isset($row->nombre))?$row->sueldo:'').'"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Teléfono</label>
					        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Número de teléfono" value="'.((isset($row->nombre))?$row->telefono:'').'"/>
					    </div>
					    
						<br/><br/>
					';
					    
					    $result.=(isset($row->nombre)?'<input id="modificar" type="button" style="margin-left:210px;" class="btn btn-sm- btn-primary" value="Actualizar">':'<input id="insertar" type="button" style="margin-left:210px;" class="btn btn-sm- btn-primary" value="Registrar">');

					$result.='</form>
					</div></div></div><div id="capaDatos"></div>';
					return $result;
			}
			
			function totalEmpleados(){
				$imprime="";
			
				$cad="select id_empleado, concat(nombre,' ',apellidos) as nombre,telefono, sueldo from empleados";
				$this->consulta($cad);
				$usuarios=$this->numTuplas;
				$imprime="<div style='text-align:center;'><a id='nuevo' onmouseover='a_onClick' onclick='mostrarNuevo()'><img id='add' src='../imagenes/img_trans.png'/></a><b style='font-family:Century Gothic; color:black; margin-left:5px;'>Total de Empleados: </b>".$usuarios."</div><br/>";
				$top=20;
				for ($i=0; $i < $this->numTuplas; $i++) { 
					$tupla=mysqli_fetch_array($this->bloque);
					$imprime.='<div style="margin-top:'.$top.'px; margin-bottom:20px; margin-left:500px; position:absolute; background-color:#9AF3E9; display: block; width:400px; box-shadow: 1px 3px 5px #000;
						 border-radius: 1px;">
						<div>
						<h6 id="nom'.$i.'" style="font-family:Century Gothic; font-weight:bold; color:#0B685E">'.$tupla[1].'</h6><h6><b>Id:</b> '.$tupla[0].'</h6><h6 style="font-family:Century Gothic; color:black"><b>Teléfono:</b> '.$tupla[2].'</h6><h6><b>Sueldo:</b> $'.$tupla[3].'</h6>
						</div>
						<div style="text-align:center; display: inline-flex; margin-left:40%; margin-bottom:5px;"><a id="editar" onmouseover="c_onClick" onclick="mostrarEditar('.$tupla[0].')"><img id="edit" src="../imagenes/img_trans.png"/></a><a id="borrar" onmouseover="b_onClick" onclick="borrar('.$tupla[0].')"><img id="delete" src="../imagenes/img_trans.png"/></a></div>	
						</div><br/> ';
					$top+=115;
				}
			return $imprime;

		}




	}
	$objetoEmpleado=new Empleado();
?>
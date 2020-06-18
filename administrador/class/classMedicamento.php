 
<?php

if(!class_exists("baseDatos"))
	include("../herramientas.php");

	class Medicamento extends baseDatos{
		function accion($cual,$filtro='',$id=-1){
			$result="";
			switch ($cual) {
				case 'filtro':
					$result=$this->showTabla("select id_medicamento as id, descripcion as Descripción, laboratorio as Laboratorio, inventario as Inventario from medicamento WHERE descripcion like '".$filtro."%'",array("5%","35%","25%","25%"),true,array("edit","delete"));
					
					break;
				case 'insert':
					function validar(){
						if(empty($_POST['descripcion'])||empty($_POST['laboratorio'])||empty($_POST['inventario'])){
							return false;
						}
						else{
							return true;
						}
					}
					if(validar()){
						$cad="insert into medicamento set descripcion='".$_POST['descripcion']."', laboratorio='".$_POST['laboratorio']."', inventario=".$_POST['inventario'];
						$this->consulta($cad);
						$result.="<script type='text/javascript'>";
    					$result.='window.location="medicamento.php"';
    					$result.="</script>";
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
					function validar(){
						if(empty($_POST['descripcion'])||empty($_POST['laboratorio'])||empty($_POST['inventario'])){
							return false;
						}
						else{
							return true;
						}
					}
					if(validar()){
				        $this->consulta("UPDATE medicamento set descripcion='".$_POST['descripcion']."', laboratorio='".$_POST['laboratorio']."', inventario=".$_POST['inventario']."  WHERE id_medicamento=".$_POST['id']);

				        $result.="<script type='text/javascript'>";
    					$result.='window.location="medicamento.php"';
    					$result.="</script>";
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
					$this->consulta("delete from medicamento where id_medicamento=".$id);
					break;
				case "formEdit":  
				include 'header.php';
				$row=$this->saca_tupla("select * from medicamento where id_medicamento=".$_REQUEST['id']);
				case 'formNew':

					$result.='
					<div style="z-index: 1; background-color:white; ">
					<h5 style="color:#0B525F; margin-left:20px; margin-top:20px; text-align:center;"><b>Datos del Medicamento</b></h5><hr/>
					<div style="display:inline-flex;" >
					<div style="margin-top: 30px; margin-left:500px; width:400px;">
					<form method="post">
						<div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Descripción</label>
					        <input type="text" class="form-control" name="descripcion" placeholder="Nombre" value="'.((isset($row->descripcion))?$row->descripcion:'').'" />
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Laboratorio</label>
					        <input type="text" class="form-control" name="laboratorio" placeholder="Nombre del laboratorio" value="'.((isset($row->descripcion))?$row->laboratorio:'').'"/>
					    </div>
					    <div class="form-group">
					        <label class="col-form-label" for="inputDefault" >Inventario</label>
					        <input type="number" class="form-control" name="inventario" placeholder="Cantidad en existencia" value="'.((isset($row->descripcion))?$row->inventario:'').'" />
					    </div><br/>
					';
					    
					    $result.=(isset($row->descripcion)?'<button style="margin-left:150px;" class="btn btn-sm- btn-primary">Actualizar</button><input type="hidden" name="id" value="'.$row->id_medicamento.'"/><input type="hidden" name="accion" value="medicamento.update"/>':'<button style="margin-left:210px;" class="btn btn-sm- btn-primary">Registrar</button><input type="hidden" name="accion" value="medicamento.insert" />');

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
		$result.='<div class="container" style="margin-top: 20px"><span style="font-family: Century Gothic; font-size: 0.8rem;" class="badge badge-pill badge-primary">Medicamentos</span><table class="table-hover" width=1100px;>';
		#cabecera de las columnas

		$result.='<tr class=table-info>';
		$result.='<td colspan="'.count($p_iconos).'">'.(($agregar)?'<a href="proceso-medicamento.php?accion=medicamento.new"><img id="add" src="../imagenes/img_trans.png"/></a>':"&nbsp;").'</td>';
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
				$result.='<td width="5%"><a href="proceso-medicamento.php?id='.$tupla[0].'&accion=medicamento.formEdit"><img id="edit" src="../imagenes/img_trans.png"/></td>';
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
$objetoMedicamento=new Medicamento();
?>
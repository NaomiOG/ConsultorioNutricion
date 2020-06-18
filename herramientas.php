<?php

/**
 * 
 */
class baseDatos
{
	#Los atributos en php sí se declaran, anteponiendo la palabra var.	
	var $cone; #conexión
	var $bloque; #trae los registros
	var $numTuplas; 
	var $clave;

	/**CONSTRUCTOR: El espacio entre function y los guiones es necesario.
	function __construct(argument) 
	{
		# code...
	}*/

	function inicializa($serv="us-cdbr-east-05.cleardb.net",$user="badf95cbb591fc",$puser="6ade9277",$bd="heroku_1974968533e0d0f"){ #Todo elemento de información dentro de un método es LOCAL (Pertenece AL MÉTODO). Por ello debe usarse this, para indicar que se hace referencia a un atributo DE LA CLASE 
		$this->cone=mysqli_connect($serv,$user,$puser,$bd);
		if ($this->cone==null) {
			exit;
		}
		
	}

	function consulta($query){
		$this->inicializa();
		$this->bloque=mysqli_query($this->cone,$query);
		
		if (strpos(strtoupper($query), "SELECT")!==false) { //Funciona para casos SELECT. Convierte el query a mayusculas ya que strpos no hace distinción entre mayusculas y minusculas.
			$this->numTuplas=mysqli_num_rows($this->bloque);

		}
		else{
			#Al hacer el insert necesitaremos el Id del registro que se insertó.
			#mysqli_affected_rows(); Cuántas filas fueron afectadas
		}
		$this->closeBD();
	}

	function saca_tupla($query){
		$this->consulta($query);
		return mysqli_fetch_object($this->bloque);

	}
	public function creaLista($tabla,$id,$campDesp,$campForm,$idSeleccionado=0){
			 
			 $result='<select class="form-control" name="'.$campForm.'" id="'.$campForm.'" >';
			 $query='select '.$id.','.$campDesp.' from '.$tabla.';';
			 $this->consulta($query);
			 foreach ($this->bloque as $registro) {
			 	$result.='<option value="'.$registro[$id].'"'.(($idSeleccionado==$registro[$id])?'selected':'').'>'.$registro[$campDesp].'</option>';
			 }
			 $result.='</select>';
			 return $result;
	}

	function despTabla($query,$agregar=false ,$p_iconos=array(),$p_colorRenglon="table-dark"){
		$this->consulta($query);
		$result="<div class='container'><table class='table'>";

		#cabecera de columnas
		$result.='<tr class="table-info">';
		$result.='<td colspan="'.count($p_iconos).'">'.(($agregar)?'<a href="?action=usuarios.new"><img src="../iconos/add_icon.png/></a>"':"&nbsp;").'</td>';

		for ($coluC=0; $coluC < mysqli_num_fields($this->bloque) ; $coluC++) { //cuenta el número de columnas del bloque
			$campo=mysqli_fetch_field_direct($this->bloque,$coluC); #recibe como para metros el bloque y la posición
			$result.='<th>'.$campo->name.'</th>';
		}
		$result.='</tr>';



		for ($contR=0; $contR < $this->numTuplas; $contR++) { //contR= contador de registros. Por cada registro se tendrá un renglón de tabla
			$result.='<tr '.(($contR%2)?'class="'.$p_colorRenglon.'"':'').'>';  //if corto. Para cambiar el color de un renglón.
			
			#iconos de acción
			if(in_array("delete", $p_iconos)) #Regresa cierto o falso
				$result.='<td><img src="../iconos/delete_icon.png"/></td>';
			if(in_array("edit", $p_iconos))
				$result.='<td><img src="../iconos/edit_icon.png"/></td>';
			if(in_array("add", $p_iconos))
				$result.='<td><img src="../iconos/add_icon.png"/></td>';
			
			$tupla=mysqli_fetch_array($this->bloque);
			//Mostrar la información de las columnas
			for ($coluC=0; $coluC < mysqli_num_fields($this->bloque) ; $coluC++) { //cuenta el número de columnas del bloque
				$result.='<td>'.$tupla[$coluC].'</td>';
			}

			

			$result.='</tr>';
		}
		$result.="</table></div>";
		return $result;
	}

	function generarPwd(){
		$this->clave="";
		$letras="ABCDEFGHJLMNPQRTUVWXYZ2345678923456789";
		for ($i=0; $i <8 ; $i++) { //para generar clave de 10 caracteres
			$this->clave.=$letras[rand()%strlen($letras)];
			//random me da un número que oscila entre cierto números, para generar un rango usamos el % seguido por un número límite del rango
		}
		//2. Enviar correo

		include("class.phpmailer.php");
		include("class.smtp.php");

	    $mail = new PHPMailer();//construccion del objeto
	    $mail->IsSMTP();//Indico que es de tipo conexión a un servidor de correos
	    $mail->Host="smtp.gmail.com"; //mail.google
	    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	    $mail->Port = 465;     // set the SMTP port for the GMAIL server
	    $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing)
	                              // 1 = errors and messages
	                              // 2 = messages only
	    $mail->SMTPAuth = true;   //enable SMTP authentication //pide credenciales
	    
	    $mail->Username =   "17030658@itcelaya.edu.mx"; // SMTP account username
	    $mail->Password = "naomi100_28101998";  // SMTP account password
	      
	    $mail->From="";
	    $mail->FromName="";
	    $mail->Subject = "Registro completo";//asunto
	    $mail->MsgHTML("<h1>BIENVENIDO ".$_POST['nombre']." ".$_POST['apellidos']."</h1><h2> Tu clave de acceso es : ".$this->clave."</h2>");
	    $mail->AddAddress($_POST['email']);
	    //$mail->AddAddress("admin@admin.com");//se agregan más si se tienen más destinatarios
	    if (!$mail->Send()){
	    	echo  "Error: " . $mail->ErrorInfo;
	    }
	    
	}

	function closeBD(){
		mysqli_close($this->cone);	
	}
	
}

$objetoBD=new baseDatos();
#$objBD->bloque; Accede al atributo "bloque" del objeto
#echo $objBD-> despTabla("select * from usuario",array("delete"));

?>


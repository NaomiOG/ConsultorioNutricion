
<?php
session_start();
include "class/classHome.php";
if (isset($_REQUEST['E'])) {

		$E=$_GET['E'];
	    switch ($E) {
	    	case 1:
	    	echo $objetoHome->historialCitas($_POST['filter'],$_SESSION['id']);
	    	break;
	    	case 2:
	    	include "header.php";
    		echo $objetoHome->formDieta($_GET['id'],$_GET['pid']);
	    	break;
	    	include "header.php";
	    	case 3:
	    	
	    	include "header.php";
    		echo $objetoHome->formExpediente($_GET['id'],$_GET['pid']);
	    	break;
	    }
	}
?>

	$(document).ready(function(){
		$( "#tipo" ).on('change',function(){
 				var filtro=$("#tipo").val();
 				console.log(filtro);
 				if($("#fecha").val()!=""){
 					var parametros=$("#formNew").serialize();
			          console.log(parametros+" Entre");
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=7", 
			                data: parametros,
			                success: function(result){
			                	console.log
			                 $("#horarios").html(result).show();
			                }
		         	});
 				}
 				else{
 					$("#tipo").val(-1);
 					$.alert('Debes ingresar una fecha');
 				}
			          
 		});
 			$("#insertar").click(function(){
	      		var parametros=$("#formNew").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=5", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#insertarExp").click(function(){
	      		var parametros=$("#datosExpediente").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=9", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#insertarDieta").click(function(){
	      		var parametros=$("#datosDieta").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=12", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#volver").click(function(){
	      	 	location.reload()
			        
	      	});
	      	$("#modificar").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=6", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#modificarExp").click(function(){
	      		var parametros=$("#datosExpediente").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=10", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#modificarDieta").click(function(){
	      		var parametros=$("#datosDieta").serialize();
	      		console.log("Estos son: "+parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=13", 
			                data: parametros,
			                 success: function(result){
			                 	console.log(result);
			               		$("#mensajes").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	
	      	$("#expediente").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=8", 
			                data: parametros,
			                 success: function(result){
			                 	 console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});
	      	$("#dieta").click(function(){
	      		var parametros=$("#formCitaEdit").serialize();
	      		console.log(parametros);
			          $.ajax({
			                type:"POST",
			                method:"POST",
			                url: "proceso-cita.php?E=11", 
			                data: parametros,
			                 success: function(result){
			                 	 console.log(result);
			               		$("body").html(result).show();
			                }
			                
		         		});
			        
	      	});

	});
	function llenarHora(id){
	      		hora=$("#btn"+id).val();	
	      		console.log(hora)        
	      		$("#hora").val(hora);
	 }

var num_est = 0;

function cambiar(){
	num_est = $("#num_est").val();
    if (num_est > 50 || num_est<10) {
       alert("El grupo debe tener entre 10 y 50 estudiantes para crearse")
    return true 
    }
	$("#cambiar").html("<a onclick='crearGrupo();' style='color: white ; padding: 7px 74px;' class='btn btn-success'>Crear</a>");
	$("#caja").html("<input id='nom_gru' placeholder='Grupo' type='text' class='form-control form-control-line'>");
}
function crearGrupo(){
	nom_gru = $("#nom_gru").val();
    if (nom_gru.length >2 || nom_gru.length==0) {
        alert("El grupo debe tener maximo dos digitos")
        return true
    }
   
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=6',
            dataType:  "JSON",
            data: {
            	nom_gru: nom_gru,
            	num_est: num_est
            }
        })
       .done(function(res){
        	console.log(res)
        	if (res=="existecodigoenmateria") {
        		alert("El nombre del grupo debe ser diferente, ya hay uno igual");
        	}else{
        		location.reload(true);
        	}
        })
        .fail(function(res){
        	console.log(nom_gru)
        	console.log(num_est)
        	alert('Hubo un error al crear el grupo');
        });
	
}
function actualizartabla(){
	$(document).ready(function(){
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionDocentes.php?x=6',
            dataType:  "JSON",
            data: {
                
            }
        })
       .done(function(listas){
         console.log(listas)
          $("#bodytable").html(listas);
        })
        .fail(function(x){
            
            alert('Hubo un error al cargar la lista de docentes');
        })
        
    });
}


function consultardoc(){
	$("#bodytable").html("");

	var ced = $("#cedula").val();
	if (ced!='') {
		$.ajax({
            type: "POST",
            url : '../Gestiones/GestionDocentes.php?x=5',
            dataType:  "JSON",
            data: {
            	ced:ced
            }
        })
       .done(function(res){
        	$("#bodytable").html(res);
        })
        .fail(function(res){
        	console.log(res)
        	alert('Hubo un error al buscar al docente');
        });
	}else{
		actualizartabla();
	}


}

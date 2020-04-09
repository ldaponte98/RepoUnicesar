function filtrar(){
 var est = $("#est").val()
 var asi = $("#asi").val()
 var gru = $("#gru").val()
 var cor = $("#cor").val()
 //Validaciones 
                  if (asi!=0 && est!=0 && gru!=0 && cor!=0) {
             //aegc
             cargarlistaxmateriaxestadoxgrupoxcor()
             }else if (asi!=0 && est!=0 && gru!=0 && cor==0) {
             //aeg
             cargarlistaxmateriaxestadoxgrupo()
             }else if (asi!=0 && est!=0 && gru==0 && cor!=0) {
             //aec
             cargarlistaxmateriaxestadoxcorte()
             }else if (asi!=0 && est!=0 && gru==0 && cor==0) {
               //ae
             cargarlistaxmateriaxestado()
             }else if (asi!=0 && est==0 && gru!=0 && cor!=0) {
               //agc
               cargarlistaxcorteyasiygru()
              
             }else if (asi!=0 && est==0 && gru!=0 && cor==0) {
               //ag
               cargarlistaxgrupo()
             }else if (asi!=0 && est==0 && gru==0 && cor!=0) {
               //ac
               cargarlistaxcorteyasi()
             }else if (asi!=0 && est==0 && gru==0 && cor==0) {
               //a
               cargarlistaxmateria()
             }else if (asi==0 && est!=0 && gru!=0 && cor!=0) {
               //ec
               cargarlistaxcorteyestado()
             }else if (asi==0 && est!=0 && gru!=0 && cor==0) {
               //e
               listaporestado()
             }else if (asi==0 && est!=0 && gru==0 && cor!=0) {
               //ec
               cargarlistaxcorteyestado()
             }else if (asi==0 && est!=0 && gru==0 && cor==0) {
               //e
               listaporestado()
             }else if (asi==0 && est==0 && gru!=0 && cor!=0) {
               //c
               cargarlistaxcorte()
             }else if (asi==0 && est==0 && gru!=0 && cor==0) {
               //x
               actualizartabla()
             }else if (asi==0 && est==0 && gru==0 && cor!=0) {
               //c
               cargarlistaxcorte()
             }else if (asi==0 && est==0 && gru==0 && cor==0) {
               //x
               actualizartabla()
             }

 
}




$(document).ready(function(){
actualizartabla()
cargarlistamaterias()
       $("#est").on('change', function(){
		      filtrar()
       })
       //
       $("#asi").on('change', function(){
       cargargrupos()
          filtrar()
       })
       //
       $("#gru").on('change', function(){
       	  filtrar()
       })

       $("#cor").on('change', function(){
        filtrar()
       })
})

function actualizartabla(){
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=11',
            dataType:  "JSON",
            data: {
            	
            }
        })
       .done(function(listas){
 
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
        	console.log(x)
        	alert('Hubo un error al cargar el formulario');
        })
}

function listaporestado(){
	
		var est = $("#est").val();
		if (est!=0) {
            if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=12',
            dataType:  "JSON",
            data: {
            	est : est
            }
        })
       .done(function(listas){
 
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
        	console.log(x)
        	alert('Hubo un error al cargar el formulario');
        })
	}else{
		actualizartabla()
	}
}
function cargarlistamaterias(){
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=13',
            dataType:  "JSON",
            data: {
            
            }
        })
       .done(function(listas){
 if (listas=='0') { actualizartabla()}else{
          $("#asi").html(listas);}
        })
        .fail(function(x){
        	console.log(x)
        	alert('Hubo un error al cargar el formulario');
        })
}

function cargargrupos(){
	
        var cod_asi  = $("#asi").val();
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=14',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi
            }
        })
       .done(function(listas){
          $("#gru").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
   
}

function cargarlistaxmateria(){
	var cod_asi  = $("#asi").val();
	if (cod_asi!=0) {
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=15',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
    	actualizartabla();
    }
}

function cargarlistaxgrupo(){
	
	var cod_gru  = $("#gru").val();
	if (cod_gru!=0) {
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=16',
            dataType:  "JSON",
            data: {
                cod_gru: cod_gru
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
    	actualizartabla();
    }
}

function cargarlistaxmateriaxestado(){
	var cod_asi  = $("#asi").val();
	var est = $("#est").val();
  if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
	if (cod_asi!=0) {
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=17',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi,
                est : est

            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
    	actualizartabla();
    }
}

function cargarlistaxmateriaxestadoxgrupo(){
	var cod_gru  = $("#gru").val();
	var cod_asi  = $("#asi").val();
	var est = $("#est").val();
  if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
	if (cod_asi!=0) {
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=18',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi,
                est : est,
                cod_gru : cod_gru

            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
    	actualizartabla();
    }
}

function validarfecha(){
	$.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=19',
            dataType:  "JSON",
            data: {
              
            }
        })
       .done(function(data){
          if (data=="corte1") {
          	location.href = '../Gestiones/seguimientoasignatura.php?g=1'
          }else if (data=="corte2") {
          	location.href = '../Gestiones/seguimientoasignatura.php?g=2'
          }else if (data=="corte3") {
          	location.href = '../Gestiones/seguimientoasignatura.php?g=3'
          }else if (data=="nogrupo") {
            $("#mensaje").html("Usted no tiene grupos asignados");
            $("#mensaje").fadeIn();
          }else{

          	$("#mensaje").fadeIn();
          }
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
}	

$(document).ready(function(){
	$("#mensaje").click(function(){
		$("#mensaje").fadeOut();
	})
})

function validarfechaeditar(cod,corte){
  $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=28',
            dataType:  "JSON",
            data: {
                cod: cod,
                corte : corte,
            }
        })
       .done(function(x){
          if (x=="nopuede") {
            $("#mensaje").html("Fuera de la fecha para editar");
            $("#mensaje").fadeIn();
          }else{
            location.href = "EditarSeguimiento.php?x="+cod;
            $("#mensaje").fadeOut();
          }
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error');
        })
}

function cargarlistaxcorte(){
  var cor  = $("#cor").val();
  if (cor!=0) {
  $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=30',
            dataType:  "JSON",
            data: {
                cor : cor
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
      actualizartabla();
    }
}

function cargarlistaxmateriaxestadoxgrupoxcor(){
    var cod_gru  = $("#gru").val();
    var cod_asi  = $("#asi").val();
    var est = $("#est").val();
    var cor = $("#cor").val();
    if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
    if (cod_asi!=0) {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=23',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi,
                est : est,
                cod_gru : cod_gru,
                cor : cor
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}


function cargarlistaxcorteyestado(){
    var cor  = $("#cor").val();
    var est = $("#est").val();
    if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
    if (cor!=0) {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=31',
            dataType:  "JSON",
            data: {
                cor: cor,
                est : est
            }
        })
       .done(function(listas){
       
          $("#bodytablemiseguimiento").html(listas);
          fun = "9"
          esta = est
          corte = cor
          
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
    }
}

function cargarlistaxcorteyasi(){
    var cor  = $("#cor").val();
    var cod_asi = $("#asi").val();
   
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=32',
            dataType:  "JSON",
            data: {
                cor: cor,
                cod_asi : cod_asi
            }
        })
       .done(function(listas){
       
          $("#bodytablemiseguimiento").html(listas);
         

        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
   
}

function cargarlistaxmateriaxestadoxcorte(){
    var cod_asi = $("#asi").val();
    var est = $("#est").val();
    var cor = $("#cor").val();
    if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=37',
            dataType:  "JSON",
            data: {
                cod_asi: cod_asi,
                est : est,
                cor : cor
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    
}

function cargarlistaxcorteyasiygru(){
    var cor  = $("#cor").val();
    var cod_asi = $("#asi").val();
    var gru = $("#gru").val();
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=38',
            dataType:  "JSON",
            data: {
                cor: cor,
                gru : gru,
                cod_asi : cod_asi
            }
        })
       .done(function(listas){
       
          $("#bodytablemiseguimiento").html(listas);
         

        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
   
}




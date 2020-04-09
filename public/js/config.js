$(document).ready(function(){
    $("#cod").on('change', function(){

        var cod  = $("#cod").val();
        
         $.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=1',
            dataType:  "JSON",
            data: {
                cod: cod
            }
        })
       .done(function(tabla){
          $("#tablauni").html(tabla); 
              
        })
        .fail(function(){
            
        })
    })     
});

function agregar(){
	var cod = $("#cod").val();
	var uni = $("#uni").val(); 
  
	$.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=2',
            dataType:  "JSON",
            data: {
                cod: cod,
                uni: uni
            }
        })
       .done(function(x){
        if (x=="guardo") {
          location.href="GestionUnidades.php?x="+cod
        }      
        }).fail(function(){
            alert("error")

        }) 
}
function agregarEje(){
  var cod_uni = $("#cod").val();
  var eje = $("#eje").val(); 
  
  $.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=8',
            dataType:  "JSON",
            data: {
                cod_uni: cod_uni,
                eje: eje
            }
        })
       .done(function(x){
        if (x=="guardo") {
          location.href="GestionEjes.php?x="+cod_uni
        }      
        }).fail(function(){
            alert("error")

        }) 
}
function eliminar(codigo){
	var cod_asi = $("#cod").val();
	$.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=3',
            dataType:  "JSON",
            data: {
                codigo: codigo,
                cod_asi: cod_asi
            }
        }).done(function(t){
       	  location.reload(true);
       	          
        }).fail(function(){
        	
           
        }) 
}
function eliminarEje(codigo){
  var cod_uni = $("#cod").val();
  $.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=10',
            dataType:  "JSON",
            data: {
                codigo: codigo,
                cod_uni: cod_uni
            }
        }).done(function(t){
          location.reload(true);
                  
        }).fail(function(){
          
           
        }) 
}

function convertir(fecha) {
        var info = fecha.split('/').reverse().join('-');
        return info;
   }

function guardaroactualizarfechas(){
    var periodo = $("#periodo").val();
    var fecinise = convertir($("#fechinise").val());
    var fecfinse = convertir($("#fechfinse").val());
    var fecini1 = convertir($("#1fechini").val());
    var fecfin1 = convertir($("#1fechfin").val());
    var fecini2 = convertir($("#2fechini").val());
    var fecfin2 = convertir($("#2fechfin").val());
    var fecini3 = convertir($("#3fechini").val());
    var fecfin3 = convertir($("#3fechfin").val());
    var cont = 0;

    if (fecinise>fecfinse) {
      $("#msg5").fadeIn();
      $("#msg1").fadeIn();
      cont++;
    }else{
       $("#msg5").fadeOut();
      $("#msg1").fadeOut();
    }

    if (fecini1>fecfin1) {
      $("#msg5").fadeIn();
      $("#msg2").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
      
    }

    if (fecini2>fecfin2) {
      $("#msg5").fadeIn();
      $("#msg3").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
     
    }

    if (fecini3>fecfin3) {
      $("#msg5").fadeIn();cont++;
      $("#msg4").fadeIn();
    }else{
       $("#msg5").fadeOut();
      
    }

    if (fecini1<fecinise || fecini1>fecfinse ) {
      $("#msg5").fadeIn();
      $("#msg2").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
      
    }

    if (fecfin1>fecfinse) {
      $("#msg5").fadeIn();
      $("#msg2").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
    }

    if (fecini2<fecinise || fecini2<fecfin1) {
      $("#msg5").fadeIn();cont++;
      $("#msg3").fadeIn();
    }else{
       $("#msg5").fadeOut();
    }

    if (fecfin2>fecfinse) {
      $("#msg5").fadeIn();
      $("#msg3").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
    }

    if (fecini3<fecinise || fecini3<fecfin2) {
      $("#msg5").fadeIn();
      $("#msg4").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
    }

    if (fecfin3>fecfinse) {
      $("#msg5").fadeIn();
      $("#msg4").fadeIn();cont++;
    }else{
       $("#msg5").fadeOut();
    }

if (cont<1) {
    $("#msg1").fadeOut();
    $("#msg2").fadeOut();
    $("#msg3").fadeOut();
    $("#msg4").fadeOut();
    $("#msg5").fadeOut();
    $.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=4',
            dataType:  "JSON",
            data: {
               periodo : periodo,
               fecinise: fecinise, 
               fecfinse: fecfinse, 
               fecini1 : fecini1,
               fecfin1 : fecfin1,
               fecini2 : fecini2,
               fecfin2 : fecfin2,
               fecini3 : fecini3,
               fecfin3 : fecfin3
            }
        }).done(function(resp){
          if (resp=="actualizo") {
            alert("Fechas Actualizadas Correctamente");
            location.reload() = true
          }else{
            alert("Error de datos de entrada");            
          }
                 
        }).fail(function(){
            alert("Error de excepcion fail")
           
        }) 
}


}
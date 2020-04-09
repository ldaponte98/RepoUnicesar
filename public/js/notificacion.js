$(document).ready(function(){
	$.ajax({
            type: "POST",
            url : '../Gestiones/ManejoConfig.php?x=9',
            dataType:  "JSON",
            data: {
            }
        })
       .done(function(x){
      console.log(x)
 		if (x!="no"){
      if (x[0] == "F") {
        swal({
            title: "Aviso",
            text: x,
            icon: "warning",
            
           })

            $("#mensajewey").html(x)
            $("#men").fadeIn();
         
          }else{
             
            $("#mensajewey").html(x)
            $("#men").fadeIn();
          }
        }else{
             $("#men").fadeOut();
          }
        }).fail(function(x){
        	
        })
})

  $(document).ready(function(){

       // setInterval(function(){
            $.ajax({
            type: "POST",
            url : '../Gestiones/GestionNotificaciones.php?x=1',
            dataType:  "JSON",
            data: {
               
            }
        })
       .done(function(noti){
          $("#notificaciones").html(noti); 
              
        })
        .fail(function(){
            alert("error al cargar notificaciones")
        })

        //Ahora para el boton de notificaciones
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionNotificaciones.php?x=2',
            dataType:  "JSON",
            data: {
               
            }
        })
       .done(function(x){
            $("#notify").html(x);   
        })
        .fail(function(){
            alert("error al cargar formulario")
        })
       // },5000);

        //fin--------------------------------------------------------------
         $("#btnnoti").click(function(){
            $.ajax({
            type: "POST",
            url : '../Gestiones/GestionNotificaciones.php?x=3',
            dataType:  "JSON",
            data: {
               
            }
        })
       .done(function(x){
        if (x=="ok") {
            $("#notify").html("");
        }     
        })
        .fail(function(){
            
        })
        })
       //fin $("#btnnoti")
      
        })
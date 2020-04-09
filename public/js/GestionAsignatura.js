$(document).ready(function(){
   
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=24',
            dataType:  "JSON",
            data: {
               
            }
        })
       .done(function(unidades){
          $("#programas").html(unidades);          
        })
        .fail(function(x){
            console.log(x);
        })
            
});

function agregar(){
     var listapro = new Array();
     var cod = $("#cod").val();
     var nom = $("#nom").val();
     var cre = $("#cre").val();
     if (cod.length<5 || cod.length >7) {
        alert("El codigo debe estar entre 5 y 7 caracteres")
        return true
     }
     if (nom.length<2 || nom.length >60) {
        alert("El nombre debe estar entre 2 y 60 caracteres")
        return true
     }
     if (cre<1 || cre >5) {
        alert("los creditos debe estar entre 1 y 5")
        return true
     }
     for (var i = 1; i < 50; i++) {
    var p = $("#pro"+i).val();
    if (!p) {
        i=50;
    }else if ($("#pro"+i).prop('checked')){  
    listapro.push(p);
      }
     if (listapro.length==0) {
            alert("Debe seleccionar nuevos programas");
            return true;
        }    
    }
    if (cod=="" || nom=="" || cre=="" || listapro.length==0) {
         alert("Campos vacios o sin seleccionar");

    }else{
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=25',
            dataType:  "JSON",
            data: {
               cod : cod,
               nom : nom,
               cre : cre,
               listapro : listapro
            }
        })
       .done(function(x){
        console.log(x);
        if (x=="guardo") {
            alert("Asignatura Creada");
            location.href = "Asignaturas.php"
        }else if (x=="nonumero") {
            alert("Error. El codigo debe ser alfanumerico");
        }else if (x=="nomayus") {
            alert("Error. El codigo debe ser con letras mayusculas");
        }else if (x=="maltacre") {
            alert("Error. El numero de creditos de estar entre 1 y 5");
        }else{
            alert("Error. El numero no es valido");
        }
          
        })
        .fail(function(x){
            alert("Error. No ha podido realizarce la solicitud");
            
        })

        }
    }



function editar(){
     var listapro = new Array();
     var cod_act = $("#cod_act").val();
     var cod = $("#cod").val();
     var nom = $("#nom").val();
     var cre = $("#cre").val();

      if (cod.length<5 || cod.length >7) {
        alert("El codigo debe estar entre 5 y 7 caracteres")
        return true
     }
     if (nom.length<2 || nom.length >60) {
        alert("El nombre debe estar entre 2 y 60 caracteres")
        return true
     }
     if (cre<1 || cre >5) {
        alert("los creditos debe estar entre 1 y 5")
        return true
     }
     
    for (var i = 1; i < 50; i++) {
    var p = $("#pro"+i).val();
    if (!p) {
        i=50;
    }else if ($("#pro"+i).prop('checked')){  
    listapro.push(p);
      }
    }
     if (listapro.length==0) {
            alert("Debe seleccionar nuevos programas");
            return true;
        }
    if (cod=="" || nom=="" || cre=="") {
         alert("Campos vacios o sin seleccionar");

    }else{
    var men = confirm("Asegurate de escoger los programas a editar correctamente ya que los anteriores seran eliminados");
    if (men){
        if (listapro.length==0) {
            alert("Debe seleccionar nuevos programas");
        }else{
         $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=27',
            dataType:  "JSON",
            data: {
               cod_act : cod_act,
               cod : cod,
               nom : nom,
               cre : cre,
               listapro : listapro
            }
        })
       .done(function(x){

        if (x=="actualizo") {
            alert("Cambios guardados");
            location.href = "Asignaturas.php?x=cod";
        }else{
            alert("Error. Hubo un error al actualizar los datos");
        }
          
        })
        .fail(function(x){
            alert("Error. No ha podido realizarce la solicitud");
            
        })
        }
    }else{

    }

}
}
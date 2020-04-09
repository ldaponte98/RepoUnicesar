

$(document).ready(function(){


    http://68.183.25.78/api/authenticate
    $("#bd").click(function(){
        $("#mensajeusu").fadeOut();
        $("#mensajecon").fadeOut();
        $("#mensajeprincipal").fadeOut();
    })
});

function logearse(){

        var usu = $("#usuhtml").val();
        var pass = $("#passhtml").val();
        if (usu.length > 20 || usu.length < 6) {
            $("#mensajeusu").html("Entre 6 y 20 caracteres")
        $("#mensajeusu").fadeIn();
            return false;
        }else{
            $("#mensajeusu").html("Campo vacio")
            $("#mensajeusu").fadeOut();
        }
        if (usu=="") {
            $("#mensajeusu").fadeIn();
            return false;
        }else{
            $("#mensajeusu").fadeOut();
        }
        if (pass=="") {
            $("#mensajecon").fadeIn();
            return false;
        }
        else{
            $("#mensajecon").fadeOut();
        }
      

      $.ajax({
            url: "http://68.183.25.78/api/authenticate",
            type: "POST",
            dataType : "JSON",
            data:{
                email : usu,
                password : pass
            }
        })
       .done(function(x){
        console.log(x)
        
            if (x == "admin") {
                
                        location.href = "Administrador/admin.php";
                        $("#usuhtml").val("");
                        $("#usuhtml").required();
                        $("#passhtml").val("");
                
                
                }else if (x == "usu"){
                        location.href = 'Usuario/EditarDocenteUsu.php';
                   
                }else if (x=="noexiste") {
                     $("#mensajeprincipal").fadeIn();
                    return false;
                }else if (x=="cambiopass") {
                    location.href = 'Usuario/user.php';
                }else if (x=="malpass") {
                    $("#mensajecon").html("Contraseña Invalida")
                    $("#mensajecon").fadeIn();
                    return false;
                }
                else{
                     $("#mensajeprincipal").fadeOut();
                }
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al ingresar');
        })
}



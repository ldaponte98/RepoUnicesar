var op = 0

$(document).ready(function () {
    op = $("#opcion").val()
    switch(op){
        case "1":
        actualizartabla();
        break;
        case "2":
        
        listaporestado();
        break;
        case "3":
        cargarlistaxmateria();
        break;
        case "4":
        cargarlistaxgrupo();
        break;
        case "5":
        cargarlistaxmateriaxestado();
        break;
        case "6":
        cargarlistaxmateriaxestadoxgrupo();
        break;
        case "7":
        cargarlistaxmateriaxestadoxgrupoxcor();
        break;
        case "8":
        cargarxcorte();
        break;
        case "9":
        cargarlistaxcorteyestado();
        break;
        case "10":
        cargarlistaxcorteyasi();
        break;
    }
})

function actualizartabla(){
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=20',
            dataType:  "JSON",
            data: {
                
            }
        })
       .done(function(listas){
 
          $("#tabla").html(listas);
          
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar la tabla requerida');
        })
}

function listaporestado(){
    
        var est = $("#est").val();
        if (est!=0) {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=12',
            dataType:  "JSON",
            data: {
                est : est
            }
        })
       .done(function(listas){
 
          $("#tabla").html(listas);
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla()
    }
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
         $("#tabla").html(listas);
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
         $("#tabla").html(listas);
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
         $("#tabla").html(listas);
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
          $("#tabla").html(listas);
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
          $("#tabla").html(listas);
          
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}

function cargarxcorte(){
    var cor  = $("#cor").val();
    
    if (cor!=0) {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=30',
            dataType:  "JSON",
            data: {
                cor: cor
            }
        })
       .done(function(listas){
       
          $("#tabla").html(listas);
          
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
       
          $("#tabla").html(listas);
        
          
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}

function cargarlistaxcorteyasi(){
    var cor  = $("#cor").val();
    var cod_asi = $("#asi").val();
    if (cor!=0) {
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
       
          $("#tabla").html(listas);
        

        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}
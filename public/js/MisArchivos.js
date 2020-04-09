var fun = "0", grupo= "0", asig= "0", esta= "0", corte = "0"

  $(document).ready(function () {
   $('#ced').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#bodytablemiseguimiento tr').hide();
        $('#bodytablemiseguimiento tr ').filter(function () {
            return rex.test($(this).text());
        }).show();

        })

$('#fech').keyup(function () {
         
      var rex = new RegExp($(this).val(), 'i');
        $('#bodytablemiseguimiento tr').hide();
        $('#bodytablemiseguimiento tr ').filter(function () {
            return rex.test($(this).text());
        }).show();

        })
    

     

});

  function imprimirlista(){
   location.href="imprimiradmin.php?fun="+fun+"&gru="+grupo+"&asi="+asig+"&est="+esta+"&cor="+corte
  }


function masfiltros(){
    if($("#btnfil").html()=="Mas filtros"){
        $("#btnfil").html("Menos filtros");
        document.getElementById("btnfil").className = "btn pull-left btn-success";
        document.getElementById("btnlistar").className = "btn pull-left btn-info";
        document.getElementById("segundofil").style.display='';
        $("#segundofil").fadeIn();
    }else{
        $("#btnfil").html("Mas filtros")
        document.getElementById("btnfil").className = "btn pull-left btn-info";
         document.getElementById("btnlistar").className = "btn pull-left btn-success";
        $("#segundofil").fadeOut();
    }
}


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
            url : '../Gestiones/GestionAsignatura.php?x=20',
            dataType:  "JSON",
            data: {
                
            }
        })
       .done(function(listas){
 
          $("#bodytablemiseguimiento").html(listas);
          fun = "1"
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
          fun = "2"
          esta = est
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
            data:
             {
                cod_asi: cod_asi
            }
        })
       .done(function(listas){
          $("#bodytablemiseguimiento").html(listas);
          fun = "3"
          asig = cod_asi
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
          fun = "4"
          grupo=cod_gru
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
          fun = "5"
          asig = cod_asi
          esta = est
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
          fun = "6"
          esta=est
          asig = cod_asi
          grupo = cod_gru
        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}

    
function cargarxcedula(){
    var ced  = $("#ced").val();
    
    if (ced!=0) {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=21',
            dataType:  "JSON",
            data: {
                ced: ced
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

function cargarlistaxcedxestado(){
    var ced  = $("#ced").val();
    var est = $("#est").val();
    if (est=="Pendiente") {
                $("#textofec").html("Retraso")
            }else{
                $("#textofec").html("Fecha de envio")
            }
    if (ced!='') {
    $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=22',
            dataType:  "JSON",
            data: {
                ced: ced,
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
          fun = "7"
          esta=est
          asig = cod_asi
          grupo = cod_gru
          corte = cor
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
       
          $("#bodytablemiseguimiento").html(listas);
          fun = "8"
          corte = cor
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
       
          $("#bodytablemiseguimiento").html(listas);
          fun = "10"
          corte = cor
          asig = cod_asi

        })
        .fail(function(x){
            console.log(x)
            alert('Hubo un error al cargar el formulario');
        })
    }else{
        actualizartabla();
    }
}





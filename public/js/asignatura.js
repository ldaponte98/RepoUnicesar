//aqui lleno lista de materias
/*$(document).ready(function(){
	

		var idfac  = $("#fac").val();
		$.ajax({
            type: "POST",
            url : 'http://localhost/ProyectoSotfware/Paginas/GestionAsignatura.php?x=1',
            dataType:  "JSON",
            data: {
            
            }
        })
       .done(function(listas){
 
          $("#asi").html(listas);
        })
        .fail(function(x){
        	console.log(x)
        	alert('Hubo un error al cargar el formulario');
        })
	})
     
   
//aqui cargo las materias exclusivmente del maesstro
$(document).ready(function(){
    $("#asi").on('change', function(){
        $("#gru").val('0');
        $("#cre").val(0);
        var cod_asi  = $("#asi").val();
        $.ajax({
            type: "POST",
            url : 'http://localhost/ProyectoSotfware/Paginas/GestionAsignatura.php?x=9',
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
    })
        
    });
     
//aqui  asigno el valor de creditos por la mateia obtenida
$(document).ready(function(){
    $("#asi").on('change', function(){

        var idasi  = $("#asi").val();
        
        $.ajax({
            type: "POST",
            url : 'http://localhost/ProyectoSotfware/Paginas/GestionAsignatura.php?x=2',
            dataType:  "JSON",
            data: {
                idasi: idasi
            }
        })
       .done(function(creditos){
          $("#cre").val(creditos);
          
        })
        .fail(function(){
            console.log(idfac)
        })
        
    })     
});

//aqui llamo el numero inicial  de estudiantes asignados por grupo
$(document).ready(function(){
    $("#gru").on('change', function(){

        var gru  = $("#gru").val();
        
        $.ajax({
            type: "POST",
            url : 'http://localhost/ProyectoSotfware/Paginas/GestionAsignatura.php?x=10',
            dataType:  "JSON",
            data: {
                gru: gru
            }
        })
       .done(function(numero){
          $("#numestini").val(numero);
          $("#numest").val(numero); 
        })
        .fail(function(){
          $("#numestini").val("0");
        })
        
    })     
});
*/

//aqui llamo las unidades por materia
$(document).ready(function(){
        var idasi  = $("#asi").val();
        
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=3',
            dataType:  "JSON",
            data: {
                idasi: idasi
            }
        })
       .done(function(unidades){
          $("#unidades").html(unidades);
          $("#des").val("0%");
          
        })
        .fail(function(){
            console.log(idasi);
        })
        
         
});
var contuni=0
function undiotodas(){
    contuni=0
    var t = $("#todas").val();
    if ($("#todas").prop('checked')){
                    for (var i = 1; i < 50; i++) {
                var u = $("#uni"+i).val();
                if (!u) {
                    i=50;
                }else{  
                    document.getElementById("uni"+i).checked = true; 
                    contuni=contuni+1
                }
                }
                enviardesa()
    }else{
        for (var i = 1; i < 50; i++) {
                var u = $("#uni"+i).val();
                if (!u) {
                    i=50;
                }else{  
                    document.getElementById("uni"+i).checked = false;
                     
                }
                }
                enviardesa()
    }
   sacardesarrollo()
}
function undiotodosejes(unidad){
if ($("#todosejesuni"+unidad).prop('checked')){
        for (var i = 1; i < 35; i++) {
            if (! $("#eje"+unidad+i).val()) {
                i=35
            }else{
            document.getElementById("eje"+unidad+i).checked = true; 
            }
        }
}else{
    for (var i = 1; i < 35; i++) {
        if (! $("#eje"+unidad+i).val()) {
                i=35
            }else{
            document.getElementById("eje"+unidad+i).checked = false;
            } 
    }
}
sacardesarrollo()
   
}
//aqui establesco el desarrollo idal dependiendo el corte q lleve
$(document).ready(function(){
    $("#cor").on('change', function(){

        var corte  = $("#cor").val();
        if (corte=='1') {
           
            $("#desideal").val("100%");

            
        }else if (corte=='2') {
            $("#desideal").val("100%");
        }   
    })     
});
//relacion entre o real y lo ideal
$(document).ready(function(){
    $("#des").on('change', function(){
         alert(des);
        var des  = $("#des").val();
        var desideal = $("#desideal").val();

       
           
      
    })     
});
//aqui establezco las codiciones de los numeros de estudiantes
$(document).ready(function(){
    $("#apr").on('change', function(){
        var numest = $("#numest").val();
        var i  = $("#apr").val();
        if (numest=="") {

        }else{
        var t = numest - i;
        if (t<0) {
            $("#apr").val(numest);
            $("#rep").val('0');        }else{
        $("#rep").val(t);
        }
      }
    })     
});
var contcausas = 0
function agregarcausa(){
    for (var i = 1; i < 50; i++) {
    var c = $("#cau"+i).val();
    if (!c) {
    $("#causas").html($("#causas").html()+"<br><input  id='cau"+i+"' value='Otra' style='margin-left: 28; width: 400;' placeholder='Otra'  type='text' class='form-control form-control-line'>")
     contcausas++
     i=50
     }else{
        contcausas++
     }
    }
}
var contana=5
function agregaranalisis(){
    for (var i = 1; i < 50; i++) {

    var c = $("#ana"+i).val();
    if (!c) {
    $("#Analisis").html($("#Analisis").html()+"<br><input  id='ana"+i+"' value='Otro' style='margin-left: 28; width: 400;' placeholder='Otro' type='text' class='form-control form-control-line'>")
      contana = i
      i=50
     }
    }
}
function probaranalisis(){
    var listaana = new Array();
    for (var i = 1; i <= contana; i++) {
    var c = $("#ana"+i).val();
    if (!c) {
        
    }else if ($("#ana"+i).val()!="Otro" && c.length!=0) {
        if (i<6) {
             if ($("#ana"+i).prop('checked')){     
              listaana.push(c);
             }
        }else{
           listaana.push(c); 
        }  
    }
    }

    console.log(listaana)
}
function probarcausas(){
    var listacau = new Array();
    for (var i = 1; i < 50; i++) {
    var c = $("#cau"+i).val();
    if (!c) {
        i=50;
    }else if ($("#cau"+i).val()!="Otra" && $("#cau"+i).val()!="") {
        if (i<11) {
             if ($("#cau"+i).prop('checked')){     
              listacau.push(c);
            }
        }else{
           listacau.push(c); 
        }  
    }
    }

    console.log(listacau)
}



function guardar(){
    var cod_seg = $("#cod_seg").val();
    var cor = $("#cor").val(); 
    var asi = $("#asi").val();
    var cre = $("#cre").val();
    var gru = $("#gru").val();
    
    var numest = $("#numest").val();
    var numestini = $("#numestini").val();
    //lista de unidades desarrolladas y programadas
    var listauni = new Array();
    var listaejedesa = new Array();
    var des = $("#des").val();
    var desideal = $("#desideal").val();
    var listacau = new Array();
    var listaana = new Array();

    var R = $("#R").val();
    var prom = $("#prom").val();
    var apr = $("#apr").val();
    var rep = $("#rep").val();
    var ana = $("#ana").val();
    var estdi = $("#estdi").val();
    var estev = $("#estev").val();
    var est100 = $("#est100").val();
    var eficri = $("#eficri").val();
    var sug = $("#sug").val();

    if (numest.length<1) {
    alert("El campo de numero de estudiantes asistentes debe completarlo")
    return 0;
    }
    if (numestini<numest || numest<1) {
    alert("El campo de ´numero de estudiantes asistentes´ no puede sobrepasar el valor de estudiantes iniciales o menor a 1. Por favor verificar ")
    return 0;
    }
    if (prom<=0 || prom>5) {
    alert("El campo de ´promedio de las notas´ no puede sobrepasar el valor de 5 , tampoco por debajo o igual de 0. Porfavor verificar ")
    return 0;
    }
    if (apr.length<1) {
    alert("El campo de ´N° Aprobados´ debe completarlo")
    return 0;
    }
    if (estdi.length<1) {
    alert("El campo de ´Estrategias didacticas exitosas que desee compartir con sus colegas´ debe completarlo. Dato necesario para el analisis del seguimiento ")
    return 0;
    }
    if (estev.length<1) {
    alert("El campo de ´Estrategias evaluativas exitosas que desee compartir con sus colegas´ debe completarlo. Dato necesario para el analisis del seguimiento ")
    return 0;
    }
    if (eficri.length<1) {
    alert("El campo de ´Si el porcentaje de eficiencia es critico, estrategias (no reducir rigor academico ni cientifico) para mejor eficiencia academica´ debe completarlo. Dato necesario para el analisis del seguimiento ")
    return 0;
    }

    //Aqui lleno las listas de unidades, ejes, causas y analisis
    for (var i = 1; i < 50; i++) {
    var u = $("#uni"+i).val();
    if (!u) {
        i=50;
    }else if ($("#uni"+i).prop('checked')){  

    listauni.push(u);
      }
    }
    for (var i = 1; i < 50; i++) {
    var c = $("#cau"+i).val();
    if (!c) {
        i=50;
    }else if ($("#cau"+i).val()!="Otra" && $("#cau"+i).val()!="") {
        if (i<11) {
             if ($("#cau"+i).prop('checked')){     
              listacau.push(c);
            }
        }else{
           listacau.push(c); 
        }  
    }
    }
    for (var i = 1; i <= contana; i++) {
    var c = $("#ana"+i).val();
    if (!c) {
        
    }else if ($("#ana"+i).val()!="Otro" && c.length!=0) {
        if (i<6) {
             if ($("#ana"+i).prop('checked')){     
              listaana.push(c);
             }
        }else{
           listaana.push(c); 
        }  
    }
    }
    for (var i = 0; i <= 40; i++) {
        for (var j = 1; j <=40 ; j++) {
            if ($("#eje"+i+j).val()) {
                if ($("#eje"+i+j).prop('checked')) {
                    listaejedesa.push($("#eje"+i+j).val());
                }
           }else{
            j=41;
           }  
        }
    }
    if (listauni.length==0) {
        listauni.push("Ninguna"); 
    }
    if (listaejedesa.length==0) {
        listaejedesa.push("Ninguna"); 
    }
    if (listacau.length==0) {
        listacau.push("Ninguna"); 
    }
    if (listaana.length==0) {
        listaana.push("Ninguna"); 
    }
    if (sug.length<1) {
        sug="Ninguna sugerencia"
    }
    if (est100.length<1) {
        est100="Se desarrollo todo lo programado"
    }

    

    //envio d datos
     $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=4',
            dataType:  "JSON",
            data: {
               cod_seg : cod_seg,
               cor : cor,
               asi : asi,
               cre : cre,
               gru : gru,
               numest : numest,
               listauni : listauni,
               listaejedesa : listaejedesa,
               des : des,
               desideal : desideal,
               listacau : listacau,
               listaana : listaana,
               R : R,
               prom : prom,
               apr : apr,
               rep : rep,
               ana : ana,
               estdi : estdi,
               estev : estev,
               est100 : est100,
               eficri : eficri,
               sug : sug
            }
        })
       .done(function(x){
        console.log(listacau)
        console.log(x);
        if (x=="guardo") {
            alert("Archivo registado correctamente");
            location.href = "miseguimientos.php"
        }
          
        })
        .fail(function(x){
            alert("Error. No ha podido realizarce la solicitud");
            console.log(x);
        })

}
function verejes(){
    for (var i = 0; i <= 20; i++) {
        for (var j = 1; j <=20 ; j++) {

            if ($("#eje"+i+j).val()) {
                if ($("#eje"+i+j).prop('checked')) {
                    alert($("#eje"+i+j).val()) 
                }
               
           }else{
            j=21;
           }  
        }
    }
}



function enviardesa(){
    var lista = new Array();
        for (var i = 1; i < 50; i++) {
        if ($("#uni"+i).prop('checked')){  
            u = $("#uni"+i).val();
            if (!u) {i=50;}else{
            lista.push(u);
            }
        }        
       }
      
        if (contuni!=lista.length || contuni==0) {
            document.getElementById("todas").checked = false;              
        }else{
            document.getElementById("todas").checked = true;                    
        }
if (lista.length!=0) {

        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=5',
            dataType:  "JSON",
            data: {
               
               lista : lista

            }
        })
       .done(function(x){
        
        $("#unidadesdesarrolladas").html(x);
          
        })
        .fail(function(x){
            console.log(x);
        })
}else{
    $("#unidadesdesarrolladas").html("");
}

    
   
}


function sacardesarrollo(){
    var listaejepro = new Array();
       for (var i = 0; i <= 20; i++) {
        for (var j = 1; j <=20 ; j++) {
            if ($("#eje"+i+j).val()) {
                    listaejepro.push($("#eje"+i+j).val());
           }else{
            j=21;
           }  
        }
    }

    var listaejedesa = new Array();
       for (var i = 0; i <= 20; i++) {
        for (var j = 1; j <=20 ; j++) {
            if ($("#eje"+i+j).val()) {
                if ($("#eje"+i+j).prop('checked')) {
                    listaejedesa.push($("#eje"+i+j).val());
                }
           }else{
            j=21;
           }  
        }
    }
    totalpro = listaejepro.length;
    totaldesa = listaejedesa.length;



    total = (totaldesa/totalpro) * 100;
    total = total.toFixed(2);
    var rtotal =String(100-total)
    if (total==null) {
        total = 0
        rtotal = 0
    }
    var mensaje = total.substring(0,5)
    if (mensaje=="NaN") {
        $("#des").val("0%");
        $("#R").val("0%");
        document.getElementById("est100").disabled=false;
    }else{
     $("#des").val(total.substring(0,5)+"%");
    
    $("#R").val(rtotal.substring(0,5)+"%");
    if (100-total==0) {
        
        document.getElementById("est100").disabled=true;
    }else{
        document.getElementById("est100").disabled=false;
    }
    }
    
}

$(document).ready(function(){ 
        $("#cli").click(function(){
            
        $.ajax({
            type: "POST",
            url : '../Gestiones/GestionAsignatura.php?x=29',
            dataType:  "JSON",
            data: {

            }
        })
       .done(function(x){
        if (x.length>0) {
            $("#numest").val(x[0])
            $("#prom").val(x[1])
            $("#apr").val(x[2])
            $("#rep").val(x[3])
        }else{

        }
        
          
        })
        .fail(function(x){
            console.log(x);
        })


        })
})
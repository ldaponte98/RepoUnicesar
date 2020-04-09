$(document).ready(function () {
   $('#txtced').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#bodytable tr').hide();
        $('#bodytable tr').filter(function () {
            return rex.test($(this).text());
        }).show();

        })
});
 
$(document).ready(function(){
    $("#ced").on("change",function(){
        $("#usu").val($("#ced").val());
        $("#pass").val($("#ced").val());
    })
})

$(document).ready(function(){
    $("#ced").on("change",function(){
        $("#usu").val($("#ced").val());
        $("#pass").val($("#ced").val());
    })
})

function Guardar(){

        var cedula = $("#ced").val();
        var nombre = $("#nom").val();
        var apellido = $("#ape").val();
        
        var email = $("#ema").val();
        var estado = $("#est").val();
        var usuario = $("#usu").val();
        var password = $("#pass").val();


        if (cedula=="" || nombre=="" || apellido=="" || email=="") {
             alert("Campos vacios. Por favor llenar");
            return true;
        }

        emailRegex = /^[-\w.%+]{2,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(email)) {
      
    } else {
        alert("Correo no valido");
            return true;
    }
        if (cedula<20000000) {
            alert("Cedula no valida");
            return true;
        }
        if (cedula.length<8 || cedula.length>10) {
            alert("La cedula debe estar entre 8 y 10 digitos");
            return true;
        }
        if (nombre.length<2 || nombre.length>20) {
            alert("El Nombre debe tener entre 2 y 20 caracteres");
            return true;
        }
        if (apellido.length<2 || apellido.length>20) {
            alert("El apellido debe tener entre 2 y 20 caracteres");
            return true;
        }

        if (cedula=="" || nombre=="" || apellido=="" || email=="") {
             alert("Campos vacios. Por favor llenar");
            return true;
        }

        $.ajax({
            url: "../Gestiones/GestionDocentes.php?x=1&&y=0",
            type: "POST",
            dataType : "JSON",
            data:{
                cedula : cedula,
                nombre : nombre,
                apellido : apellido,
                email : email,
                estado : estado,
                usuario : usuario,
                password : password
            },
            success : function(x){
                console.log(x);
                if (x=="existe") {
                    alert("Este docente ya esta registrado");
                }else if (x=="usuario existe") {
                    alert("Usuaio ya ocupado");
                }else if (x=="noguardo") {
                    alert("Error. No se pudo registrar al docente");
                }else{
                    alert("Guardado Correctamente");
                }

            }
        });
   
}

function Editar(){
    var cedula = $("#ced").val();
        var nombre = $("#nom").val();
        var apellido = $("#ape").val();
       
        var email = $("#ema").val();
        var estado = $("#est").val();
        var usuario = $("#usu").val();
        var password = $("#pass").val();

        if (cedula=="" || nombre=="" || apellido=="" || email=="") {
             alert("Campos vacios. Por favor llenar");
            return true;
        }

        emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(email)) {
      
    } else {
        alert("Correo no valido");
            return true;
    }

        if (cedula<20000000) {
            alert("Cedula no valida");
            return true;
        }
        if (cedula.length<8 || cedula.length>10) {
            alert("La cedula debe estar entre 8 y 10 digitos");
            return true;
        }
        if (nombre.length<2 || nombre.length>20) {
            alert("El Nombre debe tener entre 2 y 20 caracteres");
            return true;
        }
        if (apellido.length<2 || apellido.length>20) {
            alert("El apellido debe tener entre 2 y 20 caracteres");
            return true;
        }

        


        $.ajax({
            url: "../Gestiones/GestionDocentes.php?x=2&&y=0",
            type: "POST",
            dataType : "JSON",
            data:{
                cedula : cedula,
                nombre : nombre,
                apellido : apellido,
                email : email,
                estado : estado,
                usuario : usuario,
                password : password
            },
            success : function(x){
                console.log(x);
                if (x=="edito") {
                    alert("Cambios guardados exitosamente");
                    location.href = "EditarDocenteUsu.php?";
                }else if (x=="error") {
                    alert("Error al editar");
                }

            }
        });   
}
function EditarAdmin(){
    var cedula = $("#ced").val();
        var nombre = $("#nom").val();
        var apellido = $("#ape").val();
       
        var email = $("#ema").val();
        var estado = $("#est").val();
        var usuario = $("#usu").val();
        var password = $("#pass").val();

        $.ajax({
            url: "../Gestiones/GestionDocentes.php?x=4&&y=0",
            type: "POST",
            dataType : "JSON",
            data:{
                cedula : cedula,
                nombre : nombre,
                apellido : apellido,
                email : email,
                estado : estado,
                usuario : usuario,
                password : password
            },
            success : function(x){
                console.log(x);
                if (x=="edito") {
                    alert("Cambios guardados exitosamente");
                    location.href = "docentes.php";
                }else if (x=="error") {
                    alert("Error al editar");
                }

            }
        });   
}
/*$(document).ready(function(){
    $("#btnregdoc").click("button",function(form){
        form.preventDefault();
        var cedula = $("#id").val();
        var nombre = $("#nom").val();
        var apellido = $("#ape").val();
        var sexo = $("#sex").val();
        alert(sexo);

    
        $.ajax({
            url: "http://localhost/ProyectoSotfware/Paginas/RegistrarPlanAccion.php?enviar=1",
            type: "GET",
            dataType : "JSON",
            data:{
                objetivo : objetivo,
                desarrollo : desarrollo,
                compromiso1 : compromiso1,
                fecha1 : fecha1,
                compromiso2 : compromiso2,
                fecha2 : fecha2,
                compromiso3 : compromiso3,
                fecha3 : fecha3,
                compromiso4 : compromiso4,
                fecha4 : fecha4,
                compromiso5 : compromiso5,
                fecha5 : fecha5,
                compromiso6 : compromiso6,
                fecha6 : fecha6,
                compromiso7 : compromiso7,
                fecha7 : fecha7,
                compromiso8 : compromiso8,
                fecha8 : fecha8,
                acciones : acciones,
                fecha_reunion : fecha_reunion,
                lugar : lugar,
                temas : temas
               
            },
            success : function(x){
                console.log(x);
                if (x =="vacio") {
                    swal("Error", "Llenar todos los campos","warning");
                }else if (x=="docente tiene plan") {
        
                  swal("Oops", "Usted ya tiene registrado un plan de accion, por favor dirijase a actualizar si desea el formato solicitado","warning") ;
               }else{
                     swal("Buen trabajo", "Plan de accion registrado correctamente","success").then((value) => {
                        location.href = '../Paginas/Plan de Accion.html';
                    });
                }

            }
        });
    });
});
*/



  $(document).ready(function () {
   $('#cedula').keyup(function () {
      var rex = new RegExp($(this).val(), 'i');
        $('#bodytable tr').hide();
        $('#bodytable tr ').filter(function () {
            return rex.test($(this).text());
        }).show();

        })

});


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
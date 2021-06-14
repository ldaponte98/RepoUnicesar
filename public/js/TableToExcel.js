var tableToExcel2 = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    let table_html = quitarTildes(table.innerHTML)
    var ctx = {worksheet: name || 'Worksheet', table: table_html}
    window.location.href = uri + base64(format(template, ctx))
  }
})()

function quitarTildes(cadena){
  const acentos = {'á':'a','é':'e','í':'i','ó':'o','ú':'u','Á':'A','É':'E','Í':'I','Ó':'O','Ú':'U'};
  return cadena.split('').map( letra => acentos[letra] || letra).join('').toString(); 
}


function borrarColumna(idTabla,numeroColumna)
{
  var fila;
  fila=document.getElementById(idTabla).getElementsByTagName('tr');
  ultimaColumna=fila.length-1
  for(var i=0;i<=ultimaColumna;i++){
  	var f = fila[i].getElementsByTagName('td')[numeroColumna];
  	f.innerHTML=""
  }
}

function tableToExcel(id_tabla, filename = '', color_header = '#9bbf4c'){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(id_tabla);
    var tableHTML= "<table border = 1 >"+ tableSelect.innerHTML + "</table>";
    tableHTML = tableHTML.replace(/ /g, '%20');
    tableHTML = quitarTildes(tableHTML)
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

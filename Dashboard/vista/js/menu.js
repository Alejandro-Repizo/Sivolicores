$(document).ready(function () {

    
    var peticionXML4 = new XMLHttpRequest();
    peticionXML4.open('POST', '../../controlador/DataRoute.php');
    opcion = 'cargarEstadisticas';
    parametros = 'opcion=' + opcion;
    peticionXML4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML4.onload = function(){
        var datos = JSON.parse(peticionXML4.responseText);
        document.getElementById('pedidosEstadisticas').innerHTML = datos['0'];
        document.getElementById('ventasEstadisticas').innerHTML = datos['1'];
        document.getElementById('clienteEstadisticas').innerHTML = datos['2'];  
    };

    peticionXML4.send(parametros);
})
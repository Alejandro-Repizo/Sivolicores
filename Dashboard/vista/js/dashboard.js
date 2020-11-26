$(document).ready(function(){

    var opcion,parametros;

    var peticionXML = new XMLHttpRequest();

    peticionXML.open('POST', '../../controlador/DataRoute.php');
    opcion = 'cargarTablaClienteDashboard';
    parametros = 'opcion=' + opcion;
    peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML.onload = function(){
        var datos = JSON.parse(peticionXML.responseText);
        datos.forEach(cliente => {
            var elemento = document.createElement('tr');
            elemento.innerHTML += ("<td>" + cliente.Cl_Nombre + "</td>");
            elemento.innerHTML += ("<td>" + cliente.Cl_Apellido + "</td>");
            elemento.innerHTML += ("<td>" + cliente.Cl_email + "</td>");
            document.getElementById('TablaDashboardCliente').appendChild(elemento);
        });
    };

    peticionXML.send(parametros);

    var peticionXML2 = new XMLHttpRequest();
    peticionXML2.open('POST', '../../controlador/DataRoute.php');
    opcion = 'cargarTablaPedidoDashboard';
    parametros = 'opcion=' + opcion;
    peticionXML2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML2.onload = function(){
        var datos = JSON.parse(peticionXML2.responseText);
        datos.forEach(pedido => {
            var elemento = document.createElement('tr');
            elemento.innerHTML += ("<td>" + pedido.PK_ID_Pedido + "</td>");
            elemento.innerHTML += ("<td>" + pedido.Cl_Nombre + "</td>");
            elemento.innerHTML += ("<td><span class='badge badge-warning'>" + pedido.Estado + "</span></td>");
            elemento.innerHTML += ("<td>" + pedido.Total + "</td>");
            document.getElementById('TablaDashboardPedido').appendChild(elemento);
        });
    };

    peticionXML2.send(parametros);


    var peticionXML3 = new XMLHttpRequest();
    peticionXML3.open('POST', '../../controlador/DataRoute.php');
    opcion = 'cargarGraficaDashboard';
    parametros = 'opcion=' + opcion;
    peticionXML3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML3.onload = function(){
        var datos = JSON.parse(peticionXML3.responseText);
        options.series[0].data = datos;
        chart1 = new Highcharts.Chart(options);
    };

    peticionXML3.send(parametros);

    //HighChart
    options = {
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        title: {
            text: 'Estado pedidos'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title:{
                text: 'Cantidad'
            }
        },
        plotOptions: {
            series:{
                borderwidth: 1,
                datalabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },
        tooltip: {
            headerFormat:"<span style='font-size:11px'> {series.name}</span><br>",
            pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y:.0f}</b>"
        },
        series:[{
            name: 'Pedidos',
            colorByPoint:true,
            data:[]
        }]
    }


  

    var peticionXML4 = new XMLHttpRequest();
    peticionXML4.open('POST', '../../controlador/DataRoute.php');
    opcion = 'TotalClientes';
    parametros = 'opcion=' + opcion;
    peticionXML4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML4.onload = function(){
        var datos = JSON.parse(peticionXML4.responseText);
        document.getElementById('TotalClientes').innerHTML = datos['0'];
        
    };

    peticionXML4.send(parametros);






})
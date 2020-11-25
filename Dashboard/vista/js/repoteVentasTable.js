$(document).ready(function(){

    //Tabla Inventario
    var opcion;
    opcion = "cargarReporteVentas";

    tablaReporte = $('#tablaReporte').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody y los botones
        "columns": [
            { "data": "Ped_Fecha" },
            { "data": "Cl_Nombre" },
            { "data": "Pt_Nombre" },
            { "data": "Pt_Cantidad" },
            { "data": "Total" },
            { "data": "Estado", "render": function(data, type, row) {return '<span class="badge badge-success">'+data+'</span>' ;}},
        ],

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infroFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar: ",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });
    

});

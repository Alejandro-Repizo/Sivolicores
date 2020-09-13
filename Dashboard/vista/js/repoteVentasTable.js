$(document).ready(function(){

    //Tabla Inventario
    // var fila, opcion;
    // opcion = "cargarInventario";

    tablaReporte = $('#tablaReporte').DataTable({
        // // Para agregar los botones de editar y borrar de forma predeterminada
        // "ajax": {
        //     "url": "../../controlador/DataRoute.php",
        //     "method": 'POST',
        //     "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
        //     "dataSrc": ""

        // },
        // //Agregamos las columnas del tbody los botones
        // "columns": [
        //     { "data": "Pt_Imagen" },
        //     { "data": "PK_ID_Producto" },
        //     { "data": "Pt_Nombre" },
        //     { "data": "Pt_Precio" },
        //     { "data": "Pt_Stock" },
        //     { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>" }
        // ],

        // "columnDefs": [{
        //     "targets": -1,
        //     "data": null,
        //     "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
        // }],
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

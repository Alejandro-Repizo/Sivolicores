$(document).ready(function(){

    var fila, opcion;
    opcion = "cargarEnvio";

    tablaEnvio = $('#tablaEnvio').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Envio" },
            { "data": "Cl_Nombre" },
            { "data": "Pt_Nombre" },
            { "data": "Pt_Cantidad" },
            { "data": "Ped_Direccion" },
            { "data": "Cl_Telefono" },
            { "data": "Total" },
            { "data": "Ped_Observaciones" },
            { "data": "Estado", "render": function(data, type, row) {return '<span class="badge badge-success">'+data+'</span>' ;}},
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-success btnEditar'><i class='fas fa-check'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-times'></i></button></div>" }
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

     //Código para el botón editar
     $(document).on("click", ".btnEditar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 'envioReporteVenta' //enviar pedido
        Swal.fire({
            title: '¿Estás seguro de completar este envío?',
            text: 'envío a completar id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28A745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Enviar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Completado!',
                    'El envío ha sido completado correctamente.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaEnvio.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 'envioReportePedido' //enviar a reporte pedido
        Swal.fire({
            title: '¿Estás seguro de cancelar el envío?',
            text: 'envío a cancelar id: ' + id,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Cancelar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Cancelado!',
                    'El envío ha sido cancelado :(',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaEnvio.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

});

$(document).ready(function(){

    var fila, opcion;
    opcion = "cargarPedido";

    tablaPedido = $('#tablaPedido').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Pedido" },
            { "data": "Cl_Nombre" },
            { "data": "Ped_Fecha" },
            { "data": "Pt_Nombre" },
            { "data": "Pt_Cantidad" },
            { "data": "Ped_Direccion" },
            { "data": "Cl_Telefono" },
            { "data": "Total" },
            { "data": "Estado", "render": function(data, type, row) {return '<span class="badge badge-warning">'+data+'</span>' ;}},
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-warning btnEditar'><i class='fas fa-truck-loading'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-times'></i></button></div>" }
        ],
        

        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button></div></div>"
        }],
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
        opcion = 'enviarPedido' //enviar pedido
        Swal.fire({
            title: '¿Estás seguro de enviar este pedido?',
            text: 'pedido a enviar id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28A745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Enviar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Enviado!',
                    'Ahora el pedido está en proceso de envio.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaPedido.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 'reportePedido' //enviar a reporte pedido
        Swal.fire({
            title: '¿Estás seguro de cancelar el pedido?',
            text: 'pedido a cancelar id: ' + id,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Cancelar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Cancelado!',
                    'El pedido ha sido cancelado :(',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaPedido.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

});

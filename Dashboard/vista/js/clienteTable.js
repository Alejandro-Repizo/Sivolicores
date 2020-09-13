$(document).ready(function () {

    //Tabla Inventario
    var fila, opcion;
    opcion = "cargarCliente";

    tablaCliente = $('#tablaCliente').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
          "ajax": {
              "url": "../../controlador/DataRoute.php",
              "method": 'POST',
              "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
              "dataSrc": ""

          },
          //Agregamos las columnas del tbody los botones
          "columns": [
              { "data": "PK_ID_Cliente" },
              { "data": "Cl_Nombre" },
              { "data": "Cl_email" },
              { "data": "Cl_Pedidos_realizado" },
              { "data": "Cl_Fecha_registro" },
              { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"}
          ],

        // "columnDefs": [{
        //     "targets": -1,
        //     "data": null,
        //     "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
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


    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        opcion = 'borrarCliente' //borrar
        //Con esto se captura los datos de la tabla.
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        Cl_Nombre = $(this).closest("tr").find('td:eq(1)').text();
        // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
        Swal.fire({
            title: '¿Estás seguro de eliminar el registro?',
            text: 'registro a eliminar id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Eliminado!',
                    'La marca a sido eliminada.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, Cl_Nombre, Cl_Nombre, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaCliente.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });
});
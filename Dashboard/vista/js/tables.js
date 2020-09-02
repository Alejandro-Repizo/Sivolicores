$(document).ready(function () {
    var fila, opcion;
    //Captura la fila para editar o borrar el registro
    opcion = 1;

    tablaMarcas = $('#tablaMarcas').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/prueba.php",
            "method": 'POST',
            "data": { opcion: opcion },//enviamos opcion 1 para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Marca" },
            { "data": "Ma_Nombre" },
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>" }
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

   
    $('#btnGuardar').click(function () {  
        Swal.fire({        
            type: 'success',
            title: 'Éxito', 
            text: 'Marca registrada con éxito'      
        });
    });

    $('#btnNuevo').click(function () {
        $('#formNuevaMarca').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva Marca").css("color", "#fff");//Para colocar titulo y color
        $("#modalMarca").modal("show");//Para mostrar el modal
        id = null;
        opcion = "agregar"; //Agregar
    });


    $("#formNuevaMarca").submit(function (e) {
        e.preventDefault();
        nombreMarca = $.trim($("#nombreMarca").val());

        //Acá con Ajax le decimos con que archivo vamos a interactuar
        $.ajax({
            type: "POST",
            url: "../../controlador/DataRoute.php",
            data: {id:id, nombreMarca: nombreMarca, opcion: opcion},
            dataType: "json",
            success: function (data) {
                console.log(data);
                tablaMarcas.ajax.reload(null, false);
            }
        });
        $("#modalMarca").modal("hide");
    });


    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "editar"; //editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //Con esto se captura los datos de la tabla.
        nombreMarca = fila.find('td:eq(1)').text();

        $("#nombreMarca").val(nombreMarca); //seteamos los valores recolectados en la tabla hacia los input's.
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar marca").css("color", "#fff");;
        $("#modalMarca").modal("show");
      
        $('#btnGuardar').click(function () {  
            Swal.fire({        
                type: 'success',
                title: 'Éxito', 
                text: 'Marca actualizada con éxito'     
            });
        });
    });

    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        nombreMarca = $(this).closest("tr").find('td:eq(1)').text();
        opcion = 'borrar' //borrar
        // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
        Swal.fire({
            title: '¿Estás seguro de eliminar el registro?',
            text: 'registro a eliminar id: ' + id ,
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
                    data: { id: id, nombreMarca: nombreMarca, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaMarcas.row(fila.parents('tr')).remove().draw();
                    }
                });

            }
        });
        // if(respuesta == true){
        //     $.ajax({
        //         type: "POST",//Método
        //         url: "../../controlador/DataRoute.php",//Lugar
        //         data: {id:id, nombreMarca:nombreMarca, opcion:opcion},//lo enviamos nombre a una variable nombre que está en php
        //         dataType: "json",//Formato
        //         success: function () {
        //             tablaMarcas.row(fila.parents('tr')).remove().draw();
        //         }
        //     });
        // }
    });



});
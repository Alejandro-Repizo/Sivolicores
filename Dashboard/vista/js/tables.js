$(document).ready(function(){
    var idMarca, opcion;
    //opcion = 1;

    tablaMarcas = $('#tablaMarcas').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        //  "ajax":{
        //     "url": "../../controlador/DataRoute.php",
        //     "method": 'POST',
        //     "data":{opcion:opcion},//enviamos opcion 4 para que haga un SELECT
        //     "dataSrc":""

        // },
        //Agregamos las columnas del tbody los botones
        "columnDefs":[{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
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

    var fila; //Captura la fila para editar o borrar el registro

    //Código para el botón editar
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        //alert(id); //Con esto se captura los datos de la tabla.
        nombreMarca = fila.find('td:eq(1)').text();
        $("#nombreMarca").val(nombreMarca); //seteamos los valores recolectados en la tabla hacia los input's.
        opcion = 2 //editar

        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar marca").css("color", "#fff");;
        $("#modalMarca").modal("show");

    });

    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
       // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
       var respuesta = Swal.fire({
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
                    }
                });
        if(respuesta == true){
            $.ajax({
                type: "POST",//Método
                url: "bd/crud.php",//Lugar
                data: {id:id, opcion:opcion},//lo enviamos nombre a una variable nombre que está en php
                dataType: "json",//Formato
                success: function () {
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });


    $('#btnNuevo').click(function(){
        $('formNuevaMarca').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva Marca").css("color", "#fff");//Para colocar titulo y color
        $("#modalMarca").modal("show");//Para mostrar el modal
    });


});
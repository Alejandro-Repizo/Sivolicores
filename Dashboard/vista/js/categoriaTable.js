$(document).ready(function(){

    //Tabla Inventario
    var fila, opcion;
    opcion = "cargarCategoria";

    tablaCategoria = $('#tablaCategoria').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Categoria"},
            { "data": "Cat_Nombre" },
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

    //Botón nueva marca
    $('#btnNuevo').click(function () {
        $('#formNuevaCategoria').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva Categoría").css("color", "#fff");//Para colocar titulo y color
        $("#modalCategoria").modal("show");//Para mostrar el modal
        id = null;
        opcion = "agregarCategoria"; //Agregar
    });

    //Formulario que está dentro del modal
    $("#formNuevaCategoria").submit(function (e) {
        //Quitamos el evento al submit de recarga
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        //Con esto se captura los datos de la tabla.
        Cat_Nombre = $.trim($("#Cat_Nombre").val());
        if(formulario_valido()){
            var parametros = 'id='+ id +'&Cat_Nombre='+ Cat_Nombre +'&opcion=' + opcion;
            peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            peticionXML.onload = function(){ 
                var datos = JSON.parse(peticionXML.responseText);
                if(datos.error){
                    Swal.fire({
                        type: 'warning',
                        title: 'Error',
                        text: 'Se ha producido un error.'
                    });
                }else{
                    tablaCategoria.ajax.reload(null, false);
                }
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Categoria registrada con éxito'
                    });
                }
            }
            peticionXML.send(parametros);
        }else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Se ha producido un error.'
            });
        }
        $("#modalCategoria").modal("hide");
    });

    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "editarCategoria"; //editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //Con esto se captura los datos de la tabla.
        Cat_Nombre = fila.find('td:eq(1)').text();

        $("#Cat_Nombre").val(Cat_Nombre); //seteamos los valores recolectados en la tabla hacia los input's.

        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar categoría").css("color", "#fff");;
        $("#modalCategoria").modal("show");

    });

     //Código para el botón borrar
     $(document).on("click", ".btnBorrar", function () {
        opcion = 'borrarCategoria' //borrar
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        Cat_Nombre = $(this).closest("tr").find('td:eq(1)').text();
        
        // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
        Swal.fire({
            title: '¿Estás seguro de eliminar el registro?',
            text: 'Registro a eliminar id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Eliminado!',
                    'La categoría a sido eliminada.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, Cat_Nombre: Cat_Nombre, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaCategoria.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(Cat_Nombre == ''){
            return false;
        }
        return true;
    }
  
});



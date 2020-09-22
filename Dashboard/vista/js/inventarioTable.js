$(document).ready(function () {
    //Tabla Inventario
    var fila, opcion;
    opcion = "cargarInventario";

    tablaInventario = $('#tablaInventario').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "Pt_Imagen" , "render": function(data, type, row) {return '<img src="../imagenes/Productos/'+data+'" width="50px" height="70px"/>' ;}},
            { "data": "PK_ID_Producto" },
            { "data": "Pt_Nombre" },
            { "data": "Pt_Precio" },
            { "data": "Pt_Stock" },
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>" }
        ],

        // "columnDefs": [{
        //     "targets": -1,
        //     "data": null,
        //     "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button></div></div>"
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

    //Formulario que está dentro del modal
    $("#formEditarInventario").submit(function (e) {
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');

        Pt_Precio = $.trim($("#Pt_Precio").val());
        Pt_Stock = $.trim($("#Pt_Stock").val());
        console.log(Pt_Precio);

        if (formulario_valido()) {
            var parametros = 'id=' + id + '&Pt_Precio=' + Pt_Precio +'&Pt_Stock='+ Pt_Stock +'&Pt_Nombre='+Pt_Nombre + '&opcion=' + opcion;
            console.log(parametros);
            peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            peticionXML.onload = function () {
                var datos = JSON.parse(peticionXML.responseText);
                console.log(datos);
                if (datos.error) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Error',
                        text: 'Se ha producido un error.'
                    });
                } else {
                    tablaInventario.ajax.reload(null, false);
                }
                //tablaInventario.ajax.reload(null, false);
            }
            peticionXML.onreadystatechange = function () {
                if (peticionXML.readyState == 4 && peticionXML.status == 200) {
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Producto actualizado con éxito'
                    });
                }
            }
            peticionXML.send(parametros);
        } else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Se ha producido un error.'
            });
        }
        $("#modalInventario").modal("hide");
    });


    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "editarInventario"; //editar
        //Con esto se captura los datos de la tabla.
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(1)').text());
        Pt_Nombre = fila.find('td:eq(2)').text();
        Pt_Precio = fila.find('td:eq(3)').text();
        Pt_Stock = fila.find('td:eq(4)').text();
        //seteamos los valores recolectados en la tabla hacia los input's.
        $("#Pt_Nombre").val(Pt_Nombre);
        $("#Pt_Precio").val(Pt_Precio);
        $("#Pt_Stock").val(Pt_Stock);
        //Opciones de color y demás
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar Inventario").css("color", "#fff");;
        $("#modalInventario").modal("show");

    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(isNaN(Pt_Precio) || Pt_Precio == ''){
            return false;
        }else if(isNaN(Pt_Stock) || Pt_Stock == ''){
            return false;
        }else if(Pt_Nombre == ''){
            return false;
        }
        return true;
    }
  

});
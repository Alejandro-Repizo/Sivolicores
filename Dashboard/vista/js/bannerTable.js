$(document).ready(function(){

    var fila, opcion;
    opcion = "cargarBanner";

    tablaBanner = $('#tablaBanner').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Banner" },
            { "data": "B_Imagen" , "render": function(data, type, row) {return '<img src="../imagenes/Banner/'+data+'" width="100px" height="60px"/>' ;}},
            { "data": "B_Nombre" },
            { "data": "B_Fecha_actualizacion" },
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button></div></div>" }
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

    //Formulario que está dentro del modal para agregar una nueva recetá cóctel
    $("#formEditarBanner").submit(function (e) {
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        //Con esto se captura los datos de la tabla.
        B_Nombre = $.trim($("#B_Nombre").val());
        if(formulario_valido()){
            var formData = new FormData();
            var files = $("#B_Imagen")[0].files[0];

            formData.append('B_Nombre',B_Nombre);
            formData.append('id',id);
            formData.append('opcion', opcion);
            formData.append('file', files);

            peticionXML.onload = function(){ 
                tablaBanner.ajax.reload(null, false);
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Recectá Cóctel registrada con éxito'
                    });
                }else{
                    Swal.fire({
                        type: 'warning',
                        title: 'Error',
                        text: 'Se ha producido un error.'
                    });
                }
            }
            peticionXML.send(formData);
        }else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Revise que todas las casillas estén llenas.'
            });
        }
        $("#modalBanner").modal("hide");
    });



    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "editarBanner"; //editar
        //Con esto se captura los datos de la tabla.
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        B_Nombre = fila.find('td:eq(2)').text();
        //seteamos los valores recolectados en la tabla hacia los input's.
        $("#B_Nombre").val(B_Nombre);
        //Opciones de color y demás
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar banner").css("color", "#fff");;
        $("#modalBanner").modal("show");

    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(B_Nombre == ''){
            return false;
        } 
        return true;
    }

});

function cambiar(){
    var pdrs = document.getElementById('B_Imagen').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}




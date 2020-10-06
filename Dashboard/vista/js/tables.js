$(document).ready(function () {
    
    //Captura la fila para editar o borrar el registro 
    //captura la acción para enviar al switch en data route
    var fila, opcion, nombreMarca;
    opcion = 'cargarMarca';
    tablaMarcas = $('#tablaMarcas').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
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
 
    //Botón nueva marca
    $('#btnNuevo').click(function () {
        $('#formNuevaMarca').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva Marca").css("color", "#fff");//Para colocar titulo y color
        $("#modalMarca").modal("show");//Para mostrar el modal
        id = null;
        opcion = "agregarMarca"; //Agregar
    });

    //Formulario que está dentro del modal
    $("#formNuevaMarca").submit(function (e) {
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        nombreMarca = $.trim($("#nombreMarca").val());
        
        if(formulario_valido()){
            var parametros = 'id='+ id +'&nombreMarca='+ nombreMarca +'&opcion=' + opcion;
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
                    tablaMarcas.ajax.reload(null, false);
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Marca registrada con éxito'
                    });
                }
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    console.log(peticionXML.status);
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
        $("#modalMarca").modal("hide");
    });

    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "editarMarca"; //editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //Con esto se captura los datos de la tabla.
        nombreMarca = fila.find('td:eq(1)').text();
        $("#nombreMarca").val(nombreMarca); //seteamos los valores recolectados en la tabla hacia los input's.
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar marca").css("color", "#fff");;
        $("#modalMarca").modal("show");

    });

     //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        nombreMarca = $(this).closest("tr").find('td:eq(1)').text();
        opcion = 'borrarMarca' //borrar
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
                    data: { id: id, nombreMarca: nombreMarca, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaMarcas.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(nombreMarca == ''){
            return false;
        }
        return true;
     }
  

    
});
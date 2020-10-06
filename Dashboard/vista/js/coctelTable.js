$(document).ready(function(){

    var fila, opcion;
    opcion = "cargarRecetaCoctel";

    tablaCoctel = $('#tablaCoctel').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Receta" },
            { "data": "RC_Image" , "render": function(data, type, row) {return '<img src="../imagenes/imagenesBD/'+data+'" width="100px" height="60px"/>' ;}},
            { "data": "RC_Nombre" },
            { "data": "RC_Fecha" },
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
        $('#formNuevoCoctel').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva receta cóctel").css("color", "#fff");//Para colocar titulo y color
        $("#modalRecetaCoctel").modal("show");//Para mostrar el modal
        id = null;
        opcion = "agregarRecetaCoctel"; //Agregar
    });

    //Formulario que está dentro del modal para agregar una nueva recetá cóctel
    $("#formNuevoCoctel").submit(function (e) {
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');

        RC_Nombre = $.trim($("#RC_Nombre").val());
        RC_Receta = $.trim($("#RC_Receta").val());
        RC_Autor = $.trim($("#RC_Autor").val());
        RC_Descripcion = $.trim($("#RC_Descripcion").val());
        RC_Image = $.trim($('#RC_Image').val()); //Estó solo es para la función formulario_Valido
           
        if(formulario_valido()){
            var formData = new FormData();
            var files = $("#RC_Image")[0].files[0];

            formData.append('RC_Nombre',RC_Nombre);
            formData.append('RC_Receta',RC_Receta);
            formData.append('RC_Autor',RC_Autor);
            formData.append('RC_Descripcion',RC_Descripcion);
            formData.append('opcion', opcion);
            formData.append('file', files);

            peticionXML.onload = function(){ 
                tablaCoctel.ajax.reload(null, false);
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
        $("#modalRecetaCoctel").modal("hide");
    });

    //Formulario que está dentro del modal para editar una recetá cóctel
    $("#formEditarCoctel").submit(function (e) {
        e.preventDefault();
        opcion = "editarCoctel"//editar
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');

        RC_Nombre = $.trim($("#RC_Nombre2").val());
        RC_Receta = $.trim($("#RC_Receta2").val());
        RC_Autor = $.trim($("#RC_Autor2").val());
        RC_Descripcion = $.trim($("#RC_Descripcion2").val());
           
        if(formulario_valido2()){
            var parametros = 'id=' + id + '&RC_Nombre=' + RC_Nombre + '&RC_Receta='+ RC_Receta + '&RC_Autor='+ RC_Autor + '&RC_Descripcion='+ RC_Descripcion + '&opcion=' + opcion;
            //Establecer el header de como vamos a enviar los datos
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
                    tablaCoctel.ajax.reload(null, false);
                }
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Recectá Cóctel registrada con éxito'
                    });
                }
            }
            peticionXML.send(parametros);
        }else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Revise que todas las casillas estén llenas.'
            });
        }
        $("#modalEditarRecetaCoctel").modal("hide");
    });

    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "cargarEditarReceta"; //editar
        //Con esto se captura los datos de la tabla.
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        RC_Nombre = fila.find('td:eq(2)').text();
        //Inicializamos una petición XML
        var peticionXML = new XMLHttpRequest();
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        //Acá una inicializamos y declaramos una variable que va a tener todos los datos
        var parametros = 'id=' + id + '&RC_Nombre=' + RC_Nombre + '&opcion=' + opcion;
        //Establecer el header de como vamos a enviar los datos
        peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        peticionXML.onload = function(){
            //Pasamos conversión a JSON
            var datos = JSON.parse(peticionXML.responseText);
            if(datos.error){
                Swal.fire({
                    type: 'warning',
                    title: 'Error',
                    text: 'Se ha producido un error.'
                });
            }else{
                datos.forEach(coctel => {
                    //seteamos los valores recolectados en la tabla hacia los input's.
                    $("#RC_Nombre2").val(coctel.RC_Nombre);
                    $("#RC_Receta2").val(coctel.RC_Receta);
                    $("#RC_Autor2").val(coctel.RC_Autor);
                    $("#RC_Descripcion2").val(coctel.RC_Descripcion);
                });
            }
        }
        peticionXML.send(parametros);
        //Opciones de color y demás
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar receta cóctel").css("color", "#fff");;
        $("#modalEditarRecetaCoctel").modal("show");

    });

    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        opcion = 'borrarRecetaCoctel' //borrar
        //Con esto se captura los datos de la tabla.
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        RC_Nombre = $(this).closest("tr").find('td:eq(2)').text();
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
                    'La recetá cóctel a sido eliminada.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, RC_Nombre, RC_Nombre, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaCoctel.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(RC_Nombre == ''){
            return false;
        }else if(RC_Receta == ''){
            return false;
        }else if(RC_Autor == ''){
            return false;
        }else if(RC_Descripcion == ''){
            return false;
        }else if(RC_Image == ''){
            return false;
        }
        return true;
    }

    function formulario_valido2(){
        if(RC_Nombre == ''){
            return false;
        }else if(RC_Receta == ''){
            return false;
        }else if(RC_Autor == ''){
            return false;
        }else if(RC_Descripcion == ''){
            return false;
        }
        return true;
    }

});

function cambiar(){
    var pdrs = document.getElementById('RC_Image').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}





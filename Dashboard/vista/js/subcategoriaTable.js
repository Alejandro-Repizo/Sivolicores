$(document).ready(function(){

    //Tabla Inventario
    var fila, opcion, controladorCargaCategoria, accion;
    opcion = "cargarSubCategoria";
    controladorCargaCategoria = 1;

    tablaSubCategoria= $('#tablaSubCategoria').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_SubCategoria"},
            { "data": "SCat_Nombre" },
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
        },
      
    });



    //Botón nueva subcategoria
    $('#btnNuevo').click(function () {
        id = null;
        $('#formNuevaSubCategoria').trigger("reset");
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nueva SubCategoría").css("color", "#fff");//Para colocar titulo y color
        $("#modalSubCategoria").modal("show");//Para mostrar el modal
        accion = "agregarSubCategoria"; //Agregar

    });


    $('#PK_ID_Categoria').click(function(){
        opcion = "cargarCategoria"; //Agregar
        var parametros = '&opcion=' + opcion;

        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        if(controladorCargaCategoria == 1){
            peticionXML.onload = function () {
                var PK_ID_Categoria = $('#PK_ID_Categoria');
                var datos = JSON.parse(peticionXML.responseText);
               
                // PK_ID_Categoria.append('<option selected="true" disabled="disabled">Seleccione la categoria</option>');
                $.each(datos, function (key, value) { 
                     PK_ID_Categoria.append('<option value=' + datos[key].PK_ID_Categoria + '>' + datos[key].Cat_Nombre + '</option>');
                });
    
            }
        }
        controladorCargaCategoria++;
        //Acá enviamos la petición pero pos acá en está no va nada 
        peticionXML.send(parametros);
    });

    //Formulario que está dentro del modal
    $("#formNuevaSubCategoria").submit(function (e) {
        //Quitamos el evento al submit de recarga
        e.preventDefault();
        opcion = accion;
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        //Con esto se captura los datos de la tabla.
        SCat_Nombre = $.trim($("#SCat_Nombre").val());
        PK_ID_Categoria = $.trim($("#PK_ID_Categoria").val());

        if(formulario_valido()){
            var parametros = 'id='+ id +'&SCat_Nombre='+ SCat_Nombre + '&PK_ID_Categoria='+ PK_ID_Categoria +'&opcion=' + opcion;
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
                    tablaSubCategoria.ajax.reload(null, false);
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'SubCategoría registrada con éxito'
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
        $("#modalSubCategoria").modal("hide");
    });


    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        accion = "editarSubCategoria"; //editar
        // let cargadedatos = "cargarCategoriaCombo";
        //Con esto se captura los datos de la tabla.
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text()); //Con esto se captura los datos de la tabla.
        SCat_Nombre = fila.find('td:eq(1)').text();
        // //Inicializamos una petición XML
        // let peticionXML = new XMLHttpRequest;
        // peticionXML.open('POST', '../../controlador/DataRoute.php');
        // //Acá una inicializamos y declaramos una variable que va a tener todos los datos
        // let parametros = 'PK_ID_Categoria=' + id  + '&opcion=' + cargadedatos;
        // //Establecer el header de como vamos a enviar los datos
        // peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // peticionXML.onload = function() {
        //     let PK_ID_Categoria = $('#PK_ID_Categoria');
        //     var datos = JSON.parse(peticionXML.responseText);
        //     $.each(datos, function (key, value) { 
        //         PK_ID_Categoria.append('<option  selected  disabled="disabled" value=' + datos[key].PK_ID_Categoria + '>' + datos[key].Cat_Nombre + '</option>');
        //    });
           
        // }
        // peticionXML.send(parametros);


        $("#SCat_Nombre").val(SCat_Nombre); //seteamos los valores recolectados en la tabla hacia los input's.
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar SubCategoría").css("color", "#fff");;
        $("#modalSubCategoria").modal("show");

    });

     //Código para el botón borrar
     $(document).on("click", ".btnBorrar", function () {
        opcion = 'borrarSubCategoria' //borrar
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        SCat_Nombre = $(this).closest("tr").find('td:eq(1)').text();
        
        // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
        Swal.fire({
            title: '¿Estás seguro de eliminar el registro?',
            text: 'Registro a eliminar id: ' + id,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Eliminado!',
                    'La SubCategoría a sido eliminada.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, SCat_Nombre: SCat_Nombre, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaSubCategoria.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });

    //función para válidar datos vácios
    function formulario_valido() { 
        if(SCat_Nombre == ''){
            return false;
        }
        return true;
    }

   
  
});
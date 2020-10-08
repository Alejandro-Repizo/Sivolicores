$(document).ready(function(){

    var fila, opcion, controladorCargaCategoria, controladorCargaMarca;
    opcion = "cargarProducto";
    controladorCargaCategoria = 1;
    controladorCargaMarca = 1;

    tablaProducto = $('#tablaProducto').DataTable({
        // Para agregar los botones de editar y borrar de forma predeterminada
        "ajax": {
            "url": "../../controlador/DataRoute.php",
            "method": 'POST',
            "data": { opcion: opcion},//enviamos cargar para que haga un SELECT
            "dataSrc": ""

        },
        //Agregamos las columnas del tbody los botones
        "columns": [
            { "data": "PK_ID_Producto" },
            { "data": "Pt_Imagen" , "render": function(data, type, row) {return '<img src="../imagenes/Productos/'+data+'" width="50px" height="70px"/>' ;}},
            { "data": "Pt_Nombre" },
            { "data": "Pt_Precio" },
            { "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-secondary btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-outline-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>" }
        ],

        "columnDefs": [{
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


    //Botón nuevo producto
    $('#btnNuevo').click(function () {
        $('#formNuevoProducto').trigger("reset");
        document.getElementById('info').innerHTML = 'Seleciona la imagen';           
        $(".modal-header").css("background-color", "#800000");//Para colocar color al header
        $(".modal-title").text("Nuevo producto").css("color", "#fff");//Para colocar titulo y color
        $("#modalProducto").modal("show");//Para mostrar el modal
        id = null;
        
    });

    $('#FK_ID_Categoria').click(function(){
        opcion = "cargarCategoria"; //Agregar
        var parametros = '&opcion=' + opcion;

        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        if(controladorCargaCategoria == 1){
            peticionXML.onload = function () {
                var FK_ID_Categoria = $('#FK_ID_Categoria');
                var datos = JSON.parse(peticionXML.responseText);
               
                // FK_ID_Categoria.append('<option selected="true" disabled="disabled">Seleccione la categoria</option>');
                $.each(datos, function (key, value) { 
                     FK_ID_Categoria.append('<option value=' + datos[key].PK_ID_Categoria + '>' + datos[key].Cat_Nombre + '</option>');
                });
    
            }
        }
        controladorCargaCategoria++;
        //Acá enviamos la petición pero pos acá en está no va nada 
        peticionXML.send(parametros);
    });

    $('#FK_ID_Marca').click(function(){
        opcion = "cargarMarca"; //Agregar
        var parametros = '&opcion=' + opcion;
        
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        if(controladorCargaMarca == 1){
            peticionXML.onload = function () {
                var FK_ID_Marca = $('#FK_ID_Marca');
                var datos = JSON.parse(peticionXML.responseText);
               
                // FK_ID_Marca.append('<option selected="true" disabled="disabled">Seleccione la marca</option>');
                $.each(datos, function (key, value) { 
                    FK_ID_Marca.append('<option value=' + datos[key].PK_ID_Marca + '>' + datos[key].Ma_Nombre + '</option>');
                });
    
            }
        }
        controladorCargaMarca++;
        //Acá enviamos la petición pero pos acá en está no va nada 
        peticionXML.send(parametros);
    });


    //Formulario que está dentro del modal para agregar una nueva recetá cóctel
    $("#formNuevoProducto").submit(function (e) {
        e.preventDefault();
        opcion = "agregarProducto";
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');

        Pt_Nombre = $.trim($("#Pt_Nombre").val());
        Pt_codigo = $.trim($("#Pt_codigo").val());
        Pt_Presentacion = $.trim($("#Pt_Presentacion").val());
        Pt_Stock = $.trim($("#Pt_Stock").val());
        Pt_Precio = $.trim($("#Pt_Precio").val());
        FK_ID_Categoria = $.trim($("#FK_ID_Categoria").val());
        FK_ID_Marca = $.trim($("#FK_ID_Marca").val());
        Pt_Pais = $.trim($("#Pt_Pais").val());
        Pt_Grados_alchol = $.trim($("#Pt_Grados_alchol").val());
        Pt_Color = $.trim($("#Pt_Color").val());
        Pt_Imagen = $.trim($('#Pt_Imagen').val()); //Estó solo es para la función formulario_Valido
           
        if(formulario_valido()){
            var formData = new FormData();
            var files = $("#Pt_Imagen")[0].files[0];

            formData.append('Pt_Nombre',Pt_Nombre);
            formData.append('Pt_codigo',Pt_codigo);
            formData.append('Pt_Presentacion',Pt_Presentacion);
            formData.append('Pt_Stock',Pt_Stock);
            formData.append('Pt_Precio',Pt_Precio);
            formData.append('FK_ID_Categoria',FK_ID_Categoria);
            formData.append('FK_ID_Marca',FK_ID_Marca);
            formData.append('Pt_Pais',Pt_Pais);
            formData.append('Pt_Grados_alchol',Pt_Grados_alchol);
            formData.append('Pt_Color',Pt_Color);
            formData.append('opcion', opcion);
            formData.append('file', files);

            peticionXML.onload = function(){ 
                tablaProducto.ajax.reload(null, false);
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Nuevo producto registrado con éxito'
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
        $("#modalProducto").modal("hide");
    });


    //Formulario que está dentro del modal para editar un producto
    $("#formEditarProducto").submit(function (e) {
        e.preventDefault();
        opcion = "editarProducto";
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
         //Con esto se captura los datos de la tabla.
        Pt_Nombre = $.trim($("#Pt_Nombre2").val());
        Pt_codigo = $.trim($("#Pt_codigo2").val());
        Pt_Presentacion = $.trim($("#Pt_Presentacion2").val());
        Pt_Stock = $.trim($("#Pt_Stock2").val());
        Pt_Precio = $.trim($("#Pt_Precio2").val());
      
        Pt_Pais = $.trim($("#Pt_Pais2").val());
        Pt_Grados_alchol = $.trim($("#Pt_Grados_alchol2").val());
        Pt_Color = $.trim($("#Pt_Color2").val());
        Pt_Imagen = $.trim($('#Pt_Imagen2').val()); //Estó solo es para la función formulario_Valido
           
        if(formulario_valido2()){
            
            var formData = new FormData();
            var files = $("#Pt_Imagen2")[0].files[0];

            formData.append('Pt_Nombre',Pt_Nombre);
            formData.append('Pt_codigo',Pt_codigo);
            formData.append('Pt_Presentacion',Pt_Presentacion);
            formData.append('Pt_Stock',Pt_Stock);
            formData.append('Pt_Precio',Pt_Precio);
    
            formData.append('Pt_Pais',Pt_Pais);
            formData.append('Pt_Grados_alchol',Pt_Grados_alchol);
            formData.append('Pt_Color',Pt_Color);
            formData.append('id',id);
            formData.append('opcion', opcion);
            formData.append('file', files);

            peticionXML.onload = function(){ 
                tablaProducto.ajax.reload(null, false);
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    Swal.fire({
                        type: 'success',
                        title: 'Éxito',
                        text: 'Nuevo producto registrado con éxito'
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
        $("#modalEditarProducto").modal("hide");
    });

    //Código para el botón editar
    $(document).on("click", ".btnEditar", function () {
        opcion = "cargarEditarProducto"; //editar
        //Con esto se captura los datos de la tabla.
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        Pt_Nombre = fila.find('td:eq(2)').text();

        //Inicializamos una petición XML
        var peticionXML = new XMLHttpRequest();
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        //Acá una inicializamos y declaramos una variable que va a tener todos los datos
        var parametros = 'id=' + id + '&Pt_Nombre=' + Pt_Nombre + '&opcion=' + opcion;
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
                datos.forEach(producto => {
                    //seteamos los valores recolectados en la tabla hacia los input's.
                    $("#Pt_Nombre2").val(producto.Pt_Nombre);
                    $("#Pt_codigo2").val(producto.Pt_codigo);
                    $("#Pt_Presentacion2").val(producto.Pt_Presentacion);
                    $("#Pt_Stock2").val(producto.Pt_Stock);
                    $("#Pt_Precio2").val(producto.Pt_Precio);
                    $("#Pt_Pais2").val(producto.Pt_Pais);
                    $("#Pt_Grados_alchol2").val(producto.Pt_Grados_alchol);
                    $("#Pt_Color2").val(producto.Pt_Color);
                   
                });
               
            }
        }
        peticionXML.send(parametros);

        //Opciones de color y demás
        $(".modal-header").css("background-color", "#6C757D");
        $(".modal-title").text("Editar receta cóctel").css("color", "#fff");;
        $("#modalEditarProducto").modal("show");
      
    });


    //Código para el botón borrar
    $(document).on("click", ".btnBorrar", function () {
        opcion = 'borrarProducto' //borrar
        //Con esto se captura los datos de la tabla.
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        Pt_Nombre = $(this).closest("tr").find('td:eq(2)').text();
        // var respuesta = confirm('¿Estás seguro de eliminar el registro: ' + id + ' ?');
        Swal.fire({
            title: '¿Estás seguro de eliminar el producto?',
            text: 'Producto a eliminar id: ' + id,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    '¡Eliminado!',
                    'El producto a sido eliminada.',
                    'success'
                )
                $.ajax({
                    type: "POST",//Método
                    url: "../../controlador/DataRoute.php",//Lugar
                    data: { id: id, Pt_Nombre, Pt_Nombre, opcion: opcion },//lo enviamos nombre a una variable nombre que está en php
                    dataType: "json",//Formato
                    success: function () {
                        tablaProducto.row(fila.parents('tr')).remove().draw();
                    }
                });
            }
        });
    });



    //función para válidar datos vácios
    function formulario_valido() { 
        if(Pt_Nombre == ''){
            return false;
        }else if(Pt_codigo == ''){
            return false;
        }else if(Pt_Presentacion == ''){
            return false;
        }else if(Pt_Stock == ''){
            return false;
        }else if(Pt_Precio == ''){
            return false;
        }else if(FK_ID_Categoria == ''){
            return false;
        }else if(FK_ID_Marca == ''){
            return false;
        }else if(Pt_Pais == ''){
            return false;
        }else if(Pt_Grados_alchol == ''){
            return false;
        }else if(Pt_Color == ''){
            return false;
        }else if(Pt_Imagen == ''){
            return false;
        }
        return true;
    }

     //función para válidar datos vácios
     function formulario_valido2() { 
        if(Pt_Nombre == ''){
            return false;
        }else if(Pt_codigo == ''){
            return false;
        }else if(Pt_Presentacion == ''){
            return false;
        }else if(Pt_Stock == ''){
            return false;
        }else if(Pt_Precio == ''){
            return false;
        }else if(Pt_Pais == ''){
            return false;
        }else if(Pt_Grados_alchol == ''){
            return false;
        }else if(Pt_Color == ''){
            return false;
        }
        return true;
    }
});

function cambiar(){
    var pdrs = document.getElementById('Pt_Imagen').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}

function cambiar2(){
    var pdrs = document.getElementById('Pt_Imagen2').files[0].name;
    document.getElementById('info2').innerHTML = pdrs;
}

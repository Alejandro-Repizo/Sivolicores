$(document).ready( function() {

    // Mensaje superior
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500
    });

    // Login 
    $("#btn_Iniciar_Sesion").click (function (ev) { 

        // Recibe los datos del formulario
        let oData = new FormData(document.forms.namedItem("form_login"));

        let oReq = new XMLHttpRequest();
        oReq.open("POST", "app/login.php");
        oReq.onload = function (oEvent) { 
            let datos =  JSON.parse(oReq.response);

            if (oReq.status == 200) {
                if (datos.mensaje != true) {
                    console.log("error");
                    document.getElementById("alerta").style.display = "block";
                    document.getElementById('Cl_email').style.borderColor = "red";
                    document.getElementById('Cl_password').style.borderColor = "red";
                    document.forms.namedItem("form_login").reset();
                    document.getElementById('mensaje_error').innerHTML = datos.mensaje;
                }else {
                    location.href = "index.php";
                }
            } else {
                console.log("Error" + oReq.status);
            }
        };

        oReq.send(oData);
        ev.preventDefault();
    });

    // Registro usuario
    $("#btn_registrase").click (function (ev) { 

        //Recibe los datos del formulario
        var oData = new FormData();

        Cl_Nombre = $.trim($("#Cl_Nombre").val());
        Cl_Apellido = $.trim($("#Cl_Apellido").val());
        Cl_Dirección = $.trim($("#Cl_Dirección").val());
        Cl_Telefono = $.trim($("#Cl_Telefono").val());
        Cl_email = $.trim($("#Cl_email").val());
        Cl_password = $.trim($("#Cl_password").val());
        Cl_password2 = $.trim($("#Cl_password2").val());
        if (formulario_valido()) {
            if (password_iguales()) {
                oData.append("Cl_Nombre", Cl_Nombre);
                oData.append("Cl_Apellido", Cl_Apellido);
                oData.append("Cl_Dirección", Cl_Dirección);
                oData.append("Cl_Telefono", Cl_Telefono);
                oData.append("Cl_email", Cl_email);
                oData.append("Cl_password", Cl_password);
                
                let oReq = new XMLHttpRequest();
                oReq.open("POST", "app/Registro.php");
                oReq.onload = function(oEvent) {
                    let datos =  JSON.parse(oReq.response);

                    if (oReq.status === 200) {
                        if (datos.correcto === true) {
                            Swal.fire({
                                type: 'success',
                                title: 'El usuario ha sido ¡correctamente!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(() => location.href = 'login.php', 1500);
                        }else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Error',
                                text: 'Error al crear el usuario.'
                            });
                            document.getElementById('alerta').style.display = "block";
                            document.getElementById('mensaje_error').innerHTML = "Error al crear el usuario.";
                        }
                    } else {
                        console.log("Error" + oReq.status);
                    }
                }
                oReq.send(oData);
            }else {
                document.getElementById('Cl_password').style.borderColor = "red";
                document.getElementById('Cl_password2').style.borderColor = "red";
                document.getElementById('alerta').style.display = "block";
                document.getElementById('mensaje_error').innerHTML = "las contraseñas no son iguales.";
            }
        }else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Algunos campos están vacíos.'
            });
            document.getElementById('alerta').style.display = "block";
            document.getElementById('mensaje_error').innerHTML = "Algunos campos están vacíos.";
        }
        
        ev.preventDefault();
    });

    // Editar usuario
    $("#btn_editar").click (function (ev) {

        //Recibe los datos del formulario
        let oData =  new FormData();

        Cl_Nombre = $.trim($("#Cl_Nombre").val());
        Cl_Apellido = $.trim($("#Cl_Apellido").val());
        Cl_Dirección = $.trim($("#Cl_Dirección").val());
        Cl_Telefono = $.trim($("#Cl_Telefono").val());
        Cl_password = $.trim($("#Cl_password").val());
        Cl_password2 = $.trim($("#Cl_password2").val());

        if (formulario_valido_editar()) {
      
            if (password_iguales()) {
                
                oData.append("Cl_Nombre", Cl_Nombre);
                oData.append("Cl_Apellido", Cl_Apellido);
                oData.append("Cl_Dirección", Cl_Dirección);
                oData.append("Cl_Telefono", Cl_Telefono);
                oData.append("Cl_password", Cl_password);

                let oReq = new XMLHttpRequest();
                oReq.open("POST", "app/Editar.php");
                oReq.onload = function(oEvent) {
                    let datos = JSON.parse(oReq.response);
                    
                    if (oReq.status === 200) {
                        if (datos.correcto === true) {
                            Toast.fire({
                                type: 'success',
                                title: 'Los datos han sido actualizados ¡correctamente!'
                            })

                            setTimeout(() => location.href = 'editar.php', 1500);
                        }else {
                            Swal.fire({
                                type: 'warning',
                                title: 'Error',
                                text: 'Error al editar el usuario.'
                            });
                            document.getElementById('alerta').style.display = "block";
                            document.getElementById('mensaje_error').innerHTML = "Ha ocurrido un error al momento de editar el usuario.";
                        }
                    } else {
                        console.log("Error" + oReq.status);
                    }
                }
                oReq.send(oData);
            }else {
                document.getElementById('Cl_password').style.borderColor = "red";
                document.getElementById('Cl_password2').style.borderColor = "red";
                document.getElementById('alerta').style.display = "block";
                document.getElementById('mensaje_error').innerHTML = "las contraseñas digitadas no son iguales.";
            }
        }else {
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Algunos campos están vacíos.'
            });
            document.getElementById('alerta').style.display = "block";
            document.getElementById('mensaje_error').innerHTML = "Algunos campos de la sección 'cambio de información' están vacíos.";
        }

        ev.preventDefault();
    });

    // Test pedidos
    $("#btn-pedido").click (function(ev) {

        let oReq = new XMLHttpRequest();
        oReq.open("POST", "app/pedidos.php");
        oReq.onload = function (oEvent){
            let datos =  JSON.parse(oReq.response);
            console.log(datos);
        }

        oReq.send();

        ev.preventDefault();
    })


    //Carrtito 
    $(document).on('click', '#btn_add_cart',function() {
        let PK_ID_Producto = $.trim($("#PK_ID_Producto").val());
        let Pt_Nombre = $.trim($('#Pt_Nombre'+PK_ID_Producto+'').val());
        let Pt_Precio = $('#Pt_Precio'+PK_ID_Producto+'').val();
        let Pt_Cantidad = $('#Pt_Cantidad'+PK_ID_Producto+'').val();
        let Pt_Imagen = $.trim($('#Pt_Imagen'+PK_ID_Producto).val());
        let action = 'add';
        if (Pt_Cantidad > 0) {
            $.ajax({
                url: "app/action.php",
                method: "POST",
                data: {PK_ID_Producto:PK_ID_Producto, Pt_Nombre:Pt_Nombre, Pt_Precio:Pt_Precio, Pt_Cantidad:Pt_Cantidad,Pt_Imagen:Pt_Imagen, action:action},
                success:function(data)
				{
                    Toast.fire({
                        type: 'success',
                        title: 'Producto añadido al carrito!'
                    })
				}
            });
        }
    });

    // Eliminar producto
    
    $(document).on('click', '.btn_delete_cart',function() {
        let PK_ID_Producto = $(this).attr("id");
        let action = 'remove';
        Swal.fire({
            title: '¿Estás seguro de eliminar este producto?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: ' #d9a520',
            cancelButtonColor: '#000002',
            confirmButtonText: 'Si, ¡Eliminar!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"app/action.php",
                    method:"POST",
                    data:{PK_ID_Producto:PK_ID_Producto, action:action},
                    success:function()
                    {
                        Toast.fire({
                            type: 'success',
                            title: 'Eliminando el producto'
                        });
                        setTimeout(() => location.href = 'carrito.php', 1500);
                    }
                })
            }
        });
        
    });

    // Actualizar un producto
    $(document).on('click', '#btn_update_cart', function() {
    
        let productos =  document.querySelectorAll('.cantidad');
        let map = new Map();
        let PK_ID_Producto;
        let Pt_Cantidad;
        let action = 'update';

        productos.forEach((producto) =>{
            map.set(Number(producto.id), Number(producto.value));
        });

        for(let[key, value] of map) {
            PK_ID_Producto =  key;
            Pt_Cantidad = value;
            console.log(PK_ID_Producto + " - " + Pt_Cantidad);
            $.ajax({
                url: "app/action.php",
                method: "POST",
                data: {PK_ID_Producto:PK_ID_Producto, Pt_Cantidad:Pt_Cantidad, action:action},
                success:function(data)
            	{
                    Toast.fire({
                        type: 'success',
                        title: 'Actualizando el pedido'
                    });
                  setTimeout(() => location.href = 'carrito.php', 1000);
            	}
            });
        }
    });

    // Eliminar todo el carrito
    $("#btn_delete_all").click( function() {
        let action = "empty";
        $.ajax({
            url: "app/action.php",
            method: "POST",
            data: {action:action},
            success:function(data)
			{
                Toast.fire({
                    type: 'success',
                    title: 'Eliminando el pedido'
                });
              setTimeout(() => location.href = 'carrito.php', 1000);
			}
        });
    });
});

function formulario_valido() {
    if(Cl_Nombre === ''){
        return false;
    }else if(Cl_Apellido == ''){
        return false;
    }else if(Cl_Dirección == ''){
        return false;
    }else if(Cl_Telefono == ''){
        return false;
    }else if(Cl_email == ''){
        return false;
    }else if(Cl_password == ''){
        return false;
    }else if(Cl_password2 == ''){
        return false;
    }
    return true;
}

function formulario_valido_editar() {
    if(Cl_Nombre == ''){
        return false;
    }else if(Cl_Apellido == ''){
        return false;
    }else if(Cl_Dirección == ''){
        return false;
    }else if(Cl_Telefono == ''){
        return false;
    }
    return true;
}

function password_iguales() {
    if (Cl_password  === Cl_password2) {
        return true;
    }
    return false;
}
$(document).ready(function() {

    var opcion = "cargarEditarUsuario";
    var peticionXML = new XMLHttpRequest;
    peticionXML.open('POST', '../../controlador/DataRoute.php');
    var parametros = 'opcion=' + opcion;
    peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticionXML.onload = function() {
        var datos = JSON.parse(peticionXML.responseText);
        if(datos.error){
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Se ha producido un error.'
            });
        }else{
            datos.forEach(administrador => {
                //seteamos los valores recolectados en la tabla hacia los input's.
                $("#ad_primaria").val(administrador.PK_ID_Administrador);
                $("#Ad_Nombre").val(administrador.Ad_Nombre);
                $("#Ad_Apellido").val(administrador.Ad_Apellido);
                $("#Ad_Email").val(administrador.Ad_Email);
            });
           
        }
    }
    peticionXML.onreadystatechange = function(){
        if(peticionXML.readyState == 4 && peticionXML.status == 200){
            console.log(peticionXML.status);
        }
    }
    peticionXML.send(parametros);
    
    $('#formEditarPerfil').submit(function (e) { 
        e.preventDefault();
        opcion = 'editarUsuario';
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST', '../../controlador/DataRoute.php');
        PK_ID_Administrador = $.trim($('PK_ID_Administrador').val());
        Ad_Nombre = $.trim($('#Ad_Nombre').val());
        Ad_Apellido = $.trim($('#Ad_Apellido').val());
        Ad_Email = $.trim($('#Ad_Email').val());
        Ad_Password = $.trim($('#Ad_Password').val());
        Ad_Password2 = $.trim($('#Ad_Password2').val());

        if(formulario_valido()){
            if(password_iguales()){
                var parametros = 'id='+ PK_ID_Administrador +'&Ad_Nombre='+ Ad_Nombre  +'&Ad_Apellido='+ Ad_Apellido  +'&Ad_Email='+ Ad_Email  +'&Ad_Password='+ Ad_Password +'&opcion=' + opcion;
                peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                peticionXML.onload = function(){
                    var datos = JSON.parse(peticionXML.responseText);
                    if(datos.error){
                        Swal.fire({
                            type: 'warning',
                            title: 'Error',
                            text: 'Se ha producido un error.'
                        });
                    }else if(datos.correcto){
                        document.getElementById('Ad_Password').style.borderColor = "#00000042";
                        document.getElementById('Ad_Password2').style.borderColor = "#00000042";
                        document.getElementById('alerta').style.display = "none";   
                        document.getElementById('Ad_Password').value = '';
                        document.getElementById('Ad_Password2').value = '';
                        Swal.fire({
                            type: 'success',
                            title: 'Éxito',
                            text: 'Perfil editado con éxito.'
                        }); 
                                     
                    }
                }
                peticionXML.onreadystatechange = function(){
                    if(peticionXML.readyState == 4 && peticionXML.status == 200){
                        console.log(peticionXML.status);
                    }
                }
                peticionXML.send(parametros);
            }else{
                Swal.fire({
                    type: 'warning',
                    title: 'Error',
                    text: 'las contraseñas no son iguales.'
                });
                document.getElementById('Ad_Password').style.borderColor = "red";
                document.getElementById('Ad_Password2').style.borderColor = "red";
                document.getElementById('alerta').style.display = "block";
                document.getElementById('mensaje_error').innerHTML = "las contraseñas no son iguales";
            }
        }else{
            Swal.fire({
                type: 'warning',
                title: 'Error',
                text: 'Se ha producido un error.'
            });
        }

    });

    function formulario_valido() {
        if(Ad_Nombre == '') {
            return false;
        }else if(Ad_Apellido == '') {
            return false;
        }else if(Ad_Email == '') {
            return false;
        }
        return true;
    }

    function password_iguales() {
        if(Ad_Password === Ad_Password2){
            return true;
        }
        return false;
    }
    
});

//que está haciendo, va hacer traer los datos de la bd, a través de ajax.
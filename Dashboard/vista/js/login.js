$(document).ready(function () {

    var opcion = 'login';

    $("#formLogin").submit( function (e) {
        e.preventDefault();
        var peticionXML = new XMLHttpRequest;
        peticionXML.open('POST','controlador/DataRoute.php');
        ses_email = $.trim($("#ses_email").val());
        ses_password = $.trim($("#ses_password").val());
        
        if (formulario_valido()) {

            var parametros = 'ses_email=' + ses_email + '&ses_password=' + ses_password + '&opcion=' + opcion;
            peticionXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            peticionXML.onload  = function() {
                var datos = JSON.parse(peticionXML.response);
                if(datos.error){
                    document.getElementById('alerta').style.display = "block";
                    document.getElementById('mensaje_error').innerHTML = datos.error;
                    $('#formLogin').trigger("reset");
                }else{
                    location.href = "vista/html/Dashboard.php";
                }
            }
            peticionXML.onreadystatechange = function(){
                if(peticionXML.readyState == 4 && peticionXML.status == 200){
                    console.log(peticionXML.status);
                }
            }
            peticionXML.send(parametros);
        }else {
            document.getElementById('mensaje_error').innerHTML = "Rellena todos los espacios correctamente";
        }
    });

    //Function para validad datos vacios
    function formulario_valido() {
        if (ses_email == '') {
            return false;
        }else if (ses_password == '') {
            return false;
        }
        return true;
    }
});
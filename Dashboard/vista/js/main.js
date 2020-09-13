$(document).ready(function() {
    //Botón Adminstrador
    const btnAdministrador = document.getElementById('btn-administrador'),
    opcion = document.getElementById('opcion');
   
    btnAdministrador.addEventListener('mouseover', () =>{
        opcion.classList.add('activo');
    }); 
    opcion.addEventListener('mouseleave', () =>{
        opcion.classList.remove('activo');
    });

    //Menú lateral desplegable
    $('.menu li:has(ul)').click(function(e) {
        e.preventDefault();

        if ($(this).hasClass('activado')) {
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
        } else {
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });

    $('.menu li ul li a').click(function() {
        window.location.href = $(this).attr("href");
    });

  



});


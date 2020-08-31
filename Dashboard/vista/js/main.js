const btnAdministrador = document.getElementById('btn-administrador'),
 opcion = document.getElementById('opcion');

btnAdministrador.addEventListener('mouseover', () =>{
    opcion.classList.add('activo');
});


opcion.addEventListener('mouseleave', () =>{
    opcion.classList.remove('activo');
});


$(document).ready(function() {
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
$("#btn").click(function(){
    //alert("Hola");
    Swal.fire({
        icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
    });
});

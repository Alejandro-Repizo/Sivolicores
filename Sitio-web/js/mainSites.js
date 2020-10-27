//Menu de las pagiunas
var altura2 = $('.menu3').offset().top;

$(window).on('scroll', function () {
    if ($(window).scrollTop() > altura2) {
        $('.menu3').addClass('menu-oculto2'),
            $('.menu4').addClass('menu-fixed');
    } else {
        $('.menu3').removeClass('menu-oculto2'),
            $('.menu4').removeClass('menu-fixed');
    }
});

$('.menuMobileWrapper li:has(ul)').click(function(e){
    e.preventDefault();

    if ($(this).hasClass('activado')){
        $(this).removeClass('activado');
        $(this).children('ul').slideUp();
    } else{
        $('.menuMobileWrapper  li ul').slideUp();
        $('.menuMobileWrapper  li').removeClass('activado');
        $(this).addClass('activado');
        $(this).children('ul').slideDown();
    }
});

$('.menuMobileWrapper li ul li a').click(function(){
    window.location.href = $(this).attr("href");
});

$("#btn-burger").click(function(e) { 
    e.preventDefault();
    if($('#menuMobileWrapper').hasClass('contenedor-menu-active')){
        $('#menuMobileWrapper').removeClass('contenedor-menu-active');  
        $('#menuMobileWrapper').children('ul').slideUp();
    } else {
        $('#menuMobileWrapper').addClass('contenedor-menu-active');    
        $('#menuMobileWrapper').children('ul').slideDown();
    }
});
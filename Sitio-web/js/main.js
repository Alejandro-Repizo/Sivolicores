$(document).ready(function(){

    $(window).scroll(function(){
        var barra = $(window).scrollTop();
        var posicion = barra * 0.01;

        $('.contenedor-parallax').css({
            'background-position': '0 -' + posicion + 'px'
        });
    });
    
    var altura = $('.menu').offset().top;

    $(window).on('scroll', function(){
        if($(window).scrollTop() > altura){
            $('.menu').addClass('menu-oculto'),
            $('.menu2').addClass('menu-activo'),
            $('.menu3').addClass('menu-fixed');
        } else {
            $('.menu').removeClass('menu-oculto'),
            $('.menu2').removeClass('menu-activo'),
            $('.menu3').removeClass('menu-fixed');
        }
    });
    
    

});


var altura2 = $('.menu3').offset().top;

    $(window).on('scroll', function(){
        if($(window).scrollTop() > altura2){
            $('.menu3').addClass('menu-oculto2'),
            $('.menu4').addClass('menu-fixed');
        } else {
            $('.menu3').removeClass('menu-oculto2'),
            $('.menu4').removeClass('menu-fixed');
        }
    });
    

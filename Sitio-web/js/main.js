$(document).ready(function () {

    //Parallax
    $(window).scroll(function () {
        var barra = $(window).scrollTop();
        var posicion = barra * 0.01;

        $('.contenedor-parallax').css({
            'background-position': '0 -' + posicion + 'px'
        });
    });


    //Menu Dashboard
    var altura = $('.menu').offset().top;

    $(window).on('scroll', function () {
        if ($(window).scrollTop() > altura) {
            $('.menu').addClass('menu-oculto'),
                $('.menu2').addClass('menu-activo'),
                $('.menu3').addClass('menu-fixed');
        } else {
            $('.menu').removeClass('menu-oculto'),
                $('.menu2').removeClass('menu-activo'),
                $('.menu3').removeClass('menu-fixed');
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

    $("#btn-user").click(function(e){
        e.preventDefault();
        if($('.right-menu').hasClass('right-menu-active')){
            $('.right-menu').removeClass('right-menu-active');
        } else {
            $('.right-menu').toggleClass('right-menu-active');
            $('#btn-user-peg').addClass('icon-behind');
        }
    }) 

    $("#btn-user-peg").click(function(e){
        e.preventDefault();
        if($('.right-menu').hasClass('right-menu-active')){
            $('.right-menu').removeClass('right-menu-active');
        } else {
            $('.right-menu').toggleClass('right-menu-active');
            $('#btn-user-peg').addClass('icon-behind');
        }
    }) 

    $("#btn-user-mob").click(function(e){
        e.preventDefault();
        if($('.right-menu').hasClass('right-menu-active')){
            $('.right-menu').removeClass('right-menu-active');
        } else {
            $('.right-menu').toggleClass('right-menu-active');
        }
    }) 


    $("#btn-beh").click(function(e){
        e.preventDefault();
        $('.right-menu').removeClass('right-menu-active');
        $('#btn-user-peg').removeClass('icon-behind');
    }) 


    //Modal pedidos
    $("#btn-pedido").click( function(e) {
        e.preventDefault();
        $(".modal-header").css("background-color", "#000002");
        $(".modal-title").text("Tus pedidos").css("color", "#d9a520").css("font-family", "'Montserrat', sans-serif").css("font-size", "16px");
        $("#modalPedidos").modal("show");
    })

});

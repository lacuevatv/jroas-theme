/**
 * File mains-script.js.
 *
 * @ver 1.0
 */

//document ready
( function( $ ) {

    
    console.log('ready')
        
    var jorgeRojas = (function () {



        /******************/
    
        /*   Variables   */
    
        /******************/
    
    
    
    
        /******************/
    
        /* Initialize App */
    
        /******************/
    
        function initialize() {
            console.log('init');
    
            activateSliders();
            extraInfoAgenda();
            //toglerNav();
        }
    
        /***************/
    
        /* Bind Events */
    
        /***************/
        
    
    
        /************************/
    
        /* Render Content Pages */
    
        /************************/
    
        function _render() {
    
    
        }
    
        /*********************/
    
        /* General Functions */
    
        /*********************/
    
        //asigna una clase al titulo para poder cambiar al abrir el menu
        $('.navbar-toggler').on('click', function(){
            console.log('he')
            $('.navbar-title').toggleClass('navbar-title-opened');
        });


        /*
         * formularios
        */
        $(document).on('submit', '#contact_form', function( e ) {
            e.preventDefault();
            //var loader = $('.loader');
            
            var msj = $(this).find('.msj-formulario');
            formData = new FormData( this );

            /*
             * datos del formulario
            */
           var name = $(this).find('input[name="contact_name"]').val();
           var email = $(this).find('input[name="contact_email"]').val();
           var mensaje = $(this).find('textarea[name="contact_msj"]').val();
           var formulario = 'contacto';

            $.ajax( {
                type: 'POST',
                url: window.jrojasScriptsData.ajaxurl,
                data: {
                    action: 'formulario_contacto',
                    name: name,
                    email:email,
                    mensaje:mensaje,
                    formulario:formulario,
                },
                
                //funcion antes de enviar
                beforeSend: function() {
                    $(msj).text('Enviando formulario').fadeIn();
                },
                success: function ( response ) {
                    //console.log(response);
                    msj.text(response);
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax

        });//submit formulario 1

        $(document).on('submit', '#contratacion_form', function( e ) {
            e.preventDefault();
            //var loader = $('.loader');
            
            var msj = $(this).find('.msj-formulario');
            formData = new FormData( this );


            /*
             * datos del formulario
            */
            var name = $(this).find('input[name="contratacion_name"]').val();
            var email = $(this).find('input[name="contratacion_email"]').val();
            var mensaje = $(this).find('textarea[name="contratacion_msj"]').val();
            var formulario = 'contratacion';
           
            $.ajax( {
                type: 'POST',
                url: window.jrojasScriptsData.ajaxurl,
                data: {
                    action: 'formulario_contacto',
                    name: name,
                    email:email,
                    mensaje:mensaje,
                    formulario:formulario,
                },
                
                //funcion antes de enviar
                beforeSend: function() {
                    $(msj).text('Enviando formulario').fadeIn();
                },
                success: function ( response ) {
                    msj.text(response);
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax

        });//submit formulario 2

        $(document).on('submit', '#contacto-home', function( e ) {
            e.preventDefault();
            //var loader = $('.loader');
            var formularioBorrar = this;
            var msj = $('.msj-formulario-home');
            formData = new FormData( this );

            /*
             * datos del formulario
            */
            var name = $(this).find('input[name="input-name"]').val();
            var email = $(this).find('input[name="input-mail"]').val();
            var formulario = 'suscripcion';
            
            $.ajax( {
                type: 'POST',
                url: window.jrojasScriptsData.ajaxurl,
                data: {
                    action: 'formulario_contacto',
                    name: name,
                    email:email,
                    formulario:formulario,
                },
                
                //funcion antes de enviar
                beforeSend: function() {
                    $(msj).text('Enviando formulario').fadeIn();
                },
                success: function ( response ) {
                    msj.text(response);
                    $(formularioBorrar).fadeOut();
                },
                error: function ( ) {
                    console.log('error');
                },
            });//cierre ajax

        });//submit formulario 3
    
        /*smooth scroll */
    
        (function (b) {
            var c = window.location.hash;
            1 < c.length && (c = b(c), c.length && b("html,body").animate({
                scrollTop: c.offset().top
            }, 400));
            b(document).on("click", "a", function (c) {
                var a = b(this).attr("href");
                if (a && ~a.indexOf("#")) {
                    var a = a.substr(a.indexOf("#") + 1),
                        d = b("a[name=" + a + "]"),
                        e = b("#" + a);
                    console.log(a);
                    d = d.length ? d : e;
                    d.length && (c.preventDefault(), b("html,body").animate({
                        scrollTop: d.offset().top
                    }, 400))
                }
            })
        })(jQuery);
    
    
        function activateSliders() {
            //fecha 
            $("#slick-carousel-fecha").slick({
                slidesToScroll: 1,
                slidesToShow: 1,
                centerMode: true,
                arrows: false,
                asNavFor: '#slick-carousel-eventos',
                dots: false,
                infinite: false,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 5,
                            initialSlide: 1,
                            centerMode: true
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            initialSlide: 1,
                            centerMode: true
                        }
                    }
                ]
            });
    
            //eventos
            $('#slick-carousel-eventos').slick({
                asNavFor: '#slick-carousel-fecha',
                infinite: false,
                arrows: false,
                adaptiveHeight: true,
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            initialSlide: 1,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            initialSlide: 1,
                        }
                    }
                ]
        
            });
    
            //inner 
            $('.grilla-eventos').slick({
                infinite: false,
                slidesToScroll: 1,
                slidesToShow: 1,
                adaptiveHeight: true,
                arrows: true,
                //img de las flechas
                prevArrow: '<div class="prev-arrow" style="color: white">  < </div>',
                nextArrow: '<div class="next-arrow" style="color: white">  > </div>',
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: 'unslick'
                    }
                ]
            });
    
    
    
            $('.biografia-slider').slick({
                infinite: false,
                vertical:true,
                verticalSwiping: true,
                arrows: true,
                prevArrow: '<button class="scroll-btn"><img class="prev-arrow" src="../img/dist/arrow-next.png" alt="Flecha para scroll"></button>',
                nextArrow: '<button class="scroll-btn"><img class="next-arrow" src="../img/dist/arrow-next.png" alt="Flecha para scroll"></button>',
                mobileFirst: true,
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            vertical: false,
                            verticalSwiping:false
                        }
                    }
                ]
    
            });
    
    
            //slider galeria
            $('.slider-galeria-bigger').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.slider-galeria-nav',
                prevArrow:'<button type="button" class="slick-prev"><span class="sr-only">Anterior</span></button>',
                nextArrow:'<button type="button" class="slick-next"><span class="sr-only">Siguiente</span></button>',
                });
                //indice:
            $('.slider-galeria-nav').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.slider-galeria-bigger',
                arrows: false,
                dots: false,
                centerMode: true,
                focusOnSelect: true
            });
    
    
            //slider obra
            //indice
            $('.header-slider').slick({
                slidesToShow: 7,
                slidesToScroll: 1,
                asNavFor: '.body-slider',
                arrows: true,
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                centerPadding: '0x',
                prevArrow:'<button type="button" class="slick-prev"><span class="sr-only">Anterior</span></button>',
                nextArrow:'<button type="button" class="slick-next"><span class="sr-only">Siguiente</span></button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            centerMode: true,
                            slidesToShow: 5
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            centerMode: true,
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            centerMode: true,
                            slidesToShow: 1,
                            centerPadding: '0x',
                        },
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            centerMode: true,
                            slidesToShow: 1,
                            
                        },
                    },
                ]
            });
            //contenido
            $('.body-slider').slick({
                centerMode: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                adaptiveHeight:true,
                asNavFor: '.header-slider',
            });
            
            $('.header-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                var item = $('.item-body')[nextSlide];
                var fechaContenedor = $(item).find('.fecha')[0];
                var fecha = $(fechaContenedor).text();
    
                if ( fecha !=  $('.data-fecha').text()  && fecha != '' ) {
                    $('.data-fecha').text(fecha)
                }
            });
    
        }
    
    
        //unslick/slick grilla eventos on resize
        $(window).on('resize', function () {
            console.log('resize');
            var win = $(this); //this = window
            if (win.width() > 767) {
                //unslick grilla eventos
                // $('.grilla-eventos').slick('unslick');
                // console.log('unslick grilla eventos')
            } else {
                //reinit grilla eventos
                $('.grilla-eventos').slick({
                    infinite: false,
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    adaptiveHeight: true,
                    arrows: true,
                    //img de las flechas
                    prevArrow: '<div class="prev-arrow" style="color: white">  < </div>',
                    nextArrow: '<div class="next-arrow" style="color: white">  > </div>'
                });
                
    
            }
        });
    
        function extraInfoAgenda() {
            $('.more-info-btn').on('click', function () {
                var evento = $(this).closest('.evento');
                evento.addClass('expand-info');
            });
            $('.hide-info-btn').on('click', function () {
                var evento = $(this).closest('.evento');
                evento.removeClass('expand-info');
            });
    
        }
    
    
        
    
        /********************/
    
        /* Public Functions */
    
        /********************/
    
        return {
            initialize: initialize,
        };
    
    
    })();
    
    jorgeRojas.initialize();

} )( jQuery );


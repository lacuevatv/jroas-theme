jQuery(function($){
    
    /*$(document).on( 'click', '.upload-logo-uk', function( event ){

        event.preventDefault();
        //variables:
        var contenedor = this.closest('.uk-settings-page-inputs');
        var input = $(contenedor).find('input');

        var frame;

        // Create a new media frame
        frame = wp.media({
            title: 'Seleccionar o subir medio',
            button: {
            text: 'Usar éste medio'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {
            //toma los detalles de la imagen seleccionada
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.url);   
        });

        // Finally, open the modal on click
        frame.open();
    });*/

    $(document).on( 'click', '.upload-images', function( event ){

        event.preventDefault();
        //variables:
        var contenedor = this.closest('.metabox_input_data');
        var input = $(contenedor).find('input');

        var frame;

        // Create a new media frame
        frame = wp.media({
            title: 'Seleccionar o subir medio',
            button: {
            text: 'Usar éste medio'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {
            //toma los detalles de la imagen seleccionada
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.url);   
        });

        // Finally, open the modal on click
        frame.open();
    });

    
    //SUBE MUCHAS IMAGENES PARA LA GALERÍA
    $(document).on( 'click', '.upload-imagenes', function( event ){

        event.preventDefault();
        //variables:
        var contenedor = this.closest('.metabox_input_data');
        var input = $('#uk_imagenes');

        var urlImagenesPreview = [];
        var frame;
        
        // Create a new media frame
        frame = wp.media({
            title: 'Seleccionar o subir medio',
            button: {
            text: 'Usar éste medio'
            },
            multiple: true  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {
            var selecionados;
            //toma los detalles de la imagen seleccionada
            //var attachment = frame.state().get('selection').first().toJSON();
            var selection = frame.state().get('selection');
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                //guarda los nuevos datos en un input
                input.val( input.val()+attachment.id+',');
                //guardar data para actualizar
                urlImagenesPreview.push(attachment);

            });
            console.log(urlImagenesPreview)
            //actualizar la vista previa
            addimagestopreview(urlImagenesPreview);
            
            
        });

        // Finally, open the modal on click
        frame.open();

        
    });


    //eliminar imagen al hacer clic en la cruz
    $(document).on('click', '.del-image', function(){
        var id = $(this).attr('data-id');
        var li = $(this).closest('li').remove();

        //borrarla del input
        var input = $('#uk_imagenes');
        var imagenes = $(input).val();
        var nuevosvalores = imagenes.replace( id+',' , '' );
        $(input).val(nuevosvalores)
    });

    //ordenar imagenes
    var ordenIds = '';
    $( '.imagenes-galeria' ).sortable({
		stop: function () {
            //borramos
            ordenIds = '';

			var li = $(this).find('li');
			for (var i = 0; i < li.length; i++) {
                $(li[i]).attr('data-orden', i+1);
                ordenIds += $(li[i]).attr('data-id') + ',';
				
            }
            
            $('#uk_imagenes').val(ordenIds);
		},
	});
	$( '.imagenes-galeria' ).disableSelection();

    //agrega nuevas imagenes
    function addimagestopreview( data ) {
        var input = $('#uk_imagenes');
            var html = '';
        for (var i = 0; i < data.length; i++) {
            html += '<li data-id="'+data[i].id+'" data-orden="0"><button class="del-image" data-id="'+data[i].id+'"></button><img src="'+data[i].url+'"></li>';
        }

        if ( html != '') {
            $('.imagenes-galeria').append( $(html) );
        }

    }//updateGaleriaPreview()


    //guarda los cursos en un input al ser seleccionados
    $(document).on('click', '.input_cursos', function(e) {
        var idCurso = $(this).attr('data-id');
        var inputCursos = $('input[name="jrojas_canciones"]');
        var cursosValores = $(inputCursos).val();
        if ( $(this).attr('checked') ) {
            //si es chequeado se agrega al inputCursos

            //busca a ver si ya esta agregado y si esta no hace nada
            if ( cursosValores.indexOf(idCurso) == '-1' ) {
                cursosValores = cursosValores + idCurso + ',';
            }

        } else {
            //Si se desmarca hay que borrarlo
            
            if ( cursosValores.indexOf(idCurso) != '-1' ) {
                cursosValores = cursosValores.replace( idCurso+',' , '' );
            }

        }

        $(inputCursos).val(cursosValores);
    });



    //canciones en obras
    //ordenar
    $( '.lista-canciones' ).sortable({
		stop: function () {
            console.log('stop')
            //borramos
            //ordenIds = '';

            reordenar();
			
		},
    });
    $( '.lista-canciones' ).disableSelection();
    
     //borrar una canción
     $(document).on('click', '.del-cancion', function(e) {
        var li = $(this).closest('li');
        var text = $($(li).find('.name-cancion')).text();
        console.log(text)
        li.remove();

        reordenar();
    });

    //al escribir el input se guarda el nombre de la canción
    $(document).on('keyup', '.name-cancion', function(e) {
        guardarCanciones();
    });

    //agregar cancion
    $(document).on('click', '.agregar-cancion', function(e) {
        agregar('');

        reordenar();
    });

    //carga la lista de canciones al inicio si hay algunas
    $(document).ready( function(e) {

        var inputHidden = $('#jrojas_canciones');
        var canciones = $(inputHidden).val();
        
        if (canciones != '') {
            var arrayCanciones = canciones.split('_');

            for (i = 0; i < arrayCanciones.length; i++) {
                agregar(arrayCanciones[i]);
            }

            reordenar();

        } else {
            console.log('no hay canciones')
        }
    });
    
    //carga las canciones si hay alguna


    //FUNCION guarda canciones en input
    function guardarCanciones() {
        var inputHidden = $('#jrojas_canciones');
        var cancionesOld = $(inputHidden).val();
        var cancionesNew = '';
        var lista = $( '.lista-canciones li .name-cancion' );

        for (i = 0; i < lista.length; i++) {
            cancionesNew += $(lista[i]).val();
            
            if ( i+1 != lista.length ) {
                cancionesNew+= '_';
            }
        }

        $(inputHidden).val(cancionesNew);

    }

    //FUNCION reordena y luego vuelve a guardar
    function reordenar()  {
        var li = $('.lista-canciones li');
			for (var i = 0; i < li.length; i++) {
                $(li[i]).find('.ordinal').text(i+1)
            }
            
            guardarCanciones();
    }

   
    //FUNCION agrega una cancion nueva y reordena
    function agregar(valor) {
        console.log(valor)
        var contenedor = $( '.lista-canciones' );
        var html = '<li><span class="ordinal">#</span>. <input name="name-cancion" type="text" class="name-cancion" value="'+valor+'"><button type="button" title="borrar canción" class="del-cancion"></button></li>';
        $(contenedor).append($(html));

        $( '.lista-canciones li input' )[$( '.lista-canciones li input' ).length-1].focus();

        //reordenar();
    }

});
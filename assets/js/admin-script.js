jQuery(function($){
    
    $(document).on( 'click', '.upload-logo-uk', function( event ){

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
    });

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

    //metaboxes: checkbox
    $('.input-checkbox').click(function(){
        $(this).attr
        if ( $(this).attr('checked') == 'checked' ) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
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
        var inputCursos = $('#cursos_id');
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


    //guarda los destinos en un input al ser seleccionados
    $(document).on('click', '.input_destinos', function(e) {
        var idDestino = $(this).attr('data-id');
        var inputDestinos = $('#destinos_id');
        var destinosValores = $(inputDestinos).val();
        if ( $(this).attr('checked') ) {
            //si es chequeado se agrega al inputCursos

            //busca a ver si ya esta agregado y si esta no hace nada
            if ( destinosValores.indexOf(idDestino) == '-1' ) {
                destinosValores = destinosValores + idDestino + ',';
            }

        } else {
            //Si se desmarca hay que borrarlo
            
            if ( destinosValores.indexOf(idDestino) != '-1' ) {
                destinosValores = destinosValores.replace( idDestino+',' , '' );
            }

        }

        $(inputDestinos).val(destinosValores);
    }); 
    
    
    //guarda los programas en un input al ser seleccionados
    $(document).on('click', '.input_programas', function(e) {
        
        var idPrograma = $(this).attr('data-id');
        var inputProgramas = $('#home_programas_id');
        var programasValores = $(inputProgramas).val();
        if ( $(this).attr('checked') ) {
            //si es chequeado se agrega al inputCursos

            //busca a ver si ya esta agregado y si esta no hace nada
            if ( programasValores.indexOf(idPrograma) == '-1' ) {
                programasValores = programasValores + idPrograma + ',';
            }

        } else {
            //Si se desmarca hay que borrarlo
            
            if ( programasValores.indexOf(idPrograma) != '-1' ) {
                programasValores = programasValores.replace( idPrograma+',' , '' );
            }

        }

        $(inputProgramas).val(programasValores);
    }); 

});
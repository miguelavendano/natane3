$(document).ready(function(){


	$("#notificacion").click(function() {
		alertaSimple("hola","esto es un alerte de prueba","success");
	});

	$("#notificacion2").click(function() {   		
		alertaConfirmacion("hola","esto es un alerte de prueba","error");
	});          



});



/*
 * Funcion que muestra un alert sencillos centrado
 *
 * titulo: titulo que tendra el alert	
 * subtitulo: subtitulo que se mostrara en el alert
 * tipo: tipo de alert a mostrar pueden ser: warning, info, success y error
 */
	function alertaSimple(titulo,subtitulo,tipo){

                    var icono = "";

                    if(tipo == "success"){
                            icono = "fa fa-check-circle fa-2x";
                    }else if(tipo == "warning"){
                            icono = "fa fa-exclamation-circle fa-2x";
                    }else if(tipo == "error"){
                            icono = "fa fa-warning fa-2x";	
                    }else if(tipo == "info"){
                            icono = "fa fa-info-circle fa-2x";
                    }

                    new PNotify({
                        title: titulo,
                        text: subtitulo,
                        type: tipo,
                        icon: icono,
                        delay: 2000,
                            buttons: {
                                    closer: false,
                                    sticker: false
                            },				    
                        before_open: function(PNotify) {
                            // Position this notice in the center of the screen.
                            PNotify.get().css({
                                "top": ($(window).height() / 2) - (PNotify.get().height() / 2),
                                "left": ($(window).width() / 2) - (PNotify.get().width() / 2)
                            });
                        }			    
                    });						

	}        


/*
 * Funcion que muestra un alert de confirmacion al estilo de una modal
 *
 * titulo: titulo que tendra el alert	
 * subtitulo: subtitulo que se mostrara en el alert
 * tipo: tipo de alert a mostrar pueden ser: warning, info, success y error
 * 
 accion_confirma: funcion o lo q debe realizar con la confirmacion 

 * retorno: la funcion retorna un valor true o false dependiendo de la confirmacion dada
 */
	function alertaConfirmacion(titulo,subtitulo,tipo,accion_confirma, accion_cancelado){

				var icono = "";

				if(tipo == "success"){
					icono = "fa fa-check-circle fa-2x";
				}else if(tipo == "warning"){
					icono = "fa fa-exclamation-circle fa-2x";
				}else if(tipo == "error"){
					icono = "fa fa-warning fa-2x";	
				}else if(tipo == "info"){
					icono = "fa fa-info-circle fa-2x";
				}


		    var modal_overlay;

		    info_box = new PNotify({
                                                title: titulo,
                                                text: subtitulo,
					        type: tipo,
					        icon: icono,
					        hide: false,
							confirm: {
								confirm: true
							},
							buttons: {
								closer: false,
								sticker: false
							},
							history: {
								history: false
							},
					        stack: false,
					        before_open: function(PNotify) {
					            // Position this notice in the center of the screen.
					            PNotify.get().css({
					                "top": ($(window).height() / 2) - (PNotify.get().height() / 2),
					                "left": ($(window).width() / 2) - (PNotify.get().width() / 2)
					            });
					            // Make a modal screen overlay.
					            if (modal_overlay) modal_overlay.fadeIn("fast");
					            else modal_overlay = $("<div />", {
					                "class": "ui-widget-overlay",
					                "css": {
					                    "display": "none",
					                    "position": "fixed",
					                    "top": "0",
					                    "bottom": "0",
					                    "right": "0",
					                    "left": "0",
					                    "z-index": "1050",
					                    "background-color":"rgba(38, 42, 51, 0.4)"
					                }
					            }).appendTo("body").fadeIn("fast");
					        },
					        before_close: function() {
					            modal_overlay.fadeOut("fast");
					        }
				    });


			info_box.get().on('pnotify.confirm', function(){
				
				if(accion_confirma){
					accion_confirma();
				}	

				return true;

			}).on('pnotify.cancel', function(){

				if(accion_cancelado){
					accion_cancelado();
				}

					return false;
			});
	}          






           
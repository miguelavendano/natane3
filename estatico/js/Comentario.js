$(document).ready(function(){

    /*
     * Crea el comentario
     */
    $("#comentar").click(function(){       
        
        if( $("#detalleComenta").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("El campo esta vacio");
            //Es un excelente lugar, allí se viven las mejores aventuras.... Recomendado... :D
        }else{            
            
            var mi_url=document.location.href;
            var id_img=mi_url.split("=");
            
                $.ajax({
                    url:'/natane3/estatico/php/opcionesComentario.php'
                    ,type:'POST'                    
                    ,data:{
                        opcion:'creaComentario',                            
                        comentario: $("#detalleComenta").val(),
                        imagen: id_img[1],
                        autor: '61'
                    }
                    ,dataType:'html'
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                //alert("Comentario Publicado :D");                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su comentario."); 
                    }
                });          
            }
        
    });
        
    
});


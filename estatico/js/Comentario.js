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
                                alert("Comentario Publicado :D");                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su comentario."); 
                    }
                });          
            }
        
    });
        
    
});

/*
    function editarComentario(id_comentario) {
        
            $(".pestañas").css({display:'none'});
            $(".editarExperiencia").css({display:'inline'});            
            $(".editarExperiencia").attr('id', id_experiencia);

            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'editarExp',                            
                    experiencia: id_comentario                
                }
                ,dataType:'JSON'
                ,beforeSend:function(jqXHR, settings ){

                    $("#reload").css({visibility: 'visible',
                                        opacity:'1',
                                        position: 'fixed',
                                        top: '200px',
                                        right: '50px',
                                        left: '50px',
                                        width: 'auto',
                                        margin: '0 auto'
                                    });   

                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    $("#reload").css({visibility: 'hidden'});   
                              
                   
                    $("#ediExpTitulo").val(data.nombre);
                    $("#ediExpDesc").val(data.descripcion);
                    
                    var marco="";
                    var edicion="";                    
                    var img="";
                    var todo="";
                    var lis_img="";
                    var ciclo=0;
                    
                    for(var i=0; i<data.imagenes.length; i++){                        
                        
                        marco="<div id="+data.imagenes[i].img_id+"_"+id_experiencia+" class='span3 marco_img_exp'>";
                        edicion="<div class='btn-block opc_img'>\n\
                                    <button class='btn icon-trash tooltip1' rel='tooltip' title='Eliminar' onclick='eliminarImgExperiencia("+id_experiencia+","+data.imagenes[i].img_id+")'></button>\n\
                                </div>";

                        img="<div class='im_exp_edit'><img src='/natane3/estatico/imagenes/"+data.imagenes[i].img_nombre+"' /></div>";

                        todo=marco+edicion+img+"</div>";

                        if(ciclo==0){
                            lis_img=lis_img+"<div class='row-fluid'>"+todo;                                                                                    
                            ciclo++;            
                        }
                        else if(ciclo<3){
                            lis_img=lis_img+todo;                            
                            ciclo++;                                                                      
                        }else if(ciclo==3){      
                            lis_img=lis_img+todo+"</div>";                            
                            ciclo=0;                                         
                        }  
                        
                    }                    
                    
                    $("#imgs_experiencia").html(lis_img);
                }
            });                                    
    }


    function eliminarComentario(id_comentario){
        
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'eliminarExp',                            
                    experiencia: id_comentario,
                    usuario: id_url[1]
                }
                ,dataType:'html'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                            if(/true/.test(data)) {                                
                                alert("Experiancia Eliminada :D");                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido eliminar su experiencia"); 
                }
            });                            
    }    
    */
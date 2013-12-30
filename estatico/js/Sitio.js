$(document).ready(function(){

    /*
     * Registro de un nuevo Sitio
     */
    $("#registrarS").click(function(){
        $("#registrarSitio").css({display:'inline'});   
    }); 

    /*
     * Guardar la creacion de un Sitio nuevo
     */
    $("#guarda_sitio").click(function(){
                
        if($("#Rpass1").val()==$("#Rpass2").val()){  //valida contraseñas         
                    $.ajax({
                        url:'/natane3/estatico/php/opcionesSitio.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'registrarS',
                            nombre: $("#RnomS").val(),
                            desc: $("#RdescS").val(),
                            tipo: $("input[name='RtipoS']:checked").val(),
                            city: $("#RcityS").val(),
                            dir: $("#RdirS").val(),
                            tel: $("#RtelS").val(),
                            mail: $("#RmailS").val(),
                            lat: $("#RlatS").val(),
                            lon: $("#RlonS").val(),
                            web: $("#RwebS").val(),
                            face: $("#RfaceS").val(),
                            twit: $("#RtwiS").val(),
                            you: $("#RyouS").val(),
                            contra1: $("#Rpass1S").val()
                        }
                        ,dataType:'html'
                        ,beforeSend:function(jqXHR, settings ){
                            //alert("Se esta creando su perfil");
                        }
                        ,success: function(data,textStatus,jqXHR){                           

                            var n=data.split(" ");                           

                            if(/true/.test(data)) {                                
                                alert("Registro Exitoso  :D"+n[0]);
                                document.location.href="http://localhost/natane3/modulos/sitios/sitio.php?id="+n[0];                                
                            }
                            else alert("No se ha podido realizar su registro"); 

                        }
                    });          
            }//cierre if
            else{
                alert("Las contraseñas no coinciden");
                }
        });
        
        
    /*
     * Editar datos del Sitio
     */
    $("#BeditarS").click(function(){

            $("#editarSitio").css({display:'inline'});   
            $("#slider_sitio").css({display:'none'});
            $("#ContenidoSitio").css({display:'none'});
            //$("#EmapaSitio").html("<div class='mapa-natane'></div>");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            
            

            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'editarS',                            
                    sitio: id_url[1]                    
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
                    
                    $(".reload-backdrop").css({ position: 'fixed',
                                                top: '0',
                                                right: '0',
                                                bottom: '0',
                                                left: '0',
                                                zIindex: '99999',
                                                background: '#000000',
                                                opacity:'0.4'
                                             });                  
                   
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                        $("#reload").css({visibility: 'hidden'});   
                        $(".reload-backdrop").css({visibility: 'hidden'});                    
                    
                        $("#EnomS").val(data.nombre);
                        $("#EdescS").val(data.desc);
                        $("#EcityS").val(data.city);
                        $("#EtelS").val(data.tel);                
                        $("#EdirS").val(data.direc);
                        $("#EmailS").val(data.mail);                        
                        $("#Es_webS").val(data.s_web);
                        $("#EfaceS").val(data.face);
                        $("#EtwiS").val(data.twi);
                        $("#EyouS").val(data.you);
                        $("#Epass1S").val(data.pass);
                        //$("#Eimagen").val(data.imagen);                        
                        
                        if(data.tipo=="icon-music"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_disco").attr("checked",true);     
                        }
                        else if(data.tipo=="icon-glass"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_bar").attr("checked",true);                            
                        }
                        else if(data.tipo=="icon-food"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_resta").attr("checked",true);                            
                        }
                        else if(data.tipo=="icon-suitcase"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_hotel").attr("checked",true);                            
                        }
                        else if(data.tipo=="icon-dribbble"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_recrea").attr("checked",true);                        
                        }
                        else if(data.tipo=="icon-road"){
                            $("input[name='EtipoS']").attr("checked",false);                                                           
                            $("#Et_camina").attr("checked",true);                        
                        }
                    
                }
            }); 
            
            editarMapaSitio(); //carga el mapa con la posibilidad de editar su posicion
    });


    /*
     * Guardar edicion de los datos del sitio
     
    $("#guarda_edicion_sitio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  

                $.ajax({
                    url:'/natane3/estatico/php/opcionesSitio.php'
                    ,type:'POST'                    
                    ,data:{
                        opcion: 'guardar_edicionS',                   
                        sitio: id_url[1],
                        nombre: $("#EnomS").val(),
                        descri: $("#EdescS").val(),
                        city: $("#EcityS").val(),                    
                        direc: $("#EdirS").val(),
                        tele: $("#EtelS").val(),                    
                        mail: $("#EmailS").val(),                    
                        lat_lon: mapa.getPosicion(),
                        s_web: $("#Es_webS").val(),
                        face: $("#EfaceS").val(),
                        twit: $("#EtwiS").val(),
                        youtube: $("#EyouS").val(),
                        tsitio: $("input[name='EtipoS']:checked").val(),
                        pass: $("#Epass1S").val()
                        //imagen: $("#Epass1").val(data.imagen),
                    }
                    ,dataType:'JSON'
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Cambios guardados.");
                                document.location.reload();                                     
                            }
                            else alert("No se han podido realizar los cambios");                                                     
                    }
                });                        
    });
    */    
        

    /*
     * Cancelar edicion de los datos del sitio
     */
    $(".cancelar_edicion_sitio").click(function(){        
            $("#editarSitio").css({display:'none'});   
            $("#slider_sitio").css({display:'inline'});
            $("#ContenidoSitio").css({display:'inline'});             
    }); 
    
    /*
     * Cancelar creacion de un sitio
     */   
    $(".cancelarRegistroSitio").click(function(){        
             $("#registrarSitio").css({display:'none'});   
             $(".pestañas").css({display:'inline'});    //en perfi de usuario muestra las experiencias
    });       
    


    /*
     * Crea la relacion haber visitado el sitio "Fan"
     */            
    $("#ha-estado").toggle(
      function() {      
                      
            $(this).addClass("active");
            $("#quiere-ir").addClass("disabled");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'visito',                   
                    sitio: id_url[1],
                    usuario: '62'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                }
            });                                   
        
      }, function() {   
          
            $(this).removeClass("active");            
            $("#quiere-ir").removeClass("disabled");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'elimina-visita',
                    sitio: id_url[1],
                    usuario: '62'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                }
            });                                   
      }
    );

    /*
     * Crea la relacion de querer ir al sitio "Desea"
     */            
    $("#quiere-ir").toggle(
      function() {      
                      
            $(this).addClass("active");
            $("#ha-estado").addClass("disabled");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'quiere-visitar',
                    sitio: id_url[1],
                    usuario: '62'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                }
            });                                   
        
      }, function() {   
          
            $(this).removeClass("active");            
            $("#ha-estado").addClass("disabled");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'elimina-intencion-visitar',
                    sitio: id_url[1],
                    usuario: '62'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                }
            });                                   
      }
    );


    /*
     * Da voto de confianza al sitio
     */
    $(".voto-up").toggle(
      function() {      
                      
            //$(".voto-down").addClass("disabled");
            $(".voto-down").css('display', 'none');
          
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'mas-votos',                   
                    sitio: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                            $(".total_votos").html(data);
                }
            });
        
      }, function() {   
          
            //$(".voto-down").removeClass("disabled");
            $(".voto-down").css('display', 'inline');
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'menos-votos',
                    sitio: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                            $(".total_votos").html(data);
                }
            });
      }
    );

    /*
     * Quita voto de confianza al sitio
     */
    $(".voto-down").toggle(
      function() {      
                                  
            //$(".voto-up").addClass("disabled");
            $(".voto-up").css('display', 'none');;
          
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'menos-votos',
                    sitio: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                            $(".total_votos").html(data);
                }
            });                                   
        
      }, function() {   
          
            //$(".voto-up").removeClass("disabled");
            $(".voto-up").css('display', 'inline');
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'mas-votos',                   
                    sitio: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                   
                            $(".total_votos").html(data);
                }
            });
      }
    );


    /*
     * Votos en el sitio
     */   
    $("a.voto_sitio").click(function(){
        
        //deja activa la estrella del voto
        var band="";
        for(var i=1;i<=5;i++){
            band="#voto"+i;
            
            if( i <= $(this).data("value") ){                
                $(band).addClass("ya_voto");                
                //$(band+" i").removeClass("icon-star-empty");
                //$(band+" i").addClass("icon-star");                
            }
            else{
                $(band).removeClass("ya_voto");                                
                //$(band+" i").removeClass("icon-star");
                //$(band+" i").addClass("icon-star-empty");
            }
        }             

        var mi_url=document.location.href;
        var id_url=mi_url.split("=");  

            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'voto_sitio',
                    sitio: id_url[1],
                    voto: $(this).data("value")
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            $(".total_votos").html(data);
                }                   
            });                                           
    });


    /*
     * Editar Imagenes del Slider
     */
    $("#edit_slider_sitio").click(function(){

            $("#EditarSlider").css({display:'inline'});   
            $("#slider_sitio").css({display:'none'});   

    });
    

    /*
     * Crea la experiencia del usuario
     */   
    $("#guardaSliderSitio").click(function(){            
            //alert("entro=???");
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");       
            
            var datosform = new FormData(document.getElementById('formImgSlider'));            
            datosform.append( "opcion", "guarda_slider_sitio");            
            datosform.append( "sitio", id_url[1] );

            $.ajax({
               url : '/natane3/estatico/php/opcionesSitio.php',
               type : 'POST',
               data:{
                    opcion: 'guarda_slider_sitio',
                    sitio: id_url[1],
                    voto: $(this).data("value")
               },
               processData : false, 
               contentType : false, 
               success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                
                            alert("Slider Modificado... :D");
                            $("#slider_sitio").css({display:'inline'});                            
                        }
                        else alert("No se han podido relizar los cambios"); 
                }
            });

    });
    
    
    /*
     * Cancelar edicion del slider
     */
    $(".cancelaEdicionSlider").click(function(){        
            $("#EditarSlider").css({display:'none'});   
            $("#slider_sitio").css({display:'inline'});             
    });     

});
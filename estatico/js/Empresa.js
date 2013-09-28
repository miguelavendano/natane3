$(document).ready(function(){

    /*
     * Registro de un nuevo Sitio
     */
    $("#guarda_empresa").click(function(){
        if($("#Rpass1E").val()==$("#Rpass2E").val()){  //valida contraseñas         
                    $.ajax({
                        url:'/natane3/estatico/php/opcionesEmpresa.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'registrarE',
                            nombre: $("#RnomE").val(),
                            nit: $("#RnitE").val(),
                            desc: $("#RdesE").val(),                            
                            city: $("#RcityE").val(),
                            dir: $("#RdirE").val(),
                            tel: $("#RtelE").val(),
                            mail: $("#RmailE").val(),
                            lat: $("#RlatE").val(),
                            lon: $("#RlonE").val(),                            
                            web: $("#RwebE").val(),
                            face: $("#RfaceE").val(),
                            twit: $("#RtwiE").val(),
                            you: $("#RyouE").val(),
                            contra1: $("#Rpass1E").val()
                        }
                        ,dataType:'html'
                        ,success: function(data,textStatus,jqXHR){                           

                            var n=data.split(" ");                           
                            
                            if(/true/.test(data)) {                                
                                alert("Registro Exitoso  :D"+n[0]);
                                document.location.href="http://localhost/natane3/modulos/empresas/empresa.php?id="+n[0];
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
    $("#BeditarE").click(function(){

            $("#editarEmpresa").css({display:'inline'});   
            //$(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            

            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'editarE',                            
                    empresa: id_url[1]                    
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
                    
                        $("#EnomE").val(data.nombre);
                        $("#EnitE").val(data.nit);
                        $("#EdescE").val(data.desc);
                        $("#EcityE").val(data.city);
                        $("#EtelE").val(data.tel);                
                        $("#EdirE").val(data.direc);
                        $("#EmailE").val(data.mail);                        
                        $("#ElatE").val(data.lat);
                        $("#ElongE").val(data.lon);
                        $("#Es_webE").val(data.s_web);
                        $("#EfaceE").val(data.face);
                        $("#EtwiE").val(data.twi);
                        $("#EyouE").val(data.you);
                        $("#Epass1E").val(data.pass);
                      
                }
            });            
    });


    /*
     * Guardar edicion de los datos del sitio
     */
    $("#guarda_edicion_empresa").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'guardar_edicionE',
                    empresa: id_url[1],
                    nombre: $("#EnomE").val(),
                    descri: $("#EdescE").val(),
                    nit: $("#EnitE").val(),
                    city: $("#EcityE").val(),                    
                    direc: $("#EdirE").val(),
                    tele: $("#EtelE").val(),                    
                    mail: $("#EmailE").val(),                    
                    lat: $("#ElatE").val(),                    
                    lon: $("#ElongE").val(),                    
                    s_web: $("#Es_webE").val(),
                    face: $("#EfaceE").val(),
                    twit: $("#EtwiE").val(),
                    youtube: $("#EyouE").val(),
                    pass: $("#Epass1E").val()
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

    /*
     * Cancelar edicion de los datos de la empresa
     */
    $(".cancelar_edicion_empresa").click(function(){        
             $("#editarEmpresa").css({display:'none'});                
    }); 
    
    /*
     * Cancelar creacion de una empresa
     */   
    $(".cancelarRegistroEmpresa").click(function(){        
             $("#registrarEmpresa").css({display:'none'});   
             $(".pestañas").css({display:'inline'});    //en perfi de usuario muestra las experiencias
    });    
    
    /*
     * Crea la relacion "Amigo" entre dos usuarios
     */   
    $("#SeguirE").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'relacion_amigo',                   
                    usuario: '2',
                    amigo: id_url[1]
                    //imagen: $("#Epass1").val(data.imagen),
                }
                ,dataType:'html'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                    
                            html="<i class='icon-leaf'></i> Seguiendo";
                            $("#SeguirE").html(html);                        
                            
                            //html2="<div {empresa}><p><a href='{url}?id={id}'><img src='{IMG_NATANE}/{imagen}'/>{nombre}</a></p></div>";
                            //$('.seguidores').html($('.seguidores').html()+html2);                           
                            
                            document.location.reload(); 
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                           

    });
    
    /*
     * Le da o le quita un punto de confianza a la empresa, crear su relacion con esa empresa
     */            
    $("#Bconfio").toggle(
      function() {      //le da un punto de confianza
          
            $(this).addClass("active");
            $("#Bconfio i").addClass("icon-ok");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'da_confianza',                   
                    empresa: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           

                        $("#puntos_confianza").html(data);    
                }
            });                                   
        
      }, function() {       //le quita el punto de confianza
          
            $(this).removeClass("active");            
            $("#Bconfio i").removeClass("icon-ok");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'quita_confianza',                   
                    empresa: id_url[1],
                    usuario: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                        
                        $("#puntos_confianza").html(data);    

                }
            });                                   
      }
    );

});


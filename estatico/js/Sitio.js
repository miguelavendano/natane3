$(document).ready(function(){

    /*
     * Registro de un nuevo Sitio
     */
    $("#registrarS").click(function(){
        if($("#Rpass1").val()==$("#Rpass2").val()){  //valida contraseñas         
                    $.ajax({
                        url:'/natane3/estatico/php/opcionesSitio.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'registrarS',
                            nombre: $("#RnomS").val(),
                            desc: $("#RdesS").val(),
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
                                alert("Registro Exitoso  :D");                                                                          
                                document.location.href="http://localhost/natane3/modulos/usuarios/usuario.php?id="+n[0];
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
            //$(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");

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
                        $("#ElatS").val(data.lat);
                        $("#ElongS").val(data.lon);
                        $("#Es_webS").val(data.s_web);
                        $("#EfaceS").val(data.face);
                        $("#EtwiS").val(data.twi);
                        $("#EyouS").val(data.you);
                        $("#Epass1S").val(data.pass);
                        //$("#Eimagen").val(data.imagen);                        
                        
                    /*
                        if(data.tipo=="Masculino"){                            
                            $("#EtipoS'].attr("checked",true);
                        }                            
                        else{
                             document.getElementById('EgeneroM').checked=false;
                             document.getElementById('EgeneroF').checked=true;                                                        
                        }   
                    */
                }
            });            
    });


    /*
     * Guardar edicion de los datos del sitio
     */
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
                    lat: $("#ElatS").val(),                    
                    lon: $("#ElongS").val(),
                    s_web: $("#Es_webS").val(),
                    face: $("#EfaceS").val(),
                    twit: $("#EtwiS").val(),
                    youtube: $("#EyouS").val(),
                    tsitio: $("input[name='EtipoS']:checked").val(),
                    pass: $("#Epass1S").val()
                    //imagen: $("#Epass1").val(data.imagen),
                }
                ,dataType:'JSON'
                ,beforeSend:function(jqXHR, settings ){
                    alert("Debe confirmar su identidad, para realizar los cambios.");                                        
                }
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
     * Cancelar edicion de los datos del usuario
     */

    $("#cancel_edicion_sitio").click(function(){
        
             $("#editarSitio").css({display:'none'});   
             //$(".pestañas").css({display:'inline'});                         
             
    });    
    

    /*
     * Crea la relacion "Amigo" entre dos usuarios
     */   
    $("#SeguirS").click(function(){

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
                            $("#SeguirU").html(html);                        
                            
                            //html2="<div {empresa}><p><a href='{url}?id={id}'><img src='{IMG_NATANE}/{imagen}'/>{nombre}</a></p></div>";
                            //$('.seguidores').html($('.seguidores').html()+html2);                           
                            
                            document.location.reload(); 
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                           

    });
    


});


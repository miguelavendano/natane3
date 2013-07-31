$(document).ready(function(){

    /*
     * Registro de un nuevo Usuario
     */
    $("#registrar").click(function(){
        if($("#Rpass1").val()==$("#Rpass2").val()){  //valida contraseñas         
                    $.ajax({
                        url:'/natane3/estatico/php/Insertadatos.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'registrar',                            
                            nombre: $("#Rnom").val(),
                            apellido: $("#Rape").val(),
                            mail: $("#Rmail").val(),
                            genero: $("input[name='Rgenero']:checked").val(),
                            nacimiento: $("#Rnaci").val(),
                            contra1: $("#Rpass1").val(),
                            contra2: $("#Rpass2").val()
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
     * Registro de una experiencia nueva
     */        
    $("#experiencia").click(function(){
        
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            
            
                $.ajax({
                    url:'/natane3/estatico/php/Insertadatos.php'
                    ,type:'POST'                    
                    ,data:{
                        opcion:'experiencia',                            
                        titulo: $("#Exptitulo").val(),
                        descripcion: $("#Expdesc").val(),
                        autor: id_url[1]
                    }
                    ,dataType:'html'
                    ,beforeSend:function(jqXHR, settings ){
                        //alert("Se esta creando su experiencia");
                    }
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Experiancia ingresada :D");                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su experiencia"); 
                    }
                });          
        });


    /*
     * Editar datos del Usuarios
     */
    $("#BeditarU").click(function(){
        
            $("#editar_perfil").css({display:'inline'});   
            $(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            

            $.ajax({
                url:'/natane3/estatico/php/Insertadatos.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'editarU',                            
                    autor: id_url[1]                    
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
                                                zIindex: '1040',
                                                background: '#000000',
                                                opacity:'0.4'
                                            });                  
                   
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    $("#reload").css({visibility: 'hidden'});   
                    $(".reload-backdrop").css({visibility: 'hidden'});                    
                    
                        $("#Enom").val(data.nombre);
                        $("#Eape").val(data.apellido);
                        $("#Email").val(data.mail);                        
                        $("#Enaci").val(data.f_nace);
                        $("#Epass1").val(data.pass);                
                        $("#Enick").val(data.nick);                        
                        $("#Ecity").val(data.city);
                        $("#Erecide").val(data.recide);
                        $("#Es_web").val(data.s_web);
                        $("#Eface").val(data.face);
                        $("#Etwi").val(data.twi);
                        $("#Eyou").val(data.you);
                        //$("#Eimagen").val(data.imagen);
                        
                        if(data.genero=="Masculino"){                            
                            $("#EgeneroM").attr("checked",true);                            
                            $("#EgeneroF").attr("checked",false);
                        }                            
                        else{
                             document.getElementById('EgeneroM').checked=false;
                             document.getElementById('EgeneroF').checked=true;                                                        
                        }                
                }
            });            
            
    });


    /*
     * Guardar edicion de los datos del usuario
     */
    $("#guarda_edicion").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/Insertadatos.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'guardar_edicionU',                   
                    usuario: id_url[1],
                    nombre: $("#Enom").val(),
                    apellido: $("#Eape").val(),
                    mail: $("#Email").val(),                    
                    f_nace: $("#Enaci").val(),
                    genero: $("input[name='Egenero']:checked").val(),
                    pass: $("#Epass1").val(),                
                    nick: $("#Enick").val(),                    
                    city: $("#Ecity").val(),
                    recide: $("#Erecide").val(),
                    s_web: $("#Es_web").val(),
                    face: $("#Eface").val(),
                    twit: $("#Etwi").val(),
                    youtube: $("#Eyou").val()                    
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

    $("#cancel_edicion").click(function(){
        
             $("#editar_perfil").css({display:'none'});   
             $(".pestañas").css({display:'inline'});                         
             
    });    
    

    /*
     * Crea la relacion "Amigo" entre dos usuarios
     */   
    $("#SeguirU").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/Insertadatos.php'
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
    

    /*
     * Valida el ingreso de un usuarios
     */   
    $("#loginU").click(function(){
        
        if($("#nickU").val().length > 1  || $("#claveU").val().length > 1){
                
            $.ajax({
                url:'/natane3/estatico/php/Insertadatos.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'login',
                    usuario: $("#nickU").val(),
                    clave: $("#claveU").val()
                }
                ,dataType:'html'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                                
                            alert("OK... usuario registrado... ")
                            //document.location.href="http://localhost/natane3/modulos/usuarios/usuario.php?id="+n[0];
                        }
                        else alert("Usuario no registrado");                                                     
                }
            });                           
        }//cierre if
        else{
            alert("no se pudo iniciar sesion, intente ingresando con su cuenta de facebook")
        }
          

    });
    

});


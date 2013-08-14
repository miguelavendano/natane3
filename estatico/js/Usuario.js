$(document).ready(function(){
      
    /*
     * Registro de un nuevo Usuario
     */
    $("#registrarU").click(function(){
        if($("#Rpass1").val()==$("#Rpass2").val()){  //valida contraseñas                            
                    $.ajax({
                        url:'/natane3/estatico/php/opcionesUsuario.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'registrarU',                            
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
                    url:'/natane3/estatico/php/opcionesUsuario.php'
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
        
            $("#editarUsuario").css({display:'inline'});   
            $(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
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
                                                zIindex: '99999',
                                                background: '#000000',
                                                opacity:'0.4'
                                            });                  
                   
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    $("#reload").css({visibility: 'hidden'});   
                    $(".reload-backdrop").css({visibility: 'hidden'});                    
                    
                        $("#EnomU").val(data.nombre);
                        $("#EapeU").val(data.apellido);
                        $("#EmailU").val(data.mail);                        
                        $("#EnaciU").val(data.f_nace);
                        $("#Epass1U").val(data.pass);                
                        $("#EnickU").val(data.nick);                        
                        $("#EcityU").val(data.city);
                        $("#ErecideU").val(data.recide);
                        $("#Es_webU").val(data.s_web);
                        $("#EfaceU").val(data.face);
                        $("#EtwiU").val(data.twi);
                        $("#EyouU").val(data.you);
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
    $("#guarda_edicion_usuario").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  

/*
            var dataform=new FormData(document.getElementById('formEditarUsuario'));            
            console.log(dataform);

            var form = $('#formEditarUsuario').serializeArray();
            console.log(form);*/
                 

            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data: {
                    opcion: 'guardar_edicionU',                   
                    usuario: id_url[1],         
                    nombre: $("#EnomU").val(),
                    apellido: $("#EapeU").val(),
                    mail: $("#EmailU").val(),                    
                    f_nace: $("#EnaciU").val(),
                    genero: $("input[name='EgeneroU']:checked").val(),                    
                    nick: $("#EnickU").val(),                    
                    city: $("#EcityU").val(),
                    recide: $("#ErecideU").val(),
                    s_web: $("#Es_webU").val(),
                    face: $("#EfaceU").val(),
                    twit: $("#EtwiU").val(),
                    youtube: $("#EyouU").val(),
                    imagen: $("#EfotoU").val(),
                    pass: $("#Epass1U").val()                    
                }
                ,dataType:'JSON'
                ,beforeSend:function(jqXHR, settings ){
                    alert("Debe confirmar su identidad, para realizar los cambios.");                                        
                }
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                                            
                            //document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                        
    });    


    /*
     * Cancelar edicion de los datos del usuario
     */
    $("#cancel_edicion_usuario").click(function(){        
             $("#editarUsuario").css({display:'none'});   
             $(".pestañas").css({display:'inline'});                                      
    });    


    /*
     * Editar datos del Usuarios
     */
    $("#BcomparteExp").click(function(){        
            $("#compartirExperiencia").css({display:'inline'});   
            $(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");
    });

    /*
     * Crea la relacion "Amigo" entre dos usuarios
     */   
    $("#creaExperiencia").click(function(){

        alert("crea");
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");       
            
            var dataform = new FormData(document.getElementById('formExperiencia'));            
            dataform.append( "opcion", "experiencia");            
            dataform.append( "autor", id_url[1] );
                        
            /*
            //document.getElementById('imagenes_experiencia').files.length;
            var imgs = document.getElementById('imagenes_experiencia').files;                
            console.log(imgs);                           
            */

                $.ajax({
                   url : '/natane3/estatico/php/opcionesUsuario.php',
                   type : 'POST',
                   data : dataform,
                   processData : false, 
                   contentType : false, 
                   success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Experiancia ingresada :D");                                                                          
                                //document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su experiencia"); 
                    }
                });
  
                      /*
                    ,data:{
                        opcion:'experiencia',                            
                        titulo: $("#Exptitulo").val(),
                        descripcion: $("#Expdesc").val(),
                        autor: id_url[1]
                    }*/
/*
 *
               $.ajax({
                    url:'/natane3/estatico/php/opcionesUsuario.php'
                    ,type:'POST'                    
                    ,data: datos

                    ,dataType:'html'
                    ,beforeSend:function(jqXHR, settings ){
                        //alert("Se esta creando su experiencia");
                    }
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Experiancia ingresada :D");                                                                          
                                //document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su experiencia"); 
                    }
                });   
                */

    });

    /*
     * Cancelar edicion de los datos del usuario
     */
    $("#cancelarExperiencia").click(function(){        
             $("#compartirExperiencia").css({display:'none'});   
             $(".pestañas").css({display:'inline'});                                      
    });    

    /*
     * Crea la relacion "Amigo" entre dos usuarios
     */   
    $("#SeguirU").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
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
                url:'/natane3/estatico/php/opcionesUsuario.php'
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


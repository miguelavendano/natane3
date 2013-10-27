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
     * Editar datos del Usuarios
     */
    $("#BeditarU").click(function(){
        
            $("#editarUsuario").css({display:'inline'});   
            $(".pestañas").css({display:'none'});     //oculta las experiencias si esta visible
            $("#registrarEmpresa").css({display:'none'});   //oculta el registro de Empresa si esta visible
            $("#registrarSitio").css({display:'none'});   //oculta el registro de Sitio si esta visible
            $("#compartirExperiencia").css({display:'none'});  //oculta el compartir experiencia

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
                    /*
                    $(".reload-backdrop").css({ position: 'fixed',
                                                top: '0',
                                                right: '0',
                                                bottom: '0',
                                                left: '0',
                                                zIindex: '99999',
                                                background: '#000000',
                                                opacity:'0.4'
                                            });                  
                   */
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    $("#reload").css({visibility: 'hidden'});   
                    //$(".reload-backdrop").css({visibility: 'hidden'});                    
                    
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
                        //$("#foto_perfil").val(data.imagen);
                        
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
        
            if($("#Epass1U").val()==$("#Epass2U").val()){  //valida contraseñas                                        
                
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
                        pass: $("#Epass1U").val()
                    }
                    ,dataType:'JSON'
                    ,beforeSend:function(jqXHR, settings ){
                        alert("Debe confirmar su identidad, para realizar los cambios.");                                        
                    }
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                                            
                                document.location.reload();                                     
                            }
                            else alert("No se han podido realizar los cambios");                                                     
                    }
                });                        
            }
            else{ alert("Las contraseñas no coinciden"); }                    
    });    

    /*
     * Cancelar edicion de los datos del usuario
     */
    $(".cancel_edicion_usuario").click(function(){        
             $("#editarUsuario").css({display:'none'});   
             $(".pestañas").css({display:'inline'});                                      
    });    
    
    /*
     * Guardar edicion de los datos del usuario
    
    $("#guarda_edicion_usuario").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");       

            if($("#Epass1U").val()==$("#Epass2U").val()){  //valida contraseñas                                        
                
                var dataform = new FormData(document.getElementById('formEditarUsuario'));            
                dataform.append( "opcion", "guardar_edicionU");            
                dataform.append( "usuario", id_url[1] );

                    $.ajax({
                       url : '/natane3/estatico/php/opcionesUsuario.php',
                       type : 'POST',
                       data : dataform,
                       processData : false, 
                       contentType : false, 
                       success: function(data,textStatus,jqXHR){                           

                                if(/true/.test(data)) {                                
                                    //alert("Datos cambiados :D");                                                                          
                                    document.location.reload();                                     
                                }
                                else alert("No se ha podido ingresar su experiencia"); 
                        }
                    });             
            }
            else{ alert("Las contraseñas no coinciden"); }                                
    });
*/

    /*
     * Muestra el boton de editar la foto de perfil
     */  
    $(".foto_perfil").mouseenter(function(){            
        $("#formImgPerfil").css({display:'inline'});    
    });
    
    /*
     * Oculta el boton de editar la foto de perfil
     */      
    $(".foto_perfil").mouseleave(function(){            
        $("#formImgPerfil").css({display:'none'});           
    }); 
    
    /*
     * Muestra la vista previa de la imagen
     */  
    $(".Bimg_perfil").click(function(){                     
            $(".edit_img_perfil").css({display:'inline'});  //muestra el boton que guarda la foto                                     
            $("#formImgPerfil").css({margin:'5px 20px 0 20px'});  //corre el boton de cargar la foto
            $(".edit_img_perfil").css({margin:'10px 0 0 175px'});  //muestra el boton que guarda la foto                                                             
    });     

    /*
     * Guarda la imagen de perfil seleccionada
     */   
    $(".edit_img_perfil").click(function(){

            $(".edit_img_perfil").css({display:'none'});  //oculta el boton que guarda la foto 
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");       

            var dataform = new FormData(document.getElementById('formImgPerfil'));            
            dataform.append( "opcion", "ediFotoPerfil");            
            dataform.append( "usuario", id_url[1] );

                $.ajax({
                   url : '/natane3/estatico/php/opcionesUsuario.php',
                   type : 'POST',
                   data : dataform,
                   processData : false, 
                   contentType : false, 
                   success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                //alert("Datos cambiados :D");                                                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su experiencia"); 
                    }
                });             
    });

    /*
     * Registro de una experiencia nueva
         
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
*/
    /*
     * Muestra la interfaz de compartir experiencia
     */
    $("#BcomparteExp").click(function(){        
            $("#compartirExperiencia").css({display:'inline'});   
            $(".pestañas").css({display:'none'});
            $("#registrarSitio").css({display:'none'});     //oculta el registro de Sitio si esta visible
            $("#registrarEmpresa").css({display:'none'});   //oculta el registro de Empresa si esta visible
            $("#editarUsuario").css({display:'none'});  //oculta la edicion del usuario si esta visible            
    });

    /*
     * Crea la experiencia del usuario
     */   
    $("#creaExperiencia").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");       
            
            var datosform = new FormData(document.getElementById('formComparteExperiencia'));            
            datosform.append( "opcion", "crea_experiencia");            
            datosform.append( "autor", id_url[1] );
            
            //$("#imagenes_experiencia").css({display: 'none'});                    
            /*
            //document.getElementById('imagenes_experiencia').files.length;
            var imgs = document.getElementById('imagenes_experiencia').files;                
            console.log(imgs);                           
            */
            
                $.ajax({
                   url : '/natane3/estatico/php/opcionesUsuario.php',
                   type : 'POST',
                   data : datosform,
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
    });

    /*
     * Cancelar creacino de una experiencia
     */
    $(".cancelarExperiencia").click(function(){        
            $("#compartirExperiencia").css({display:'none'});   
            $(".pestañas").css({display:'inline'});                                      
    });        
      
    /*
     * Guardar edicion de la experiencia
     */
    $("#guarda_edicionExp").click(function(){

            var id_exp=$(".info_exp").parent().attr('id');

            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data: {
                    opcion: 'guardar_edicionExp',                   
                    experiencia: id_exp,   
                    titulo: $("#ediExptitulo").val(),
                    descripcion: $("#ediExpdesc").val()
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                                            
                            //document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                        
    });    
    
    /*
     * Cancelar edicion de una experiencia
     */
    $(".cancelEdiExp").click(function(){        
             $("#editarExperiencia").css({display:'none'});   
             $(".pestañas").css({display:'inline'});                                      
    });  
   

    /*
     * Registro de un nuevo Sitio
     */
    $("#BUcreaS").click(function(){
        $("#registrarSitio").css({display:'inline'});   
        $(".pestañas").css({display:'none'});     //oculta las experiencias si esta visible
        $("#registrarEmpresa").css({display:'none'});   //oculta el registro de Empresa si esta visible
        $("#editarUsuario").css({display:'none'});  //oculta la edicion del usuario si esta visible
        $("#compartirExperiencia").css({display:'none'});  //oculta el compartir experiencia        
    });     
    
    /*
     * Registro de una nuevo Empresa
     */
    $("#BUcreaE").click(function(){
        $("#registrarEmpresa").css({display:'inline'});   
        $(".pestañas").css({display:'none'});     //oculta las experiencias si esta visible
        $("#registrarSitio").css({display:'none'});   //oculta el registro de Sitio si esta visible
        $("#editarUsuario").css({display:'none'});  //oculta la edicion del usuario si esta visible
        $("#compartirExperiencia").css({display:'none'});  //oculta el compartir experiencia        
    });
    
    /*
     * Cerrar sesion de Usuario
     */
    $("#BExit").click(function(){        
        document.location.href="http://localhost/natane3/Index/";
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
    
    
    /*
     * Le da o le quita un punto de confianza a la empresa, crear su relacion con esa empresa
     */            
    $("#SeguirU").toggle(
      function() {      //le da un punto de confianza
          
            $(this).addClass("active");
            $("#SeguirU i").addClass("icon-ok");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'seguir',                   
                    a_seguir: id_url[1],
                    seguidor: '279'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                                
                            
                            var html="<i class='icon-ok'></i> Siguiendo";
                            $("#SeguirU").html(html);  
                        }
                        else alert("Se presento un error");                                                     
                        //$("#puntos_confianza").html(data);    
                }
            });                                   
        
      }, function() {       //le quita el punto de confianza
          
            $(this).removeClass("active");            
            //$("#SeguirU i").removeClass("icon-ok");
            
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'no_seguir',                   
                    a_seguir: id_url[1],
                    seguidor: '61'
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
     
                        if(/true/.test(data)) {           
                            
                            $("#SeguirU").html("Seguir");                        
                            
                        }
                        else alert("Se presento un error");                                                     
     
                        //$("#puntos_confianza").html(data);    

                }
            });                                   
      }
    );    
    
});


    function editarExperiencia(id_experiencia) {
    
            $("#editarExperiencia").css({display:'inline'});   
            $(".pestañas").css({display:'none'});

            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'editarExp',                            
                    experiencia: id_experiencia                    
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
                    /*
                    $(".reload-backdrop").css({ position: 'fixed',
                                                top: '0',
                                                right: '0',
                                                bottom: '0',
                                                left: '0',
                                                zIindex: '99999',
                                                background: '#000000',
                                                opacity:'0.4'
                                            });                  
                   */
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    $("#reload").css({visibility: 'hidden'});   
                    //$(".reload-backdrop").css({visibility: 'hidden'});                                     
                   
                    $("#ediExptitulo").val(data.nombre);
                    $("#ediExpdesc").val(data.descripcion);
                    //$("#Eimagen").val(data.imagen);                        
                }
            });                                
    
    }


    function eliminarExperiencia(id_experiencia) {
        
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesUsuario.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'eliminarExp',                            
                    experiencia: id_experiencia,
                    usuario: id_url[1]
                }
                ,dataType:'JSON'
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
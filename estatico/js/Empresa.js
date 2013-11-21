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
            $("#campoConfio").css({display:'none'});
            $("#slider_empresa").css({display:'none'});
            $("#contenidoE").css({display:'none'});
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
     * Guardar edicion de los datos de la empresa
     
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
        */

    /*
     * Cancelar edicion de los datos de la empresa
     */
    $(".cancelar_edicion_empresa").click(function(){        
             $("#editarEmpresa").css({display:'none'});                
             $("#slider_empresa").css({display:'inline'});
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
        
        
    /*
     * Guardar edicion de la experiencia
     */
    $("#guarda_edicionExpEmpresa").click(function(){

            var id_exp=$("#formEditarExperienciaEmpresa").parent().attr('id'); //obtengo el id de la experiencia
            var mi_url=document.location.href;
            var id_url=mi_url.split("="); 
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data: {
                    opcion: 'guardar_edicionExpEmp',                   
                    experiencia: id_exp,   
                    titulo: $("#ediExpEmTitulo").val(),
                    descripcion: $("#ediExpEmDesc").val()
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
            $(".editarExperienciaEmpresa").css({display:'none'});                
            $("#experiencias_empresa").css({display:'inline'});
    });  
   
   
    /*
     * Muestra el formulario para crear un servicio
     */
    $("#BcrearServi").click(function(){        
             $("#crearServicio").css({display:'inline'});                
             $("#slider_empresa").css({display:'none'});
    });      


    /*
     * Guarda el servicio creado
     */
    $("#guardarServicio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  

            var datosform = new FormData(document.getElementById('formCrearServicio'));            
            datosform.append( "opcion", "creaServicio");            
            datosform.append( "empresa", id_url[1] );
                        
                $.ajax({
                   url:'/natane3/estatico/php/opcionesEmpresa.php',
                   type : 'POST',
                   data : datosform,
                   processData : false, 
                   contentType : false, 
                   success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Servicio creado :D");                                                                          
                                document.location.reload();                                     
                            }
                            else alert("No se ha podido ingresar su servicio"); 
                    }
                });                
    });    
     

    /*
     * Cancelar creacion de un servicio
     */
    $(".cancelarServicio").click(function(){        
             $("#crearServicio").css({display:'none'});                
             $("#slider_empresa").css({display:'inline'});
    }); 


    /*
     * Guardar edicion del servicio
     */
    $("#guardaEdicionServicio").click(function(){

            //var id_exp=$(".info_exp").parent().attr('id'); //obtengo el id de la experiencia
            var id_servicio=$("#formEditarServicio").parent().parent().attr('id'); //obtengo el id de la experiencia
          
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data: {
                    opcion: 'guardaEdicionServicio',                   
                    servicio: id_servicio,   
                    nombre: $("#EditNomSer").val(),
                    descripcion: $("#EditDescSer").val()
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                                            
                            document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });
    });


    /*
     * Cancelar edicion de un servicio
     */
    $(".cancelarEdicionServicio").click(function(){        
             $("#editarServicio").css({display:'none'});                
             $("#servicios_empresa").css({display:'inline'});
    });  
        
});


    function editaExperienciaEmpresa(id_experiencia) {
    
            //$(".pestañas").css({display:'none'});
            $("#experiencias_empresa").css({display:'none'});            
            $(".editarExperienciaEmpresa").css({display:'inline'});            
            $(".editarExperienciaEmpresa").attr('id', id_experiencia);            

            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'
                ,data:{
                    opcion:'editaExpEmp',                            
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
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    
                    $("#reload").css({visibility: 'hidden'});                       
                    alert(data.nombre+"_"+data.descripcion);
                    $("#ediExpEmTitulo").val(data.nombre);
                    $("#ediExpEmDesc").val(data.descripcion);
                    /*
                    var marco="";
                    var edicion="";                    
                    var img="";
                    var todo="";
                    var lis_img="";

                    for(var i=0; i<data.imagenes.length; i++){
                        marco="<div id="+data.imagenes[i].img_id+"_"+id_experiencia+" class='span3 marco_img_exp'>";
                        edicion="<div class='btn-block opc_img'>\n\
                                    <button class='btn icon-trash tooltip1' rel='tooltip' title='Eliminar' onclick='eliminarImgExperiencia("+id_experiencia+","+data.imagenes[i].img_id+")'></button>\n\
                                </div>";
                        
                        img="<div class='im_exp_edit'><img src='/natane3/estatico/imagenes/"+data.imagenes[i].img_nombre+"' /></div>";
                        
                        todo=marco+edicion+img+"</div>";
                        lis_img=lis_img+todo;
                        //lis_img=lis_img+"<div id="+data.imagenes[i].img_id+" class='span3 im_exp_edit'><img src='/natane3/estatico/imagenes/"+data.imagenes[i].img_nombre+"' /></div>";
                    }
                    
                    $("#imgs_experiencia").html(lis_img);                    */
                }
            });                                    
    }
    

    function eliminaExperienciaEmpresa(id_experiencia) {
     
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'eliminaExpEmp',                            
                    experiencia: id_experiencia,
                    empresa: id_url[1]
                }
                ,dataType:'JSON'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                            if(/true/.test(data)) {                                
                                alert("Experiancia Eliminada :D");                                                                          
                                document.location.reload();                                                                     
                               /* if(/experiencia/.test(data)) {
                                    alert("Experiancia Eliminada :D");                                                                          
                                    document.location.reload();                                     
                                }
                                else if(/etiqueta/.test(data)) {
                                    alert("Etiqueta Eliminada :D");
                                    document.location.reload();                                     
                                }*/                                                                                                
                            }
                            else alert("No se ha podido eliminar su experiencia"); 
                }
            });                            
    }
    

    function editarServicio(id_servicio) {
            
            $(".modalEditaServicio").attr('id', id_servicio);            
            //$("#servicios_empresa").css({display:'none'});
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'
                ,data:{
                    opcion:'editarServicio',                            
                    servicio: id_servicio                    
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
                    $("#EditNomSer").val(data.nombre);
                    $("#EditDescSer").val(data.descripcion);
                }
            });                                    
    }
    

    function eliminarServicio(id_servicio) {
     
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'eliminarServicio',                            
                    servicio: id_servicio,
                    empresa: id_url[1]
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
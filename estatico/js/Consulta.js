$(document).ready(function(){
      
    /*
     * Realiza la busqueda
    
    $("#BBuscar").click(function(){        
        if($("#loBusca").val().length >= 1){                
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busqueda', 
                    consulta: $("#loBusca").val()                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                        if(/true/.test(data)) {                                               
                            
                            //document.location.href="http://localhost/natane3/modulos/usuarios/usuario.php?id="+n[0];
                        }
                        else alert("Consulta no hecha");                                                     
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });  
        */

    /*
     * Consulta Todos los elementos
     */
    $(".BuscaTodo").click(function(){        
        if($("#loBusca").val().length >= 1){        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_todo', 
                    consulta: $("#loBusca").val()                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);                                
                }
            });      
        }else{
            alert("No hay datos para relizar una busqueda")
        }
    });      


    /*
     * Consulta Usuarios
     */
    $("#BuscaAventurero").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_usuario', 
                    consulta: $("#loBusca").val()                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);                                
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }                        
    });      


    /*
     * Consulta Sitios
     */
    $("#BuscaSitio").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: ""
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      
    

    /*
     * Consulta Empresas
     */
    $("#BuscaEmpresa").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_empresa', 
                    consulta: $("#loBusca").val()
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      
            
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaHoteles").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-suitcase"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaRestaurante").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-food"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      

    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaRecreacion").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-flag"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaCaminata").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-road"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    });      
   
   
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaDisco").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-music"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    }); 
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaBar").click(function(){        
        if($("#loBusca").val().length >= 1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: $("#loBusca").val(),
                    filtro: "icon-glass"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
        }else{
            alert("No hay datos para relizar una busqueda")
        }            
    }); 

});
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
    $(".BarraBuscaTodo").click(function(){        
        
        if($("#loBusca").val().length >= 1){             

            document.location.href="http://localhost/natane3/modulos/consultas/consulta.php?b="+$("#loBusca").val();            
            
        }else{
            alert("No hay datos para relizar una busqueda")
        }        
    });      

    /*
     * Consulta Todos los elementos
     */
    $("#BuscaTodo").click(function(){      
        
        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";

        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }

            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_todo', 
                    consulta: query                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                                                                                  
                            $("#contenido_respuesta").html(data);                                
                }
            });  
            
    });      


    /*
     * Consulta Usuarios
     */
    $("#BuscaAventurero").click(function(){   
        
        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_usuario', 
                    consulta: query
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);                                
                }
            });                                   
        
    });      


    /*
     * Consulta Sitios
     */
    $("#BuscaSitio").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: ""
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
            
    });      
    

    /*
     * Consulta Empresas
     */
    $("#BuscaEmpresa").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_empresa', 
                    consulta: query
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    });      
            
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaHoteles").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-suitcase"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    });      
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaRestaurante").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-food"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    });      

    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaRecreacion").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-flag"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    });      
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaCaminata").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-road"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    });      
   
   
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaDisco").click(function(){        

        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-music"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   
      
    }); 
    
    /*
     * Consulta Filtro Hoteles
     */
    $("#BuscaBar").click(function(){        
        
        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";
        
        if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
        } else if(busqueda[1]){
            query = busqueda[1];
        } else{
            alert("No hay datos para relizar una busqueda")                        
        }
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
                    consulta: query,
                    filtro: "icon-glass"                    
                }
                ,dataType:'html'
                ,success: function(data,textStatus,jqXHR){                           
                            
                            $("#contenido_respuesta").html(data);    
                }
            });                                   

    }); 

});
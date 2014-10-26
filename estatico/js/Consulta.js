$(document).ready(function(){
      
    function ejecutaBusqueda(){
        
        if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            //exit();
        }else{
            location.href="/natane3/modulos/consultas/consulta.php?busqueda="+$("#loBusca").val();
        }                
    }
    
    
    $('#loBusca').keypress(function (e) {
        var key = e.which;
        if(key == 13){  // the enter key code
            ejecutaBusqueda();            
            return false;  
        }
        
    });     
     
     
    /*
     * Consulta Todos los elementos
     */
    $(".BarraBuscaTodo").click(function(){        
        ejecutaBusqueda();        
    });      

    /*
     * Consulta Todos los elementos
     */
    $("#BuscaTodo").click(function(){      
        
        var mi_url=document.location.href;
        var busqueda=mi_url.split("=");         
        var query="";

        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                            
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


        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                            
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
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
        
        if(busqueda[1]){
            query = busqueda[1];
        }
        else if( $("#loBusca").val().length == 0 || /^\s+$/.test($("#loBusca").val()) ){
            alert("No hay datos para relizar una busqueda");
            exit();
        }
        else if($("#loBusca").val().length >= 1){
            query = $("#loBusca").val();
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
                            $("#loBusca").val(busqueda[1]);                              
                }
            });                                   

    }); 

});
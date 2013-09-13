$(document).ready(function(){
      
    /*
     * Cerrar sesion de Usuario
     */
    $("#BBuscar").click(function(){        
        //alert($("#loBusca").val());
        //document.location.href="http://localhost/natane3/modulos/consultas/consulta.php";
        
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
    });  


    /*
     * Consulta Usuarios
     */
    $(".BuscaTodo").click(function(){        
        if($("#loBusca").val().length>1){        
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
        if($("#loBusca").val().length>1){
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
        if($("#loBusca").val().length>1){
            $.ajax({
                url:'/natane3/estatico/php/opcionesConsulta.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'busca_sitio', 
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
    
});
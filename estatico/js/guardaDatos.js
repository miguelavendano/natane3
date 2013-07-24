$(document).ready(function(){
    
    $("#Busqueda").click(function(){
                    $.ajax({
                        url:'/natane3/estatico/php/Insertadatos.php'
                        ,type:'POST'                    
                        ,data:{
                            opcion:'busca',
                            busca:$("#LoBusca").val()
                        }
                        ,dataType:'html'
                        ,beforeSend:function(jqXHR, settings ){
                            alert("va a buscar");
                            
                        }
                        ,success: function(data,textStatus,jqXHR){
                           
                            alert(data);
                            alert("ENtro al ajax");
                            //document.location.href="http://localhost/natane3/modulos/consultas/consulta.php";   
                        }
                    });          
           });    
   

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
                            alert("Se esta creando su perfil");
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
                        alert("Se esta creando su experiencia");
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
                    alert("cargando...");
                }
                ,success: function(data,textStatus,jqXHR){                           
                
                $("#Enom").val("nombre");
                /*
                "apellido"
                "imagen"
                "nick"
                "genero"
                "f_nace"
                "city"
                "recide"
                "mail"
                "s_web"
                "face"
                "twi"
                "you"
                "pass"
                
                }
            });            
            
 /*
    -moz-transition-duration: 1s;
    -webkit-transition-duration: 1s;
    -o-transition-duration: 1s;
    transition-duration: 1s;
    */
    });
    

    $("#cancel_edicion").click(function(){
        
             $("#editar_perfil").css({display:'none'});   
             $(".pestañas").css({display:'inline'});
            
    });    
    
            
        

});


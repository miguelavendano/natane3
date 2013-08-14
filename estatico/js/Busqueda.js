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
        

});


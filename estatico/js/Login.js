$(document).ready(function(){

    /*
     * Validar inicio de sesion 
     */
    $("#validaLogin").click(function(){
        
            $.ajax({
                url:'/natane3/modulos/login/loginControl.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'login',                            
                    email: $("#Rnom").val(),
                    clave: $("#Rape").val()
                }
                ,dataType:'html'
                ,beforeSend:function(jqXHR, settings ){
                    //alert("Se esta creando su perfil");
                }
                ,success: function(data,textStatus,jqXHR){                           

                    if(data=="true"){
                        document.location.href="/natane3/modulos/usuarios/usuario.php?id=".$_SESSION['id'];
                    }
                    else if(data=="false"){
                        alertaSimple("Error!","Los datos ingresados no son correctos","error");    
                    }

                }
            });     
    });

});
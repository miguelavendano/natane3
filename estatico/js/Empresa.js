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
                        ,beforeSend:function(jqXHR, settings ){
                            //alert("Se esta creando su perfil");
                        }
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
            //$(".pestañas").css({display:'none'});
            //$("#Enom").val("julian");

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");            

            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
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
                        //$("#Eimagen").val(data.imagen);                        
                      
                }
            });            
    });


    /*
     * Guardar edicion de los datos del sitio
     */
    $("#guarda_edicion_empresa").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'guardar_edicionE',
                    sitio: id_url[1],
                    nombre: $("#EnomE").val(),
                    descri: $("#EdescE").val(),
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
                    //imagen: $("#Epass1").val(data.imagen),
                }
                ,dataType:'JSON'
                ,beforeSend:function(jqXHR, settings ){
                    alert("Debe confirmar su identidad, para realizar los cambios.");                                        
                }
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                
                            alert("Cambios guardados.");
                            document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                        
    });    

    /*
     * Cancelar edicion de los datos de la empresa
     */
    $("#cancelarEdicionEmpresa").click(function(){        
             $("#editarEmpresa").css({display:'none'});                
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
    $("#Bconfio").click(function(){
            $("#Bconfio").css({display:'none'});                
            var boton_confia='<button id="Byanoconfio" class="btn btn-red-wine active btn-block"><i class="icon-thumbs-up"></i> Confio en esta empresa</button>';
            document.getElementById('confio').innerHTML = boton_confia;
    });   
    
    $("#Byanoconfio").click(function(){
            var boton_ya_no='<button id="Bconfio" class="btn btn-red-wine btn-block">Confio en esta empresa</button>';
            document.getElementById('confio').innerHTML = boton_ya_no;            
    });   
*/
});


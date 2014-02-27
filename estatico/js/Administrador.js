/*
 * Funcion que muestra la estadistica de Usuarios, Empresas y Sitios registrados 
 */
    function estadisticaNodos(){

            $.ajax({
                    url:'/natane3/estatico/php/opcionesAdministrador.php'
                    ,type:'POST'
                    ,data:{ 
                        opcion:'EstadisticasNodos'
                    }
                    ,dataType:'json'
                    ,beforeSend:function(jqXHR,settings){
                                    
                    }    
                    ,error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Se presentó un problema con la conexión a Internet")
                    }                    
                    ,success: function(data,textStatus,jqXHR){                
        
                                $("#convenciones").html(data.opciones);
                                $("#titulo-encuesta").html(data.titulo);
                                
                                var vector = [parseInt(data.usuarios), parseInt(data.sitios), parseInt(data.empresas), parseInt(data.experiencias), parseInt(data.servicios), parseInt(data.imagenes), parseInt(data.comentarios), parseInt(data.noticias), parseInt(data.eventos)];
                                var contenedor="estadisticasNodos";   //id div contenedor
                                var etiquetas = ['Usuarios', 'Sitios', 'Empresas', 'Experiencias', 'Servicios', 'Imagenes', 'Comentarios', 'Noticias', 'Eventos'];        
                                //var titulo = data.titulo;
                              

                                var grafica = new Highcharts.Chart({
                                            chart: {
                                                renderTo: contenedor,
                                                type: 'column'
                                            },
                                            title: {
                                                text: "Cantidad de nodos segun el tipo",
                                                style: {
                                                    color: '#000000',
                                                    fontSize: '16px',
                                                    fontWeight: 'bold'                                                    
                                                }                             
                                            },
                                            colors: [
                                                '#00ACEE', 
                                                '#28CC28', 
                                                '#FF0022'
                                            ],
                                            xAxis: {
                                                categories: etiquetas,
                                                title: {
                                                    text: 'Tipos de nodos'
                                                }
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: '',
                                                    align: 'high'
                                                },
                                                labels: {
                                                    overflow: 'justify'
                                                }
                                            },
//                                            tooltip: {
//                                                valueSuffix: ' millions'
//                                            },
                                            plotOptions: {
                                                column: {
                                                    dataLabels: {
                                                        //rotation: -90,
                                                        //x: 2,
                                                        //y: 25,
                                                        enabled: true,
                                                        style: {
                                                            color: '#000000',
                                                            fontSize: '12px',
                                                            fontFamily: 'Verdana, sans-serif',
                                                            fontWeight: 'bold'                                                            
                                                        }                             
                                                        //rotation: -90
                                                    } 
                                                }
                                            },
                                            legend: {
                                                layout: 'vertical',
                                                align: 'right',
                                                verticalAlign: 'top',
                                                x: -40,
                                                y: 100,
                                                floating: true,
                                                borderWidth: 1,
                                                backgroundColor: '#FFFFFF',
                                                shadow: false,
                                                enabled: false
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Nodos',
                                                data: vector,
                                                colorByPoint: true
                                            }]                                        
                                        });                                                                 
                            }
                    });                          
                    
    }
/*
 * Funcion que muestra la estadistica de Usuarios, Empresas y Sitios registrados 
 */
    function estadisticaRelaciones(){

            $.ajax({
                    url:'/natane3/estatico/php/opcionesAdministrador.php'
                    ,type:'POST'
                    ,data:{ 
                        opcion:'EstadisticasRelaciones'
                    }
                    ,dataType:'json'
                    ,beforeSend:function(jqXHR,settings){
                                    
                    }    
                    ,error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Se presentó un problema con la conexión a Internet")
                    }                    
                    ,success: function(data,textStatus,jqXHR){                
        
                                $("#convenciones").html(data.opciones);
                                $("#titulo-encuesta").html(data.titulo);
                                
                                var vector = [parseInt(data.informa),parseInt(data.amigos), parseInt(data.comparte),parseInt(data.publica),parseInt(data.crea)];
                                var contenedor="estadisticasRelaciones";   //id div contenedor
                                var etiquetas = ['Informa','Amigo', 'Comparte', 'Publica','Crea'];        
                                //var titulo = data.titulo;
                              

                                var grafica = new Highcharts.Chart({
                                            chart: {
                                                renderTo: contenedor,
                                                type: 'column'
                                            },
                                            title: {
                                                text: "Cantidad de relaciones segun el tipo",
                                                style: {
                                                    color: '#000000',
                                                    fontSize: '16px',
                                                    fontWeight: 'bold'                                                    
                                                }                             
                                            },
                                            colors: [
                                                '#00ACEE', 
                                                '#28CC28', 
                                                '#FF0022'
                                            ],
                                            xAxis: {
                                                categories: etiquetas,
                                                title: {
                                                    text: 'Tipos de relaciones'
                                                }
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: '',
                                                    align: 'high'
                                                },
                                                labels: {
                                                    overflow: 'justify'
                                                }
                                            },
//                                            tooltip: {
//                                                valueSuffix: ' millions'
//                                            },
                                            plotOptions: {
                                                column: {
                                                    dataLabels: {
                                                        //rotation: -90,
                                                        //x: 2,
                                                        //y: 25,
                                                        enabled: true,
                                                        style: {
                                                            color: '#000000',
                                                            fontSize: '12px',
                                                            fontFamily: 'Verdana, sans-serif',
                                                            fontWeight: 'bold'                                                            
                                                        }                             
                                                        //rotation: -90
                                                    } 
                                                }
                                            },
                                            legend: {
                                                layout: 'vertical',
                                                align: 'right',
                                                verticalAlign: 'top',
                                                x: -40,
                                                y: 100,
                                                floating: true,
                                                borderWidth: 1,
                                                backgroundColor: '#FFFFFF',
                                                shadow: false,
                                                enabled: false
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Relaciones',
                                                data: vector,
                                                colorByPoint: true
                                            }]                                        
                                        });                                                                 
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
                ,dataType:'json'
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
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                            if(/true/.test(data)) {                                
                                alert("Servicio Eliminada :D");                                                                          
                                document.location.reload(); 
                            }
                            else alert("No se ha podido eliminar su experiencia"); 
                }
            });                            
    }   


$(document).ready(function(){
        
    estadisticaNodos();
    estadisticaRelaciones();
    
    $("#guarda_empresa").click(function(){
        
            var dataform = new FormData(document.getElementById('fromCreaEmpresa'));            
            dataform.append( "opcion", "registrarE");            

            $.ajax({
                url : '/natane3/estatico/php/opcionesEmpresa.php',
                type : 'POST',
                data : dataform,
                processData : false, 
                contentType : false, 
                success: function(data,textStatus,jqXHR){                           

                    var n=data.split(" ");                           

                    if(/true/.test(data)) {                                
                        alert("Registro Exitoso  :D"+n[0]);
                        //document.location.href="http://localhost/natane3/modulos/empresas/empresa.php?id="+n[0];
                    }
                    else alert("No se ha podido realizar su registro"); 

                }
            });                     
            
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
                        lat_lon: mapa.getPosicion(),
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
     * Guardar edicion del servicio
     */
    $("#guardaEdicionServicio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            var id_servicio=$("#formEditarServicio").parent().parent().attr('id'); //obtengo el id de la experiencia

            var datosform = new FormData(document.getElementById('formEditarServicio'));            
            datosform.append( "opcion", "guardaEdicionServicio");            
            datosform.append( "servicio", id_servicio );
            datosform.append( "empresa", id_url[1] );            
                        
            $.ajax({
               url:'/natane3/estatico/php/opcionesEmpresa.php',
               type : 'POST',
               data : datosform,
               processData : false, 
               contentType : false, 
               success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                
                            alert("Servicio editado :D");                                                                          
                            document.location.reload();                                     
                        }
                        else alert("No se ha podido editar su servicio"); 
                }
            });                  
    });



});
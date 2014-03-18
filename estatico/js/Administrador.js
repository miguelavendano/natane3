/*
 * Funcion que muestra la grafica estadistica de nodos existentes
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
                                
                                var vector = [parseInt(data.usuarios), parseInt(data.sitios), parseInt(data.empresas), parseInt(data.experiencias), parseInt(data.servicios), parseInt(data.imagenes), parseInt(data.comentarios), parseInt(data.noticias), parseInt(data.eventos)];
                                var contenedor="estadisticasNodos";   //id div contenedor
                                var etiquetas = ['Usuarios', 'Sitios', 'Empresas', 'Experiencias', 'Servicios', 'Imagenes', 'Comentarios', 'Noticias', 'Eventos'];        

                                var total = parseInt(data.usuarios)+parseInt(data.sitios)+parseInt(data.empresas)+parseInt(data.experiencias)+parseInt(data.servicios)+parseInt(data.imagenes)+parseInt(data.comentarios)+parseInt(data.noticias)+parseInt(data.eventos);
                                $("#conclusion-nodos").html("EL total de nodos consultados fue: <span>" +total+"</span>");
                                
                                $("#Tusu").html(data.usuarios);
                                $("#Tsiti").html(data.sitios);
                                $("#Temp").html(data.empresas);
                                $("#Texp").html(data.experiencias);
                                $("#Tser").html(data.servicios);
                                $("#Tima").html(data.imagenes);
                                $("#Tcome").html(data.comentarios);
                                $("#Tnodos").html(total);

                                var grafica = new Highcharts.Chart({
                                            chart: {
                                                renderTo: contenedor,
                                                type: 'column'
                                            },
                                            title: {
                                                text: "",
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
 * Funcion que muestra la grafica estadistica de relaciones existentes
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
        
                                
                                var vector = [parseInt(data.informa),parseInt(data.amigos), parseInt(data.comparte),parseInt(data.publica),parseInt(data.crea)];
                                var contenedor="estadisticasRelaciones";   //id div contenedor
                                var etiquetas = ['Informa','Amigo', 'Comparte', 'Publica','Crea'];        

                                var total = parseInt(data.informa)+parseInt(data.amigos)+parseInt(data.comparte)+parseInt(data.publica)+parseInt(data.crea);
                                $("#conclusion-relaciones").html("EL total de relaciones consultados fue: <span>" +total+"</span>");


                                var grafica = new Highcharts.Chart({
                                            chart: {
                                                renderTo: contenedor,
                                                type: 'column'
                                            },
                                            title: {
                                                text: "",
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
    
    
    function editarPublicacion(id_publicacion, tipo) {
            
            if(tipo=="Noticia"){
                $(".modalEditaNoticia").attr('id', id_publicacion);        
            }else if(tipo=="Evento"){
                $(".modalEditaEvento").attr('id', id_publicacion);        
            }
                        
            $.ajax({
                url:'/natane3/estatico/php/opcionesAdministrador.php'
                ,type:'POST'
                ,data:{
                    opcion:'datosEdicionPublicacion',                            
                    publicacion: id_publicacion,
                    tipo: tipo
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
                    
                    if(data.tipo=='Noticia'){
                        
                        $("#EnomNoti").val(data.nombre);
                        $("#EdescNoti").val(data.descripcion);
                    
                    }else if(data.tipo=='Evento'){
                        
                        $("#EnomEve").val(data.nombre);
                        $("#EdescEve").val(data.descripcion);                        
                        $("#EfechaEve").val(data.fecha);                        
                        $("#EhoraEve").val(data.hora);                        
                    }    
                }
            });              
            
    }
    


    function eliminarPublicacion(id_publicacion) {
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesAdministrador.php'
                ,type:'POST'                    
                ,data:{
                    opcion:'eliminaPublicacion',                            
                    publicacion: id_publicacion
                }
                ,dataType:'html'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                            if(/true/.test(data)) {                                
                                alert("Publicacion Eliminada :D");                                                                          
                                location.reload();
                            }
                            else alert("No se ha podido eliminar su publicación"); 
                }
            });                            
    }   


$(document).ready(function(){
        
    estadisticaNodos();
    estadisticaRelaciones();
    
    /*
     * Guarda la Noticia ingresada
     */    
    $("#guardarNoticia").click(function(){
        
            var dataform = new FormData(document.getElementById('formCrearNoticia'));            
            dataform.append( "opcion", "creaNoticia");            

            $.ajax({
                url : '/natane3/estatico/php/opcionesAdministrador.php',
                type : 'POST',
                data : dataform,
                processData : false, 
                contentType : false, 
                success: function(data,textStatus,jqXHR){                           

                    if(/true/.test(data)) {                                
                        alert("Noticia Publicada  :D");
                        location.reload();
                    }
                    else alert("No se ha podido publicar la noticia"); 

                }
            });                                 
    });
      
    /*
     * Guarda el Evento ingresado
     */        
    $("#guardarEvento").click(function(){
        
            var dataform = new FormData(document.getElementById('formCrearEvento'));            
            dataform.append( "opcion", "creaEvento");            

            $.ajax({
                url : '/natane3/estatico/php/opcionesAdministrador.php',
                type : 'POST',
                data : dataform,
                processData : false, 
                contentType : false, 
                success: function(data,textStatus,jqXHR){                           

                    if(/true/.test(data)) {                                
                        alert("Evento Publicado  :D");
                        location.reload();
                    }
                    else alert("No se ha podido publicar el evento"); 

                }
            });         
    });        

    /*
     * Guardar la edicion de la noticia
     */
    $("#editarNoticia").click(function(){
        
            var id_noticia = $("#formEditarNoticia").parent().parent().attr('id'); //obtengo el id del evento
            
            var datosform = new FormData(document.getElementById('formEditarNoticia'));            
            datosform.append( "opcion", "guardaEdicionPublicacion");            
            datosform.append( "tipo", "Noticia");            
            datosform.append( "publicacion", id_noticia );            

            $.ajax({
                url : '/natane3/estatico/php/opcionesAdministrador.php',
                type : 'POST',
                data : datosform,
                processData : false, 
                contentType : false, 
                success: function(data,textStatus,jqXHR){                           

                    if(/true/.test(data)) {                                
                        alert("Noticia Editado  :D");
                        location.reload();
                    }
                    else alert("No se ha podido editar la noticia"); 

                }
            });                                 
    });    
    
    /*
     * Guardar la edicion del evento
     */   
    $("#editarEvento").click(function(){
        
            var id_evento = $("#formEditarEvento").parent().parent().attr('id'); //obtengo el id del evento
            
            var datosform = new FormData(document.getElementById('formEditarEvento'));            
            datosform.append( "opcion", "guardaEdicionPublicacion");            
            datosform.append( "tipo", "Evento");            
            datosform.append( "publicacion", id_evento );

            $.ajax({
                url : '/natane3/estatico/php/opcionesAdministrador.php',
                type : 'POST',
                data : datosform,
                processData : false, 
                contentType : false, 
                success: function(data,textStatus,jqXHR){                           

                    if(/true/.test(data)) {                                
                        alert("Evento Editado  :D");
                        location.reload();
                    }
                    else alert("No se ha podido editar el evento"); 

                }
            });         
    });          
    


});